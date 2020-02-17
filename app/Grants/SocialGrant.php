<?php

namespace app\Grants;

use DateInterval;
use App\LinkedSocialAccount;
use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Http\Request;

/**
 * Class SocialGrant
 * @author Larry Mckuydee
 */
class SocialGrant extends AbstractGrant
{
    /**
     * @param UserRepositoryInterface         $userRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);

        $this->refreshTokenTTL = new DateInterval('P1M');
    }

    /**
     * {@inheritdoc}
     */
    public function respondToAccessTokenRequest(
        ServerRequestInterface $request,
        ResponseTypeInterface $responseType,
        DateInterval $accessTokenTTL
    ) {
        // Validate request
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request, $this->defaultScope));
        $user = $this->validateUser($request, $client);

        // Finalize the requested scopes
        $finalizedScopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());

        // Issue and persist new access token
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $finalizedScopes);
        //$this->getEmitter()->emit(new RequestEvent(RequestEvent::ACCESS_TOKEN_ISSUED, $request));
        $responseType->setAccessToken($accessToken);

        // Issue and persist new refresh token if given
        $refreshToken = $this->issueRefreshToken($accessToken);

        //if ($refreshToken !== null) {
        //    $this->getEmitter()->emit(new RequestEvent(RequestEvent::REFRESH_TOKEN_ISSUED, $request));
            $responseType->setRefreshToken($refreshToken);
        //}

        return $responseType;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ClientEntityInterface  $client
     *
     * @throws OAuthServerException
     *
     * @return UserEntityInterface
     */
    protected function validateUser(ServerRequestInterface $request, ClientEntityInterface $client)
    {
        $provider = $this->getRequestParameter('provider', $request);

        if (is_null($provider)) {
            throw OAuthServerException::invalidRequest('provider');
        }

        $provider_id = $this->getRequestParameter('provider_id', $request);

        if (is_null($provider_id)) {
            throw OAuthServerException::invalidRequest('provider_id');
        }

        // $user = $this->userRepository->getUserEntityByUserCredentials(
        //     $provider,
        //     $provider_id,
        //     $this->getIdentifier(),
        //     $client
        // );

        $user = $this->getUserFromSocialNetwork(new Request($request->getParsedBody()));

        if ($user instanceof UserEntityInterface === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));

            throw OAuthServerException::invalidGrant();
        }

        return $user;
    }

    private function getUserFromSocialNetwork(Request $request)
    {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config('auth.providers.'.$provider.'.model'))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }
        
        $socialAccount = LinkedSocialAccount::where('provider', $request->provider)
                            ->where('provider_id', $request->provider_id)
                            ->first();

        if(!$socialAccount) return;

        $user = $socialAccount->user()->first();

        if(!$user) return;

        return new User($user->getAuthIdentifier());
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'social';
    }
}

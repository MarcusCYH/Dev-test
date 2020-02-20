---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Register

> Example request:

```bash
curl -X POST \
    "http://localhost/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
    -d '{"name":"Larry", "email":"larry@flexi2pay.com", "password":"replace_with_password", "password_confirmation":"replace_with_password"}'
```

```javascript
const url = new URL(
    "http://localhost/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "token": "Bearer",
    "expires_in": "59",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjg0OWNiMTA5ODk1YjNkYjZlNzM3ZGE2YmU0ZDM4OWI3ZWRhYzU1YTJiMjJmM2VlNDQ5YmU0YTBlNDMxNGE2ZjU2MTkxZTY2NjUwYzJlMTUiLCJpYXQiOjE1ODIyMTUxODQsIm5iZiI6MTU4MjIxNTE4NCwiZXhwIjoxNTgyMjE1MjQzLCJzdWIiOiIzNyIsInNjb3BlcyI6WyIqIl19.UZBq8XlDN7DyLwN4UjYhOBTADEMdqCO2EIPiqHr-K9HQvuQfhip4H76-_XS2bGFNkzIjUhU2ZWrX8EZewvuPhoUrS8KR-0KVAeFmxCugg0JzukLHnsPFzHgkLeVW1RiumuAftvUHw2UvPVF66FFHC13XTu1ycclB94OwjE6sfHAZ3Al_Rcuq-_4LBxphb03RueWA0kziwRm6BxBTrXiBrlGNR7XD92HqmpVfEESS7cL6P2EASPMTPU1ry5N7aVNTZMnWjv9NQg7UAtXSUG-B398snRhjbxozS9BGh85nK7i4aMEtq9oLgv-jiLRJxtkyt8elOEtNUOFfAzfeFWGsj2U1o-F7idsSEJTEF44jeklyYpWNhrdTA8fmQ3ucILj8EJvHQn-FjFsF4nvMXubBp1RB_uIVVzPQYYAbmZMCGwiI5toTrCDY48O9QejJ8tCKMyT5m5kpdtuBQFujlUZCtCSV8hNsWLVHit19KMyVqpPJLs2OkiqXG9LZlB-jGLDJ_AqPmGEjHNDemxxowdLshD1rxSmgj4pzt1fxEqUTwY2eMX2aCxGngQ5IwnUWakg7Rc5z3vLVFrxAhqmSmlyxLVzavCQ0RwxiCDinCqfOE9nXPreewfkRNa1sA0jSjX5Id9WwVz7U0fkhxTeBsU3OBXBpxmGvUDO_78EUDFPswas",
    "refresh_token": "def502008bd80536ee3dc2dd0ff07921ef5ee3a425b5618e796acb1d47fbda9c95a7d2aff5f461601de80da00352f82cc3a212f5f2ff12d99bce87e111fc38d8ed053085e2f0e79a3441ce3c86d5999bd18ff7884c131b84128b0c8b8bbefbea9b97c0067c504fb6395591c3597cdf001495f2f6f2cac52a745aa4775800156c2269747dedb58532a93f8fb3c17881c86202c84b37d0e3e39e07f24f60713b488da6c2164a9cc7f187d218c056f07fee69d760d7d3029b48c6cffcc9e0b9b4d4369158743d4671440ca838b8db7d4739b768a457477695e742fc99552fd3615629cc5f977b1501fd059ebdab10f1768e3b9082d4e3db6c995eda92ae8924c057f3c74e9a2a93e2b6a9ed4688cc21095208c78421e2cc6757230ffc9b4cc9e2a6665ec529540cf7f2d068418bb989c7208406d983abe83d604a20ec588574901470c2ce51e1f5456477dddaa9a63a9b96c65fc9c89e9d70a8829e5f00ac571abced8740ef3b"
}
```


### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login

> Example request:

```bash
curl -X POST \
    "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
    -d '{"email":"larry@flexi2pay.com", "password":"replace_with_password"}'
```

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "token": "Bearer",
    "expires_in": "59",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjg0OWNiMTA5ODk1YjNkYjZlNzM3ZGE2YmU0ZDM4OWI3ZWRhYzU1YTJiMjJmM2VlNDQ5YmU0YTBlNDMxNGE2ZjU2MTkxZTY2NjUwYzJlMTUiLCJpYXQiOjE1ODIyMTUxODQsIm5iZiI6MTU4MjIxNTE4NCwiZXhwIjoxNTgyMjE1MjQzLCJzdWIiOiIzNyIsInNjb3BlcyI6WyIqIl19.UZBq8XlDN7DyLwN4UjYhOBTADEMdqCO2EIPiqHr-K9HQvuQfhip4H76-_XS2bGFNkzIjUhU2ZWrX8EZewvuPhoUrS8KR-0KVAeFmxCugg0JzukLHnsPFzHgkLeVW1RiumuAftvUHw2UvPVF66FFHC13XTu1ycclB94OwjE6sfHAZ3Al_Rcuq-_4LBxphb03RueWA0kziwRm6BxBTrXiBrlGNR7XD92HqmpVfEESS7cL6P2EASPMTPU1ry5N7aVNTZMnWjv9NQg7UAtXSUG-B398snRhjbxozS9BGh85nK7i4aMEtq9oLgv-jiLRJxtkyt8elOEtNUOFfAzfeFWGsj2U1o-F7idsSEJTEF44jeklyYpWNhrdTA8fmQ3ucILj8EJvHQn-FjFsF4nvMXubBp1RB_uIVVzPQYYAbmZMCGwiI5toTrCDY48O9QejJ8tCKMyT5m5kpdtuBQFujlUZCtCSV8hNsWLVHit19KMyVqpPJLs2OkiqXG9LZlB-jGLDJ_AqPmGEjHNDemxxowdLshD1rxSmgj4pzt1fxEqUTwY2eMX2aCxGngQ5IwnUWakg7Rc5z3vLVFrxAhqmSmlyxLVzavCQ0RwxiCDinCqfOE9nXPreewfkRNa1sA0jSjX5Id9WwVz7U0fkhxTeBsU3OBXBpxmGvUDO_78EUDFPswas",
    "refresh_token": "def502008bd80536ee3dc2dd0ff07921ef5ee3a425b5618e796acb1d47fbda9c95a7d2aff5f461601de80da00352f82cc3a212f5f2ff12d99bce87e111fc38d8ed053085e2f0e79a3441ce3c86d5999bd18ff7884c131b84128b0c8b8bbefbea9b97c0067c504fb6395591c3597cdf001495f2f6f2cac52a745aa4775800156c2269747dedb58532a93f8fb3c17881c86202c84b37d0e3e39e07f24f60713b488da6c2164a9cc7f187d218c056f07fee69d760d7d3029b48c6cffcc9e0b9b4d4369158743d4671440ca838b8db7d4739b768a457477695e742fc99552fd3615629cc5f977b1501fd059ebdab10f1768e3b9082d4e3db6c995eda92ae8924c057f3c74e9a2a93e2b6a9ed4688cc21095208c78421e2cc6757230ffc9b4cc9e2a6665ec529540cf7f2d068418bb989c7208406d983abe83d604a20ec588574901470c2ce51e1f5456477dddaa9a63a9b96c65fc9c89e9d70a8829e5f00ac571abced8740ef3b"
}
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->
<!-- START_3fba263a38f92fde0e4e12f76067a611 -->
## Refresh token

> Example request:

```bash
curl -X POST \
    "http://localhost/api/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"refresh_token": "replace_with_refresh_token"}'
```

```javascript
const url = new URL(
    "http://localhost/api/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "token": "Bearer",
    "expires_in": "59",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjg0OWNiMTA5ODk1YjNkYjZlNzM3ZGE2YmU0ZDM4OWI3ZWRhYzU1YTJiMjJmM2VlNDQ5YmU0YTBlNDMxNGE2ZjU2MTkxZTY2NjUwYzJlMTUiLCJpYXQiOjE1ODIyMTUxODQsIm5iZiI6MTU4MjIxNTE4NCwiZXhwIjoxNTgyMjE1MjQzLCJzdWIiOiIzNyIsInNjb3BlcyI6WyIqIl19.UZBq8XlDN7DyLwN4UjYhOBTADEMdqCO2EIPiqHr-K9HQvuQfhip4H76-_XS2bGFNkzIjUhU2ZWrX8EZewvuPhoUrS8KR-0KVAeFmxCugg0JzukLHnsPFzHgkLeVW1RiumuAftvUHw2UvPVF66FFHC13XTu1ycclB94OwjE6sfHAZ3Al_Rcuq-_4LBxphb03RueWA0kziwRm6BxBTrXiBrlGNR7XD92HqmpVfEESS7cL6P2EASPMTPU1ry5N7aVNTZMnWjv9NQg7UAtXSUG-B398snRhjbxozS9BGh85nK7i4aMEtq9oLgv-jiLRJxtkyt8elOEtNUOFfAzfeFWGsj2U1o-F7idsSEJTEF44jeklyYpWNhrdTA8fmQ3ucILj8EJvHQn-FjFsF4nvMXubBp1RB_uIVVzPQYYAbmZMCGwiI5toTrCDY48O9QejJ8tCKMyT5m5kpdtuBQFujlUZCtCSV8hNsWLVHit19KMyVqpPJLs2OkiqXG9LZlB-jGLDJ_AqPmGEjHNDemxxowdLshD1rxSmgj4pzt1fxEqUTwY2eMX2aCxGngQ5IwnUWakg7Rc5z3vLVFrxAhqmSmlyxLVzavCQ0RwxiCDinCqfOE9nXPreewfkRNa1sA0jSjX5Id9WwVz7U0fkhxTeBsU3OBXBpxmGvUDO_78EUDFPswas",
    "refresh_token": "def502008bd80536ee3dc2dd0ff07921ef5ee3a425b5618e796acb1d47fbda9c95a7d2aff5f461601de80da00352f82cc3a212f5f2ff12d99bce87e111fc38d8ed053085e2f0e79a3441ce3c86d5999bd18ff7884c131b84128b0c8b8bbefbea9b97c0067c504fb6395591c3597cdf001495f2f6f2cac52a745aa4775800156c2269747dedb58532a93f8fb3c17881c86202c84b37d0e3e39e07f24f60713b488da6c2164a9cc7f187d218c056f07fee69d760d7d3029b48c6cffcc9e0b9b4d4369158743d4671440ca838b8db7d4739b768a457477695e742fc99552fd3615629cc5f977b1501fd059ebdab10f1768e3b9082d4e3db6c995eda92ae8924c057f3c74e9a2a93e2b6a9ed4688cc21095208c78421e2cc6757230ffc9b4cc9e2a6665ec529540cf7f2d068418bb989c7208406d983abe83d604a20ec588574901470c2ce51e1f5456477dddaa9a63a9b96c65fc9c89e9d70a8829e5f00ac571abced8740ef3b"
}
```

### HTTP Request
`POST api/refresh`


<!-- END_3fba263a38f92fde0e4e12f76067a611 -->
<!-- START_9408c3c78b0ccc47d366742513bc08e3 -->
## Login with social account information

> Example request:

```bash
curl -X POST \
    "http://localhost/api/social_auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Larry", "email":"larry@flexi2pay.com", "provider":"facebook", "provider_id":"192312312321", "provider_user_access_token":"7fbda9c95a7d2aff5f461601de80da00352f82cc3a212f5f2ff12d99bce8"}'
```

```javascript
const url = new URL(
    "http://localhost/api/social_auth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token": "Bearer",
    "expires_in": "59",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjg0OWNiMTA5ODk1YjNkYjZlNzM3ZGE2YmU0ZDM4OWI3ZWRhYzU1YTJiMjJmM2VlNDQ5YmU0YTBlNDMxNGE2ZjU2MTkxZTY2NjUwYzJlMTUiLCJpYXQiOjE1ODIyMTUxODQsIm5iZiI6MTU4MjIxNTE4NCwiZXhwIjoxNTgyMjE1MjQzLCJzdWIiOiIzNyIsInNjb3BlcyI6WyIqIl19.UZBq8XlDN7DyLwN4UjYhOBTADEMdqCO2EIPiqHr-K9HQvuQfhip4H76-_XS2bGFNkzIjUhU2ZWrX8EZewvuPhoUrS8KR-0KVAeFmxCugg0JzukLHnsPFzHgkLeVW1RiumuAftvUHw2UvPVF66FFHC13XTu1ycclB94OwjE6sfHAZ3Al_Rcuq-_4LBxphb03RueWA0kziwRm6BxBTrXiBrlGNR7XD92HqmpVfEESS7cL6P2EASPMTPU1ry5N7aVNTZMnWjv9NQg7UAtXSUG-B398snRhjbxozS9BGh85nK7i4aMEtq9oLgv-jiLRJxtkyt8elOEtNUOFfAzfeFWGsj2U1o-F7idsSEJTEF44jeklyYpWNhrdTA8fmQ3ucILj8EJvHQn-FjFsF4nvMXubBp1RB_uIVVzPQYYAbmZMCGwiI5toTrCDY48O9QejJ8tCKMyT5m5kpdtuBQFujlUZCtCSV8hNsWLVHit19KMyVqpPJLs2OkiqXG9LZlB-jGLDJ_AqPmGEjHNDemxxowdLshD1rxSmgj4pzt1fxEqUTwY2eMX2aCxGngQ5IwnUWakg7Rc5z3vLVFrxAhqmSmlyxLVzavCQ0RwxiCDinCqfOE9nXPreewfkRNa1sA0jSjX5Id9WwVz7U0fkhxTeBsU3OBXBpxmGvUDO_78EUDFPswas",
    "refresh_token": "def502008bd80536ee3dc2dd0ff07921ef5ee3a425b5618e796acb1d47fbda9c95a7d2aff5f461601de80da00352f82cc3a212f5f2ff12d99bce87e111fc38d8ed053085e2f0e79a3441ce3c86d5999bd18ff7884c131b84128b0c8b8bbefbea9b97c0067c504fb6395591c3597cdf001495f2f6f2cac52a745aa4775800156c2269747dedb58532a93f8fb3c17881c86202c84b37d0e3e39e07f24f60713b488da6c2164a9cc7f187d218c056f07fee69d760d7d3029b48c6cffcc9e0b9b4d4369158743d4671440ca838b8db7d4739b768a457477695e742fc99552fd3615629cc5f977b1501fd059ebdab10f1768e3b9082d4e3db6c995eda92ae8924c057f3c74e9a2a93e2b6a9ed4688cc21095208c78421e2cc6757230ffc9b4cc9e2a6665ec529540cf7f2d068418bb989c7208406d983abe83d604a20ec588574901470c2ce51e1f5456477dddaa9a63a9b96c65fc9c89e9d70a8829e5f00ac571abced8740ef3b"
}
```


### HTTP Request
`POST api/social_auth`


<!-- END_9408c3c78b0ccc47d366742513bc08e3 -->
<!-- START_61739f3220a224b34228600649230ad1 -->
## Logout

> Example request:

```bash
curl -X POST \
    "http://localhost/api/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (204):


### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->
<!-- START_27968eb755bc848abc0026508d9ae82d -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/personal_info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://localhost/api/personal_info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data":{
        "id":19,
        "user_id":39,
        "name":null,
        "nric":"919191919191",
        "date_of_birth":null,
        "nric_front_copy":null,
        "mobile_no":null,
        "gender":1,
        "nationality":"MY",
        "religion_id":null,
        "occupation":null,
        "marital_status":null,
        "deleted_at":null,
        "created_at":"2020-02-20 16:26:26",
        "updated_at":"2020-02-20 16:26:26"
    }
}
```

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/personal_info`


<!-- END_27968eb755bc848abc0026508d9ae82d -->
<!-- START_89d6ce6e3228f0fef03db98aa9de97a4 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/personal_info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{ "id":19, "user_id":39, "name":null, "nric":"919191919191", "date_of_birth":null, "nric_front_copy":null, "mobile_no":null, "gender":1, "nationality":"MY", "religion_id":null, "occupation":null, "marital_status":null, "deleted_at":null, "created_at":"2020-02-20 16:26:26", "updated_at":"2020-02-20 16:26:26" }'
```

```javascript
const url = new URL(
    "http://localhost/api/personal_info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "data":{
        "id":19,
        "user_id":39,
        "name":null,
        "nric":"919191919191",
        "date_of_birth":null,
        "nric_front_copy":null,
        "mobile_no":null,
        "gender":1,
        "nationality":"MY",
        "religion_id":null,
        "occupation":null,
        "marital_status":null,
        "deleted_at":null,
        "created_at":"2020-02-20 16:26:26",
        "updated_at":"2020-02-20 16:26:26"
    }
}
```


### HTTP Request
`POST api/personal_info`


<!-- END_89d6ce6e3228f0fef03db98aa9de97a4 -->
<!-- START_c472784d876847163ce0fbb925660fbf -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/personal_info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{ "id":19, "user_id":39, "name":null, "nric":"919191919191", "date_of_birth":null, "nric_front_copy":null, "mobile_no":null, "gender":1, "nationality":"MY", "religion_id":null, "occupation":null, "marital_status":null, "deleted_at":null, "created_at":"2020-02-20 16:26:26", "updated_at":"2020-02-20 16:26:26" }'
```

```javascript
const url = new URL(
    "http://localhost/api/personal_info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data":{
        "id":19,
        "user_id":39,
        "name":null,
        "nric":"919191919191",
        "date_of_birth":null,
        "nric_front_copy":null,
        "mobile_no":null,
        "gender":1,
        "nationality":"MY",
        "religion_id":null,
        "occupation":null,
        "marital_status":null,
        "deleted_at":null,
        "created_at":"2020-02-20 16:26:26",
        "updated_at":"2020-02-20 16:26:26"
    }
}
```


### HTTP Request
`PUT api/personal_info`

`PATCH api/personal_info`


<!-- END_c472784d876847163ce0fbb925660fbf -->


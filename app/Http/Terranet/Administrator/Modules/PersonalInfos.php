<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\PersonalInfo;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;
use Terranet\Administrator\Field\Text;

/**
 * Administrator Resource PersonalInfos
 *
 * @package Terranet\Administrator
 */
class PersonalInfos extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = PersonalInfo::class;

    /**
     * undocumented function
     *
     * @return void
     */
    public function form()
    {
        $form = $this->scaffoldForm();
        $form[5] = Text::make('Gender', 'gender');
        $form[9] = Text::make('Marital Status', 'marital_status');
        return $form;
    }
    

    /**
     * undocumented function
     *
     * @return void
     */
    public function rules()
    {
        $personalInfoScaffoldRules = $this->scaffoldRules();

        return array_merge($personalInfoScaffoldRules, [
            'user_id' => 'nullable',
            'gender' => 'nullable|string',
            'marital_status' => 'nullable|string'
        ]);
    }
    
}

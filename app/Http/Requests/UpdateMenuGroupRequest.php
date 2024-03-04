<?php

namespace App\Http\Requests;

use App\Models\MenuGroup;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = MenuGroup::$rules;
        
        return $rules;
    }
}

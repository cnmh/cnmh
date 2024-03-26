<?php

namespace App\Http\Requests;

use App\Models\TypeHandicap;
use Illuminate\Foundation\Http\FormRequest;

class CreateTypeHandicapRequest extends FormRequest
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
        return TypeHandicap::$rules;
    }
}

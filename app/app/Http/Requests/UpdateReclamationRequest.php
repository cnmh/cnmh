<?php

namespace App\Http\Requests;

use App\Models\Reclamation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReclamationRequest extends FormRequest
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
        $rules = Reclamation::$rules;
        
        return $rules;
    }
}

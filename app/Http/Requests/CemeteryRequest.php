<?php

namespace App\Http\Requests;

use App\Models\Cemetery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CemeteryRequest extends FormRequest
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
        return [
            'type' => ['integer', 'required', 'max:255',  'between:0,'.count(Cemetery::TYPES)],
        ];
    }
}

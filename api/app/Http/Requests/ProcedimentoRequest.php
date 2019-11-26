<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcedimentoRequest extends FormRequest
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
            'codigo' => "required|min:1|max:11",
            'procedimento' => "required|min:5|max:100",
            'status' => "required|min:1|max:1",
            'grupo_procedimento_id' => "required",
        ];
    }
}

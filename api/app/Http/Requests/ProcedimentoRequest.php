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
        ];
    }

    public function formated(){
        $data = parent::all();
        $data['grupo_procedimento_id'] = $data['grupoProcedimento']['value'];
        $data['status'] = $data['status'] === 'Ativado';

        return $data;
    }
}
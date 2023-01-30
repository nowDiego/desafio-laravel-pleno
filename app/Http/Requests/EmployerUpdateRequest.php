<?php

namespace App\Http\Requests;

use App\Rules\EinRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployerUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ein'=>['required','max:18',new EinRule()],
            'trade'=>'required|max:255'
           
        ];
    }

    public function messages()
    {
        return [            
            'ein.required' => 'CNPJ  é obrigatório',
            'ein.max'=>'Você excedeu o número máximo caracteres deste campo',                   
          
            'trade.required' => 'Nome Fantasia é obrigatório',
            'trade.max'=>'Você excedeu o número máximo caracteres deste campo',                   
          
                   
     
        ];
    }
}

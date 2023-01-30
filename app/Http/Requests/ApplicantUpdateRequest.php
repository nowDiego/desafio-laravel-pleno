<?php

namespace App\Http\Requests;

use App\Rules\AgeRule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantUpdateRequest extends FormRequest
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
          
            'name'=>'required|max:255',           
            'gender'=>'required|max:1',
            'age'=>['required','integer',new AgeRule()],
           
        ];
    }

    public function messages()
    {
        return [           
           
            'name.required' => 'Nome é obrigatório',
            'name.max'=>'Você excedeu o número máximo caracteres deste campo',                 
        
            'gender.required' => 'Gênero é obrigatório',
            'gender.max'=>'Você excedeu o número máximo caracteres deste campo',
          
            'age.required' => 'Idade é obrigatória',
            'age.integer'=>'Idade inválida',  
                        
                  
        ];
    }
}

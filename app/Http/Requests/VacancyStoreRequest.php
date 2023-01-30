<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyStoreRequest extends FormRequest
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
          
            'title'=>'required|max:255',
            'description'=>'required',                
            'requirement'=>'required',         
            'type'=>'required|integer|exists:type_vacancies,id'
        ];
    }

    public function messages()
    {
        return [            
            
            
            

            'title.required' => 'Título  é obrigatório',
            'title.max'=>'Você excedeu o número máximo caracteres deste campo',                   
          
            'description.required' => 'Descrição é obrigatória',
          
            'requirement.required' => 'Requisitos são obrigatório',          
                                                        
            'username.required' => 'Usuário é obrigatório',
            'username.max'=>'Você excedeu o número máximo caracteres deste campo',  

            'type.required' => 'Tipo de Contratação é obrigatório',
            'type.integer' => 'Tipo de Contratação inválida',
            'type.exists' => 'Tipo de Contratação inválda',
          
     
        ];
    }
}

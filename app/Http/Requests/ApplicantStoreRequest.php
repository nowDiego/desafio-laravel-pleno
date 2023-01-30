<?php

namespace App\Http\Requests;

use App\Rules\AgeRule;
use App\Rules\ItinRule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantStoreRequest extends FormRequest
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
            'itin'=>['required','max:14',new ItinRule()],
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'gender'=>'required|max:1',
            'age'=>['required','integer',new AgeRule()],
            'username'=>'required|max:255',
            'password'=>'required|max:255'


        ];
    }

    public function messages()
    {
        return [            
            'itin.required' => 'CPF  é obrigatório',
            'itin.max'=>'Você excedeu o número máximo caracteres deste campo',                   
          
            'name.required' => 'Nome é obrigatório',
            'name.max'=>'Você excedeu o número máximo caracteres deste campo',                   
          
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.max'=>'Você excedeu o número máximo caracteres deste campo',                  
          
            'gender.required' => 'Gênero é obrigatório',
            'gender.max'=>'Você excedeu o número máximo caracteres deste campo',
          
            'age.required' => 'Idade é obrigatória',
            'age.integer'=>'Idade inválida',  
                        
            'username.required' => 'Usuário é obrigatório',
            'username.max'=>'Você excedeu o número máximo caracteres deste campo',  

            'password.required' => 'Senha é obrigatória',
            'password.max'=>'Você excedeu o número máximo caracteres deste campo',            
          
     
        ];
    }
}

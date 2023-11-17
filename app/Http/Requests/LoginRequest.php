<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules()
    {
        return [
            'username'=>'required',
            'password' => 'required'
        ];
    }
    public function getCredentials(){
        $user = user::find('username');
        $username = $this->get('username');
        if($this->isEmail($username)){
            return[
                'email' => $username,
                'password' => $this->get('password'),
                
            ];
        }
        return $this->only('username','password');
    }
    
    public function isEmail($value){
        $factory = $this->container->make(ValidationFactory::class);
        return !$factory->make(['username'=> $value],['username' => 'email'])->fails();
    }


    public function messages(){
        return [
            'username.required' => 'Ingrese un username o correo.',
            'password.required' => 'Ingrese la contraseña.',
        ];
    }

}

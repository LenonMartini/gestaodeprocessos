<?php

namespace App\Http\Requests\User;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(): array
    {
        $cod = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$cod},id"],
            'status' => ['nullable', 'string', 'in:' . implode(',', StatusEnum::getAllStatuses())],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable', 'string', 'min:8'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ser maior que 255 caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ser maior que 255 caracteres.',
            'email.unique' => 'O e-mail já existe na base de dados.',

            'status.nullable' => 'O campo status é opcional.',
            'status.string' => 'O status deve ser uma string.',
            'status.in' => 'O status selecionado é inválido.',

            'password.nullable' => 'O campo senha é opcional.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',

            'password_confirmation.nullable' => 'O campo confirmação de senha é opcional.',
            'password_confirmation.string' => 'A confirmação de senha deve ser uma string.',
            'password_confirmation.min' => 'A confirmação de senha deve ter pelo menos 8 caracteres.',
            'password_confirmation.confirmed' => 'A confirmação da senha não confere.',
        ];
    }


}

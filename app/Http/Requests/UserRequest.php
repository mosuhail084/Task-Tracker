<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $isEdit = $this->route()->getName() === 'users.update';

        $userId = $this->route('user') ? $this->route('user')->id : null;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'role' => 'required|exists:roles,name',
        ];

        if (!$isEdit) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }


    public function authorize()
    {
        return true;
    }
}

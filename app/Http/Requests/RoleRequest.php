<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $roleId = $this->route('role') ? $this->route('role')->id : null;

        $rules = [
            'name' => 'required|string|max:255|unique:roles,name,' . $roleId, 
            'description' => 'required|string|max:255', 
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The role name is required.',
            'name.unique' => 'This role name has already been taken.',
            'permissions.*.exists' => 'Selected permissions must be valid.'
        ];
    }
}

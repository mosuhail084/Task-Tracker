<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    
    public function rules()
    {
        return [
            'title' => 'required|string|max:255', 
            'description' => 'nullable|string', 
            'assigned_to' => 'required|exists:users,id', 
            'project_id' => 'required|exists:projects,id', 
            'status' => 'required|in:pending,ongoing,completed',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A task title is required.',
            'assigned_to.required' => 'You must assign a user to the task.',
            'project_id.required' => 'You must select a project for the task.',
            'status.in' => 'The selected status is invalid.',
            'due_date.required' => 'A due date is required.',
            'due_date.date' => 'The due date must be a valid date.',
            'due_date.after_or_equal' => 'The due date must be today or a later date.',
        ];
    }
}

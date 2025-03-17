<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => [
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer', 'exists:roles,id', function ($attribute, $value, $fail) {
                if ($value == 1 && !Auth::user()->roles->contains('name', 'super_admin')) {
                    $fail(__('validation.custom.role.super_admin'));
                }
            }],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('admin/user.attributes.name')]),
            'name.string' => __('validation.string', ['attribute' => __('admin/user.attributes.name')]),
            'name.max' => __('validation.max', ['attribute' => __('admin/user.attributes.name'), 'max' => 255]),
            'username.required' => __('validation.required', ['attribute' => __('admin/user.attributes.username')]),
            'username.string' => __('validation.string', ['attribute' => __('admin/user.attributes.username')]),
            'username.max' => __('validation.max', ['attribute' => __('admin/user.attributes.username'), 'max' => 255]),
            'email.string' => __('validation.string', ['attribute' => __('admin/user.attributes.email')]),
            'email.lowercase' => __('validation.lowercase', ['attribute' => __('admin/user.attributes.email')]),
            'email.email' => __('validation.email', ['attribute' => __('admin/user.attributes.email')]),
            'email.max' => __('validation.max', ['attribute' => __('admin/user.attributes.email'), 'max' => 255]),
            'email.unique' => __('validation.unique', ['attribute' => __('admin/user.attributes.email')]),
            'password.required' => __('validation.required', ['attribute' => __('admin/user.attributes.password')]),
            'password.string' => __('validation.string', ['attribute' => __('admin/user.attributes.password')]),
            'password.min' => __('validation.min', ['attribute' => __('admin/user.attributes.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('admin/user.attributes.password')]),
            'role.required' => __('validation.required', ['attribute' => __('admin/user.attributes.role')]),
        ];
    }
}

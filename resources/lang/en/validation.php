<?php

return [
    'custom' => [
        'username' => [
            'exists' => 'Incorrect username or password.',
        ],
        'email' => [
            'exists' => 'Incorrect email or password.',
        ],
        'role' => [
            'super_admin' => 'You are not authorized to create a super admin user.',
        ],
    ],
    'email' => 'The :attribute must be a valid email address.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'string' => 'The :attribute must not be longer than :max characters.',
    ],
    'required' => 'The :attribute field is required.',
    'unique' => 'The :attribute has already been taken.',
];

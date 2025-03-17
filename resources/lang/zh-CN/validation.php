<?php

return [
    'custom' => [
        'username' => [
            'exists' => '用户名或密码错误。',
        ],
        'email' => [
            'exists' => '邮箱或密码错误。',
        ],
        'role' => [
            'super_admin' => '您没有权限创建超级管理员用户。',
        ],
    ],
    'email' => '请输入有效的:attribute',
    'min' => [
        'string' => ':attribute至少需要:min个字符',
    ],
    'max' => [
        'string' => ':attribute最多只能输入:max个字符',
    ],
    'required' => '请输入:attribute',
    'unique' => ':attribute已存在',
];

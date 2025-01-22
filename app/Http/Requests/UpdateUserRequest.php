<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'bio' => ['sometimes', 'string', 'max:1000'],
            'avatar' => ['sometimes', 'image', 'max:2048'], // 2MB
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => '该用户名已被使用',
            'username.max' => '用户名不能超过255个字符',
            'bio.max' => '个人简介不能超过1000个字符',
            'avatar.image' => '头像必须是图片格式',
            'avatar.max' => '头像大小不能超过2MB',
        ];
    }
} 
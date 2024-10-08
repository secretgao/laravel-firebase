<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名是必填项。',
            'username.string' => '用户名必须是字符串。',
            'username.max' => '用户名不能超过255个字符。',
            'password.required' => '密码是必填项。',
            'password.string' => '密码必须是字符串。',
            'password.min' => '密码至少需要6个字符。',
        ];
    }
}

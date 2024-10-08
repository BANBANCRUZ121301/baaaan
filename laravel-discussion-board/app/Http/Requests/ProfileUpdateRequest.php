<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'current_password' => ['required'],  // Add validation for current password
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],  // Add validation for new password
        ];
    }
}


    


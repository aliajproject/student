<?php

namespace App\Http\Requests\Students;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:' . rp_get_table(User::class) . ',email,' . $this->uuid,
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required|in:Excellent,Good,Average,Poor',
        ];
    }

    public function storeUser()
    {
        return User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);
    }
}

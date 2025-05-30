<?php

namespace App\Http\Requests\Students;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|exists:'.rp_get_table(User::class).',uuid',
        ];
    }
}

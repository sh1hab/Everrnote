<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return void
     */
    function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'nullable|string|max:1000',
            'email' => 'nullable|email',
            'password' => 'nullable|string',
            'is_password_active' => 'nullable',
            'nationality' => 'nullable|string',
            'address' => 'nullable',
            'characteristics' => 'nullable',
            'starred' => 'nullable',
            'user_id' => "exists:".User::class.",id",
        ];
    }
}

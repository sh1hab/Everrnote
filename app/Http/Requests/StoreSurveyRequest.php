<?php

namespace App\Http\Requests;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
            'title' => 'required|string|max:1000',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'expire_date' => 'nullable|date|after:tomorrow',
            'slug' => 'nullable|unique:surveys|string',
            'image' => 'nullable|string',
            'user_id' => "exists:".User::class.",id",
            'upload_id' => "exists:".Upload::class.",id",
        ];
    }
}

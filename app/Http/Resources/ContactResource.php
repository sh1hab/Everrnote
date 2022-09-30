<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_password_active' => $this->is_password_active,
            'nationality' => $this->nationality,
            'address' => $this->address,
            'characteristics' => $this->characteristics,
            'starred' => $this->starred,
            'user' => new UserResource($this->user)
        ];
    }
}

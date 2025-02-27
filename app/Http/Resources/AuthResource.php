<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
            ],
            'token' => [
                'access_token' => $this->token,
                'token_type' => 'bearer',
                // 'expires_in' => auth()->factory()->getTTL() * 60, // Expiry time in seconds
            ],
        ];
    }
}


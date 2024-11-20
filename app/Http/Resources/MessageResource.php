<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sender_name' => $this->whenLoaded('sender', function () {
                return $this->sender->name;
            }),
            'message' => $this->message,
            'created_at' => $this->created_at,
        ];
    }
}

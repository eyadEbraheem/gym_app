<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profileresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'height'=>$this->height,
            'weight'=>$this->weight,
            'age'=>$this->age,
            'goal'=>$this->goal,
            'years_experiense'=>$this->years_experiense,
            'bio'=>$this->bio,
            'image'=>$this->image,
            'user'=>new UserResource($this->whenLoaded('User')),
        ];

    }
}

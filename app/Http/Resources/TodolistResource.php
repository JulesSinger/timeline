<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TodoResource;

class TodolistResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'color' => $this->color,
            'description' => $this->description,
            'todos' => TodoResource::collection($this->todos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TodolistResource;
class TodoResource extends JsonResource
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
            'todolist_id' => $this->todolist_id,
            'title' => $this->title,
            'priority' => $this->priority,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'done' => $this->done,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

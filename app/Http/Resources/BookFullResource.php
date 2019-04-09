<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'isbn' => $this->isbn,
            'title' => $this->title,
            'author' => $this->author->name,
            'category' => $this->categories->pluck('name'),
            'price' => $this->price
        ];
    }
}

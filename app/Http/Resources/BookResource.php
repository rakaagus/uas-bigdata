<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            '_id' => $this->id,
            'title' => $this->title,
            'pengarang' => $this->pengarang,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'jenis' => $this->jenis,
            'bookshelves' => ["_id" => $this->bookshelves_id,
                            "name" => $this->bookshelf->name],
            'sipnosis' => $this->sipnosis,
            'isBooked' => $this->isBooked,
            'image' => $this->image,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}

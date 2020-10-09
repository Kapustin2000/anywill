<?php

namespace App\Http\Resources\Cemetery;

use Illuminate\Http\Resources\Json\JsonResource;

class CemeterySingleResource extends JsonResource
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
            'private_id' => $this->private_id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address()->select('formatted_address', 'latitude','longitude')->get(),
            'owner_type' => strtolower((new \ReflectionClass($this->owner_type))->getShortName()),
            'owner' => $this->owner()->select('id', 'name')->get(),
            'classifications' => $this->classifications()->pluck('id'),
            'managers' => $this->managers()->pluck('id'),
            'media' => $this->media,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

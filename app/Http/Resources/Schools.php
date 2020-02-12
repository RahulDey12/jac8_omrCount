<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Schools extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->school_name. ' | ' .$this->jac_code,
        ];
    }
}

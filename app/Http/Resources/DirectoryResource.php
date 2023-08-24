<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'DirectoryId'=>$this->DirectoryId,
            'DirectoryName'=>$this->DirectoryName,
            'parentId'=>$this->parentId,
            'available'=>$this->available
        ];
    }
}

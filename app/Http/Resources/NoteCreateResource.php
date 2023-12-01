<?php

namespace App\Http\Resources;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $name
 * @property int $user_id
 * @property int $category_id
 */
class NoteCreateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'user_id'=>$this->user_id,
            'category_id'=>$this->category_id,
            'image'=> MediaResource::collection($this->getMedia(Notes::IMAGE_COLLECTION_NAME)),
        ];
    }
}

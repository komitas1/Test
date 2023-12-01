<?php

namespace App\Http\Resources;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $category_id
 */
class ShowNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'user_id'=>$this->user_id,
            'category_id'=>$this->category_id,
            'image'=> MediaResource::collection($this->getMedia(Notes::IMAGE_COLLECTION_NAME)),
        ];
    }
}

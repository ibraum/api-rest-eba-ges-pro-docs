<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'document_id' => $this->document_id,
            'name' => $this->name,
            'path' => $this->path,
            'date_created' => $this->date_created,
            'author' => $this->author,
            'last_update' => $this->last_update,
            'last_user' => $this->last_user,
            'project_id' => $this->project_id,
        ];
    }
}

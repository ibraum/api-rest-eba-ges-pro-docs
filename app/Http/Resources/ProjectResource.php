<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project_id' => $this->project_id,
            'libel' => $this->libel,
            'client_name'  => $this->client_name,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
        ];
    }
}

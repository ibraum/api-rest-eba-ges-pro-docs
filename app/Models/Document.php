<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'name',
        'path',
        'date_created',
        'author',
        'last_update',
        'last_user',
    ];

    public function pathUrl() : string
    {
        return Storage::disk()->url($this->path);
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'histories', 'document_id', 'user_id', 'document_id', 'user_id');
    }
}

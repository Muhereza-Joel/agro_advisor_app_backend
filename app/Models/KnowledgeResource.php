<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class KnowledgeResource extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'resource_type',
        'livestock_type',
        'disease_id',
        'is_featured',
        'created_by',
    ];

    /**
     * Automatically set created_by when creating a new record.
     */
    protected static function booted()
    {
        static::creating(function ($resource) {
            if (Auth::check() && is_null($resource->created_by)) {
                $resource->created_by = Auth::id();
            }
        });
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

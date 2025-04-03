<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'livestock_type',
        'symptoms',
        'prevention',
        'treatment',
        'is_zoonotic',
        'key_symptoms',
        'secondary_symptoms',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_zoonotic' => 'boolean',
        'key_symptoms' => 'array',
        'secondary_symptoms' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(DiseaseCategory::class, 'category_id');
    }
}

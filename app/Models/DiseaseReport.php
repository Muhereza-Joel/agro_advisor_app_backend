<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiseaseReport extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmer_id',
        'vet_id',
        'disease_id',
        'livestock_type',
        'symptoms',
        'status',
        'diagnosis',
        'treatment',
        'severity',
        'village_id',
        'suggested_diseases',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'symptoms' => 'array',
        'suggested_diseases' => 'array',
    ];


    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id')->whereHas('roles', function ($query) {
            $query->where('name', 'farmer');
        });
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id')->whereHas('roles', function ($query) {
            $query->where('name', 'veterinary officer');
        });
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}

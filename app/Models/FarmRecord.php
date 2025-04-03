<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmRecord extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmer_id',
        'record_type',
        'details',
        'date',
        'related_disease_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function user()
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


    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'user_id')->whereHas('roles', function ($query) {
            $query->where('name', 'farmer');
        });
    }

    public function farmName()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function relatedDisease()
    {
        return $this->belongsTo(Disease::class, 'related_disease_id');
    }
}

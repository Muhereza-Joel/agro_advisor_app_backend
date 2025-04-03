<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advisory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farmer_id',
        'user_id',
        'question',
        'response',
        'status',
        'related_disease_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function farmer()
    {
        return $this->hasOneThrough(Farmer::class, User::class, 'id');
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'related_disease_id');
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->whereHas('roles', function ($query) {
            $query->where('name', 'veterinary officer');
        });
    }
}

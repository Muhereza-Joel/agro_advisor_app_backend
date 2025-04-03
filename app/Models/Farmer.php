<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Farmer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'farm_name',
        'livestock_type',
        'livestock_count',
        'village_id',
        'coordinates',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'coordinates' => 'array',
    ];


    // Or with mutators:
    public function setCoordinatesAttribute($value)
    {
        $this->attributes['coordinates'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getCoordinatesAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : $value;
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function farmRecords()
    {
        return $this->hasMany(FarmRecord::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'subcounty_id',
        'code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate code if it's not set
            if (empty($model->code)) {
                $model->code = static::generateSubcountyCode($model->name);
            }
        });
    }

    protected static function generateSubcountyCode(string $name): string
    {
        // Get initials from name (e.g., "North District" becomes "ND")
        $initials = preg_replace('/\b(\w)|./', '$1', $name);
        $initials = strtoupper($initials);

        // If initials are too short, take first 3 letters
        if (strlen($initials) < 2) {
            $initials = strtoupper(substr($name, 0, 3));
        }

        // Make sure code is unique by appending random numbers if needed
        $code = $initials;
        $counter = 1;

        while (static::where('code', $code)->exists()) {
            $code = $initials . $counter;
            $counter++;
        }

        return $code;
    }

    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }

    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
    }
}

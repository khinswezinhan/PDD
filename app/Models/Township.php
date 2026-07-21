<?php

namespace App\Models;

use Database\Factories\TownshipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Township extends Model
{
    /** @use HasFactory<TownshipFactory> */
    use HasFactory;

    protected $fillable = ['name', 'district_id'];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    // public function division()
    // {
    //     return $this->hasOneThrough(
    //         Division::class, // Target model
    //         District::class, // Intermediate (ကြားခံ) model
    //         'id',            // District table ရဲ့ local key
    //         'id',            // Division table ရဲ့ local key
    //         'district_id',   // Township table ရဲ့ foreign key
    //         'division_id'    // District table ရဲ့ foreign key
    //     );
    // }
    public function pagodas()
    {
        return $this->hasMany(Pagoda::class);
    }
}

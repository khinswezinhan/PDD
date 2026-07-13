<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Township extends Model
{
    /** @use HasFactory<\Database\Factories\TownshipFactory> */
    use HasFactory;

    protected $fillable = ['name', 'district_id'];

   public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}

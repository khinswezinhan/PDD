<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagoda extends Model
{
    /** @use HasFactory<PagodaFactory> */
    use HasFactory;

    protected $fillable = ['name', 'township_id', 'photo', 'map_link', 'website', 'address', 'history', 'status'];

    /**
     * 🔗 Relationship: စေတီပုထိုးတစ်ခုသည် မြို့နယ်တစ်ခုအောက်၌ တည်ရှိသည် (Many to One)
     */
    public function township(): BelongsTo
    {
        return $this->belongsTo(Township::class);
    }
}

<?php

namespace App\Models;

use Database\Factories\DivisionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /** @use HasFactory<DivisionFactory> */
    use HasFactory;

    protected $fillable = ['name'];
}

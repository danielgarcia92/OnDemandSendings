<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emails extends Model
{
    use HasFactory;

    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'email'
        , 'apps_id'
        , 'active'
    ];
}

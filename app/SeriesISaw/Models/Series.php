<?php

namespace App\SeriesISaw\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model {

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    protected $table = 'series';
}

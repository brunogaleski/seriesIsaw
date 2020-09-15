<?php

namespace App\SeriesISaw\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model {

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    protected $table = 'platform';
}

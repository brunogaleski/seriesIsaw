<?php

namespace App\SeriesISaw\Models;

use Illuminate\Database\Eloquent\Model;

class SeriesHistory extends Model {

    protected $fillable = [
        'user_id',
        'series_id',
        'platform_id',
        'current_season',
        'current_episode'
    ];

    protected $primaryKey = 'series_history_id';

    public function series () {
        return $this->belongsTo(Series::class);
    }

    public function platform () {
        return $this->belongsTo(Platform::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
    protected $table = 'series_history';
}

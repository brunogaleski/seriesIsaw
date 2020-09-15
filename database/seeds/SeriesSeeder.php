<?php

use App\SeriesISaw\Models\Series;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()  {
        DB::table('series')->delete();

        Series::create(array(
            'name' => 'The Boys'
        ));

        Series::create(array(
            'name' => 'The Office'
        ));

        Series::create(array(
            'name' => 'The Good Place'
        ));

        Series::create(array(
            'name' => 'Friends'
        ));

        Series::create(array(
            'name' => 'How I Met Your Mother'
        ));

        Series::create(array(
            'name' => 'Game of Thrones'
        ));

        Series::create(array(
            'name' => 'Breaking Bad'
        ));

        Series::create(array(
            'name' => 'House'
        ));

        Series::create(array(
            'name' => 'Doctor Who'
        ));

        Series::create(array(
            'name' => 'Vikings'
        ));
    }
}

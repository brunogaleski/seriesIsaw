<?php

use App\SeriesISaw\Models\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('platform')->delete();
        Platform::create(array(
            'name' => 'Netflix'
        ));

        Platform::create(array(
            'name' => 'Amazon Prime'
        ));

        Platform::create(array(
            'name' => 'HBO'
        ));

        Platform::create(array(
            'name' => 'Hulu'
        ));

        Platform::create(array(
            'name' => 'Disney Plus'
        ));
    }
}

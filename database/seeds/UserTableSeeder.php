<?php

use App\SeriesISaw\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    public function run()  {
        DB::table('user')->delete();
        User::create(array(
            'username' => 'admin',
            'password' => md5('test'),
            'is_admin'  => true
        ));

        User::create(array(
            'username' => 'user',
            'password' => md5('test'),
            'is_admin'  => false
        ));
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'     => 'admin cybexo',
            'email'    => 'admin@cybexo.com',
            'password' => bcrypt('123456'),
        ]);
    }
}

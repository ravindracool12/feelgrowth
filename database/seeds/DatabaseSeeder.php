<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run() {
        $this->call(AdminSeeder::class);
        $this->call(PackageSeeder::class);

        \DB::table('Shares_Centre')->insert([
        	'minimum_price' => 0.200,
        	'current_price'	=> 0.200,
        	'raise_by' => 0.001,
        	'raise_limit' => 20000,
        	'always_company' => true,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()
        ]);
    }
}

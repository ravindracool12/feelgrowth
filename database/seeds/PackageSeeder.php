<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'package_amount' => 0,
                'direct_percent' => 0,
                'pairing_percent'   =>  0,
                'group_level'   =>  0,
                'max_pairing_bonus' => 0,
                'max_pair'  =>  0,
                'purchase_point' =>  0,
                'max_share_sale' => 0,
                'share_limit' =>  0
            ],
            [
                'package_amount' => 100,
                'direct_percent' => 7,
                'pairing_percent'   =>  7,
                'group_level'   =>  0,
                'max_pairing_bonus' => 100,
                'max_pair'  =>  3,
                'purchase_point' =>  30,
                'max_share_sale' => 1000,
                'share_limit' =>  100
            ],
            [
                'package_amount' => 500,
                'direct_percent' => 8,
                'pairing_percent'   => 8,
                'group_level'   =>  3,
                'max_pairing_bonus' => 500,
                'max_pair'  =>  13,
                'purchase_point' =>  200,
                'max_share_sale' => 6000,
                'share_limit' =>  500
            ],
            [
                'package_amount' => 1000,
                'direct_percent' => 9,
                'pairing_percent'   => 8,
                'group_level'   =>  6,
                'max_pairing_bonus' => 1000,
                'max_pair'  =>  25,
                'purchase_point' =>  500,
                'max_share_sale' => 15000,
                'share_limit' =>  1000
            ],
            [
                'package_amount' => 3000,
                'direct_percent' => 10,
                'pairing_percent'   => 10,
                'group_level'   =>  9,
                'max_pairing_bonus' => 3000,
                'max_pair'  =>  60,
                'purchase_point' =>  1800,
                'max_share_sale' => 48000,
                'share_limit' =>  3000
            ],
            [
                'package_amount' => 5000,
                'direct_percent' => 12,
                'pairing_percent'   => 10,
                'group_level'   =>  12,
                'max_pairing_bonus' => 5000,
                'max_pair'  =>  100,
                'purchase_point' =>  3500,
                'max_share_sale' => 90000,
                'share_limit' =>  5000
            ]
        ];

        foreach ($packages as $package) {
        	$package['created_at'] = Carbon::now();
        	$package['updated_at'] = Carbon::now();
        	\DB::table('Package')->insert($package);
        }
    }
}

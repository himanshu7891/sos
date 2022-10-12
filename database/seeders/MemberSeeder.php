<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Admin;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'member_code' => Admin::memberCode(),
            'team_id' => '1',
            'branch_id' => '1',
            'first_name' => 'Domanic',
            'last_name' => 'Toretto',
            'email' => 'domanic@gmail.com',
            'mobile' => '1212335345',
        ]);
        Member::create([
            'member_code' => Admin::memberCode(),
            'team_id' => '1',
            'branch_id' => '4',
            'first_name' => 'John',
            'last_name' => 'Wick',
            'email' => 'john@gmail.com',
            'mobile' => '1212425345',
        ]);
        Member::create([
            'member_code' => Admin::memberCode(),
            'team_id' => '2',
            'branch_id' => '2',
            'first_name' => 'Shree',
            'last_name' => 'Legend',
            'email' => 'shree@gmail.com',
            'mobile' => '1212323455',
        ]);
        Member::create([
            'member_code' => Admin::memberCode(),
            'team_id' => '2',
            'branch_id' => '5',
            'first_name' => 'Uri',
            'last_name' => 'Charlie',
            'email' => 'uri@gmail.com',
            'mobile' => '1353465345',
        ]);
        Member::create([
            'member_code' => Admin::memberCode(),
            'team_id' => '3',
            'branch_id' => '3',
            'first_name' => 'Devil',
            'last_name' => 'Race',
            'email' => 'devil@gmail.com',
            'mobile' => '2367335345',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use Admin;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'team_code' => Admin::teamCode(),
            'team_name' => 'team1',
        ]);
        Team::create([
            'team_code' => Admin::teamCode(),
            'team_name' => 'team2',
        ]);
        Team::create([
            'team_code' => Admin::teamCode(),
            'team_name' => 'team3',
        ]);
        Team::create([
            'team_code' => Admin::teamCode(),
            'team_name' => 'team4',
        ]);
        Team::create([
            'team_code' => Admin::teamCode(),
            'team_name' => 'team5',
        ]);
    }
}

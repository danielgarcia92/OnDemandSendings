<?php

namespace Database\Seeders;

use App\Models\Apps;
use App\Models\User;
use App\Models\Emails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**  @return void */
    public function run()
    {
        User::factory(1)->create();
        Apps::factory()->count(6)->sequence(['name' => 'ALL'],['name' => 'FW'],['name' => 'GDL'],['name' => 'MEX'],['name' => 'NLU'],['name' => 'ASA'])->create();
        Emails::factory(1)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::create(['name' => 'Website 1']);
        Website::create(['name' => 'Website 2']);
        Website::create(['name' => 'Website 3']);
        Website::create(['name' => 'Website 4']);
        Website::create(['name' => 'Website 5']);
    }
}

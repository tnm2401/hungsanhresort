<?php

use Illuminate\Database\Seeder;
use App\Models\Translation;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Statusservice::insert([
        //     ['trans_type' => 'App\Models\Setting'],
        //     ['trans_id' => 'App\Models\Setting']
        //     // ['name' => 'Thiếu hồ sơ'],
        //     // ['name' => 'Ghi chú'],
        // ]);
        Translation::insert([
            'trans_id' => 1,
            'trans_type' => 'App\Models\Setting',
            'locale' => 'vi'
        ]);
        Translation::insert([
            'trans_id' =>1,
            'trans_type' => 'App\Models\Setting',
            'locale' => 'en'
        ]);
    }
}

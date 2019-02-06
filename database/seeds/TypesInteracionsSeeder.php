<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TypesInteracionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_interactions')->insert([
            'desc' => 'like',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('types_interactions')->insert([
            'desc' => 'retweet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('types_interactions')->insert([
            'desc' => 'reply',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}

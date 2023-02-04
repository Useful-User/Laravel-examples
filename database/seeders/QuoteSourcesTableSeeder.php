<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quote_sources')->insert([
            'name'      => 'quotes.rest',
            'url'       => 'https://quotes.rest/',
            'priority'  => 1,
        ]);
        
        DB::table('quote_sources')->insert([
            'name'      => 'catfact',
            'url'       => 'https://catfact.ninja/fact',
            'priority'  => 3,
        ]);
        
        DB::table('quote_sources')->insert([
            'name'      => 'favqs',
            'url'       => 'https://favqs.com/api/qotd',
            'priority'  => 2,
        ]);
    }
}

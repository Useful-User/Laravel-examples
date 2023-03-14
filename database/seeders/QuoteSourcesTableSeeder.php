<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteSourcesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('quote_sources')->insert([
            'name'          => 'quotes.rest',
            'url'           => 'https://quotes.rest/qod?language=en',
            'image_url'     => 'https://theysaidso.com/branding/theysaidso.png',
            'priority'      => 1,
            'availability'  => 1,
            'resource'      => 'QuotesRest',
        ]);

        DB::table('quote_sources')->insert([
            'name'          => 'catfact',
            'url'           => 'https://catfact.ninja/fact',
            'image_url'     => 'https://catfact.ninja/favicon.ico',
            'priority'      => 3,
            'availability'  => 1,
            'resource'      => 'Catfact',
        ]);

        DB::table('quote_sources')->insert([
            'name'          => 'favqs',
            'url'           => 'https://favqs.com/api/qotd',
            'image_url'     => 'https://favqs.s3.amazonaws.com/q144.png',
            'priority'      => 2,
            'availability'  => 1,
            'resource'      => 'Favqs',
        ]);
    }
}

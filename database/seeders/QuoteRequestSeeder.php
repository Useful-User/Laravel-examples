<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\QuoteRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuoteRequest::factory(100)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteContent::query()->firstOrCreate([], [
            'content' => SiteContent::defaultContent(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Architectural Consultation',
                'slug' => 'architectural-consultation',
                'icon' => 'Architecture',
                'short_description' => 'For both Interiors + Exteriors',
                'description' => "We create refined, functional interiors that reflect your lifestyle-balancing comfort, sophistication, and thoughtful material choices.",
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'End-to-End Design and Build',
                'slug' => 'end-to-end-design-build',
                'icon' => 'Design Build',
                'short_description' => '360 degree solutions for a hassle free space',
                'description' => "From boutique stores to modern offices, we design spaces that communicate your brand while enhancing flow and functionality.",
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Full-Service Construction',
                'slug' => 'full-service-construction',
                'icon' => 'Construction',
                'short_description' => 'From concept to completion, every plot directed.',
                'description' => "We reimagine interiors through spatial planning and built-in elements, blending form, function, and architectural intent.",
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Interior Design and Execution',
                'slug' => 'interior-design-execution',
                'icon' => 'Interiors',
                'short_description' => 'Environments built to impact.',
                'description' => "From sourcing to placement, we curate furniture and decor that elevate each room and bring out the soul of the space.",
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Renovation and Remodeling',
                'slug' => 'renovation-remodeling',
                'icon' => 'Renovation',
                'short_description' => 'Breathing new life into spaces',
                'description' => "We guide you through renovations with clarity-aligning vision, budget, and process for results that feel fresh and enduring.",
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Curated Furnishings and Styling',
                'slug' => 'curated-furnishings-styling',
                'icon' => 'Styling',
                'short_description' => 'From bare structures to curated blockbusters',
                'description' => "We guide you through renovations with clarity-aligning vision, budget, and process for results that feel fresh and enduring.",
                'display_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->firstOrCreate(['slug' => $service['slug']], $service);
        }
    }
}

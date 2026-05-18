<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Courtyard Villa, Bengaluru',
                'slug' => 'courtyard-villa-bengaluru',
                'category' => 'Residential',
                'location' => 'Bengaluru',
                'year_label' => '2025',
                'cover_image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1600210492493-0946911123ea?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1600566753151-384129cf4e3e?auto=format&fit=crop&w=1200&q=80',
                ],
                'project_area' => '5,200 sq.ft',
                'status_label' => 'Completed',
                'summary' => 'A contemporary villa organized around light-filled courtyards and layered materials.',
                'description' => "This villa was conceived around a central courtyard that anchors visual continuity across levels.\nNatural stone, timber accents, and controlled daylight create a calm, hospitality-driven residential experience.",
                'display_order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Retail Flagship, Hyderabad',
                'slug' => 'retail-flagship-hyderabad',
                'category' => 'Commercial',
                'location' => 'Hyderabad',
                'year_label' => '2024',
                'cover_image' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=1400&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1493666438817-866a91353ca9?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1200&q=80',
                ],
                'project_area' => '3,100 sq.ft',
                'status_label' => 'Completed',
                'summary' => 'A high-footfall retail environment with strategic zoning and elevated material identity.',
                'description' => "Designed for strong brand recall, this flagship store combines curated lighting with linear sightlines to guide customer movement.\nBack-end operations, display systems, and customer experience were optimized as one integrated plan.",
                'display_order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Executive Workspace, Chennai',
                'slug' => 'executive-workspace-chennai',
                'category' => 'Commercial',
                'location' => 'Chennai',
                'year_label' => '2025',
                'cover_image' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1400&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1200&q=80',
                ],
                'project_area' => '6,800 sq.ft',
                'status_label' => 'Completed',
                'summary' => 'A modern office with collaborative zones, acoustic strategy, and refined finishes.',
                'description' => "This office fit-out balances productivity and employee well-being through a hierarchy of focused and social zones.\nMaterial and lighting choices were calibrated to deliver a premium yet human-centered workplace.",
                'display_order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Penthouse Renovation, Bengaluru',
                'slug' => 'penthouse-renovation-bengaluru',
                'category' => 'Residential',
                'location' => 'Bengaluru',
                'year_label' => '2023',
                'cover_image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1400&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1616046229478-9901c5536a45?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1618221118493-9cfa1a1c00da?auto=format&fit=crop&w=1200&q=80',
                ],
                'project_area' => '4,000 sq.ft',
                'status_label' => 'Completed',
                'summary' => 'A dated penthouse transformed into a warm, gallery-like family home.',
                'description' => "The renovation opened up key visual corridors and introduced a restrained material palette with rich textures.\nCustom joinery and precise lighting details elevated the spatial experience while retaining functionality.",
                'display_order' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::query()->firstOrCreate(['slug' => $project['slug']], $project);
        }
    }
}

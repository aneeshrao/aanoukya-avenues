<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sandeep Rao',
                'client_title' => 'Homeowner',
                'company' => null,
                'rating' => 5,
                'quote' => 'The team translated our lifestyle into architecture with exceptional clarity. Every stage was transparent and disciplined.',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Nikita Sharma',
                'client_title' => 'Founder',
                'company' => 'Nikka Retail',
                'rating' => 5,
                'quote' => 'From design intent to final fit-out, execution quality was consistent and timelines were handled professionally.',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Arjun Mehta',
                'client_title' => 'Director',
                'company' => 'Aurelius Consulting',
                'rating' => 5,
                'quote' => 'Aanoukya Avenues delivered a workspace that is functional, calm, and aligned with our brand language.',
                'display_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->firstOrCreate([
                'client_name' => $testimonial['client_name'],
                'company' => $testimonial['company'],
            ], $testimonial);
        }
    }
}

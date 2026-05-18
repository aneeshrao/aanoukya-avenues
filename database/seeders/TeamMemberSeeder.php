<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Anirud G Nayak',
                'role' => 'Co-Founder',
                'photo' => '/images/anirudh.avif',
                'experience_label' => '9+ years of experience in Sales, Business Development and Team Leadership',
                'bio' => 'We are a team of the most talented and reliable people with 20+ years of combined experience and unmatched partnership.',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ajay Charkravarthy S',
                'role' => 'Co-Founder',
                'photo' => '/images/ajay.avif',
                'experience_label' => '12+ years of experience in Sales Management, Business Consulting and channel partner alliances',
                'bio' => 'Our team unites designers, architects, and builders who care about every detail.',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Ashrita Nayak',
                'role' => 'Architect',
                'photo' => '/images/ashritha.avif',
                'experience_label' => '12+ years of experience in Architectural Design, Master Planning and Luxury Interiors',
                'bio' => 'Seemlessly executed with a design-first approach from concept to completion.',
                'display_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::query()->firstOrCreate([
                'name' => $member['name'],
                'role' => $member['role'],
            ], $member);
        }
    }
}

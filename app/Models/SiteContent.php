<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['content'])]
class SiteContent extends Model
{
    protected function casts(): array
    {
        return [
            'content' => AsArrayObject::class,
        ];
    }

    public static function current(): self
    {
        return self::query()->firstOrCreate([], [
            'content' => self::defaultContent(),
        ]);
    }

    public static function mergedContent(): array
    {
        $content = self::defaultContent();
        $stored = self::current()->content;

        if ($stored instanceof \ArrayObject) {
            $stored = $stored->getArrayCopy();
        }

        if (is_array($stored)) {
            $content = array_replace_recursive($content, $stored);
        }

        return $content;
    }

    public static function defaultContent(): array
    {
        return [
            'meta' => [
                'title' => 'Aanoukya Avenues | Architecture & Construction',
                'description' => 'Aanoukya Avenues designs and builds premium residential and commercial spaces with precision, transparency, and timeless aesthetics.',
            ],
            'header' => [
                'logo_alt' => 'Aanoukya Avenues logo',
                'nav_home' => 'Home',
                'nav_about' => 'About',
                'nav_services' => 'Services',
                'nav_portfolio' => 'Portfolio',
                'cta_label' => 'Get in Touch',
            ],
            'home' => [
                'hero_kicker' => 'Aanoukya Avenues',
                'hero_title_line_1' => "We're the Twist your Plot needs.",
                'hero_title_line_2' => "Bengaluru's End-to-End",
                'hero_title_line_3' => 'Design + Build Studio.',
                'hero_description' => 'We design, build and deliver complete homes and commercial spaces from the first sketch to the final finish. One team. Zero chaos.',
                'hero_primary_cta' => 'Get Started Now',
                'hero_secondary_cta' => 'Scroll down to see projects',
                'showcase_tag' => 'Past work showcase',
                'showcase_title' => 'Our Promise: Full-service construction and design by one team.',
                'marquee_items' => [
                    'Architectural Consultation',
                    'End-to-End Design+Build Solutions',
                    'Full-Service Construction',
                    'Interior Design & Execution',
                    'Renovation & Remodeling',
                ],
                'difference_tag' => 'The Twist that makes a Difference',
                'difference_title' => "Most construction projects are horror stories of delays and budget jumps. We're here to change your nightmares into dreams.",
                'difference_cards' => [
                    [
                        'title' => 'Stress-Free Set',
                        'desc' => 'Like film directors, we dont leave the story to chance. From blurprint to build, we direct every scene',
                    ],
                    [
                        'title' => 'Award-Winning Finishes',
                        'desc' => 'Crafting blockbusters, not just buildings. Every corner is a masterclass in composition and craft.',
                    ],
                    [
                        'title' => 'No Hidden Scenes',
                        'desc' => 'Building trust as solid as our structures, ensuring no unwelcome surprises. Pay once and enjoy the show.',
                    ],
                    [
                        'title' => 'The Finest Props',
                        'desc' => 'The twist that elevates every surface and makes your home a star.',
                    ],
                ],
                'stats' => [
                    ['value' => '80+', 'label' => 'Tailored home environments'],
                    ['value' => '50+', 'label' => 'Retail & office transformations'],
                    ['value' => '25+', 'label' => 'Architectural layout projects'],
                    ['value' => '65+', 'label' => 'Styled and furnished spaces'],
                ],
                'services_tag' => 'Services',
                'services_title' => 'The Twists we can give to your Plot. Serving both Residential and Commercial clients across all services.',
                'services_cta' => 'View All Services',
                'featured_tag' => 'Featured projects',
                'featured_title' => 'A curated portfolio of built experiences.',
                'featured_cta' => 'View Portfolio',
                'process_tag' => 'Our process',
                'process_title' => 'Our 5 Step Process: From vision to Reality.',
                'process_steps' => [
                    [
                        'title' => 'Discovery + Vision',
                        'desc' => 'We start by understanding your lifestyle, aspirations, and functional needs.',
                        'image' => 'https://images.unsplash.com/photo-1618221469555-7f3ad97540d6?auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'title' => 'Approvals + Closure',
                        'desc' => 'We finalize technical drawings, selections, approvals, and final contract.',
                        'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'title' => 'Concept + Design',
                        'desc' => 'Detailed 3D design direction transforms intent into a build-ready vision.',
                        'image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'title' => 'Procurement + Supply',
                        'desc' => 'In-house sourcing keeps quality high and timelines transparent.',
                        'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb3?auto=format&fit=crop&w=1200&q=80',
                    ],
                    [
                        'title' => 'After Care',
                        'desc' => 'Our relationship continues after handover with long-term support.',
                        'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80',
                    ],
                ],
                'leadership_tag' => 'Leadership',
                'leadership_title' => 'Meet the Masterminds.',
                'leadership_cta' => 'Meet the Team',
                'testimonials_tag' => 'Testimonials',
                'testimonials_title' => 'What clients value most.',
                'testimonials_caption' => 'Trusted by homeowners and brands',
                'final_cta_tag' => "Let's begin",
                'final_cta_title' => 'Directed by Aanoukya Avenues. Produced by Craft and Legacy.',
                'final_cta_description' => 'Set Design by Time and Space. Written, always, by you.',
                'final_cta_button' => 'Get Started Now',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1617104551722-3b2d51366400?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1615529182904-14819c35db37?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1616137466211-f939a420be84?auto=format&fit=crop&w=1200&q=80',
                ],
                'gallery_images_reverse' => [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1600573472550-8090b5e0745e?auto=format&fit=crop&w=900&q=80',
                    'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1598928636135-d146006ff4be?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            'about' => [
                'tag' => 'Our team',
                'title' => 'Meet the Masterminds.',
                'description' => 'Our team unites designers, architects, and builders who care about every detail.',
                'pillars' => [
                    [
                        'title' => 'Design clarity',
                        'desc' => 'Every project starts with clear spatial logic and user-focused planning.',
                    ],
                    [
                        'title' => 'Material integrity',
                        'desc' => 'We are a team of the most talented and reliable people with 20+ years of combined experience and unmatched Partnership.',
                    ],
                    [
                        'title' => 'Seemlessly Executed',
                        'desc' => '2025, No Best-sellers, are made without a, CREW.',
                    ],
                ],
                'team_tag' => 'Team',
                'team_title' => 'People behind every successful build.',
            ],
            'services_page' => [
                'tag' => 'Services',
                'title' => 'The Twists we can give to your Plot.',
                'description' => 'Serving both Residential and Commercial clients across all services.',
                'card_cta' => 'Discover',
                'empty_text' => 'No services available yet.',
                'show_back' => 'Back to services',
                'show_cta' => 'Discuss This Service',
            ],
            'projects_page' => [
                'tag' => 'Portfolio',
                'title' => 'Selected projects across residential and commercial typologies.',
                'filter_all' => 'All',
                'empty_text' => 'No projects available yet.',
                'pagination_previous' => 'Previous',
                'pagination_next' => 'Next',
                'show_back' => 'Back to portfolio',
                'show_narrative_title' => 'Project narrative',
            ],
            'contact_page' => [
                'tag' => 'Contact us',
                'title' => 'Get in touch',
                'description' => 'Share your requirements and we will get back with a focused consultation roadmap.',
                'form_button' => 'Send Inquiry',
                'studio_title' => 'Studio Information',
                'phone_label' => 'Phone',
                'phone_value' => '+1 0239 0310 1122',
                'phone_link' => '+1023903101122',
                'email_label' => 'Email',
                'email_value' => 'support@gleamer.com',
                'address_label' => 'Address',
                'address_value' => 'Blane Street, Manchester',
                'success_message' => 'Thanks for reaching out. Our team will contact you shortly.',
                'error_message' => 'Please review the highlighted fields and try again.',
            ],
            'footer' => [
                'quick_links_title' => 'Quick Links',
                'studio_title' => 'Studio',
                'studio_city' => 'Bengaluru, Karnataka',
                'studio_phone' => '+91 98765 43210',
                'studio_email' => 'hello@aanoukyaavenues.com',
                'nav_contact' => 'Contact',
                'social_title' => 'Social',
                'social_links' => [
                    ['label' => 'Instagram', 'url' => 'https://instagram.com'],
                    ['label' => 'Facebook', 'url' => 'https://facebook.com'],
                    ['label' => 'LinkedIn', 'url' => 'https://linkedin.com'],
                    ['label' => 'YouTube', 'url' => 'https://youtube.com'],
                ],
                'copyright_suffix' => 'Aanoukya Avenues. Built with precision.',
            ],
        ];
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PortfolioPagesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_portfolio_sections_and_project_details_have_separate_pages(): void
    {
        $pages = [
            '/' => 'Merancang ide.',
            '/about' => 'Tentang Saya',
            '/music' => 'Menjaga fokus.',
            '/projects' => 'Cyber GYZIN',
            '/certificates' => 'Sertifikat',
            '/achievements' => 'Pencapaian',
            '/tech-stack' => 'Teknologi',
            '/contact' => 'Kontak',
            '/projects/cyber-gyzin' => 'Cyber GYZIN',
        ];

        foreach ($pages as $uri => $content) {
            $this->get($uri)->assertOk()->assertSee($content, false);
        }
    }

    public function test_visitors_can_post_and_view_a_comment(): void
    {
        $this->post(route('comments.store'), [
            'name' => 'Portfolio Test Visitor',
            'email' => 'visitor@example.com',
            'message' => 'The portfolio looks great.',
            'website' => '',
        ])->assertRedirect(route('portfolio.page', ['page' => 'contact']));

        $this->get(route('portfolio.page', ['page' => 'contact']))
            ->assertOk()
            ->assertSee('Portfolio Test Visitor')
            ->assertSee('The portfolio looks great.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PortfolioComment;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    private const PAGES = [
        'about' => ['title' => 'Tentang Saya', 'section' => 'Profil dan perjalanan'],
        'music' => ['title' => 'Inspirasi', 'section' => 'Musik dan proses kreatif'],
        'projects' => ['title' => 'Proyek', 'section' => 'Karya pilihan'],
        'certificates' => ['title' => 'Sertifikat', 'section' => 'Pembelajaran dan sertifikasi'],
        'achievements' => ['title' => 'Pencapaian', 'section' => 'Apresiasi dan milestone'],
        'tech-stack' => ['title' => 'Teknologi', 'section' => 'Perangkat dan teknologi'],
        'contact' => ['title' => 'Kontak', 'section' => 'Mari terhubung'],
    ];

    private const PROJECTS = [
        'cyber-gyzin' => [
            'title' => 'Cyber GYZIN',
            'category' => 'WEB APP',
            'description' => 'Eksplorasi konsep dashboard bertema cyber yang menyajikan panel status, kartu fitur, dan elemen visual bernuansa neon. Proyek ini menaruh perhatian pada hierarki informasi serta keseimbangan antara karakter visual yang kuat dan kemudahan membaca antarmuka.',
            'technologies' => ['HTML', 'CSS', 'JavaScript'],
            'mark' => 'CYBER GYZIN',
        ],
        'bot-generate-artikel' => [
            'title' => 'Bot Generate Artikel',
            'category' => 'AI TOOL',
            'description' => 'Konsep alat bantu penulisan yang menggunakan topik dan kata kunci sebagai titik awal untuk menyusun draft artikel. Alur ini dirancang untuk membantu proses eksplorasi ide, sementara hasil akhirnya tetap ditinjau dan disunting oleh pengguna.',
            'technologies' => ['Python', 'Gemini', 'Chromium'],
            'mark' => 'ARTICLE / AI',
        ],
        'database-siswa' => [
            'title' => 'Database Siswa',
            'category' => 'EDUCATION',
            'description' => 'Konsep aplikasi administrasi sederhana untuk mengelola data siswa melalui alur pencatatan, peninjauan, pembaruan, dan penghapusan. Fokus eksplorasinya adalah struktur data yang rapi dan antarmuka yang mudah dipahami.',
            'technologies' => ['PHP', 'MySQL', 'CRUD'],
            'mark' => 'STUDENT DB',
        ],
    ];

    public function home(): View
    {
        return view('welcome', [
            'page' => 'home',
            'pageTitle' => 'Home',
            'pageSection' => 'Pengembangan web dan eksplorasi digital',
        ]);
    }

    public function show(string $page): View
    {
        abort_unless(array_key_exists($page, self::PAGES), 404);

        $comments = $page === 'contact'
            ? PortfolioComment::query()->latest()->limit(50)->get()
            : collect();

        return view('welcome', [
            'page' => $page,
            'pageTitle' => self::PAGES[$page]['title'],
            'pageSection' => self::PAGES[$page]['section'],
            'comments' => $comments,
        ]);
    }

    public function project(string $project): View
    {
        abort_unless(array_key_exists($project, self::PROJECTS), 404);

        return view('welcome', [
            'page' => 'project-detail',
            'pageTitle' => self::PROJECTS[$project]['title'],
            'pageSection' => 'Ringkasan proyek',
            'project' => self::PROJECTS[$project],
        ]);
    }
}

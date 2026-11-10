<?php

namespace App\Http\Controllers;

use App\Models\PortfolioComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PortfolioCommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:254'],
            'message' => ['required', 'string', 'min:2', 'max:1000'],
            'website' => ['nullable', 'size:0'],
        ]);

        PortfolioComment::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('portfolio.page', ['page' => 'contact'])
            ->with('status', 'Komentar berhasil dikirim.');
    }
}

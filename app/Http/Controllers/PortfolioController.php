<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Contact;

class PortfolioController extends Controller
{
    public function index()
    {
        // Mengambil semua skill
        // Mengambil 2-3 proyek terbaru untuk ditampilkan di area "Blog" (sebagai Featured)
        $featuredProjects = \App\Models\Project::where('is_published', true)
            ->latest()
            ->get();

        $projects = \App\Models\Project::where('is_published', true)->get();
        $skills = \App\Models\Skill::all();

        return view('dashboard.index', compact('skills', 'projects', 'featuredProjects'));
    }
    public function show($slug)
    {
        // Cari proyek berdasarkan slug atau tampilkan 404 jika tidak ketemu
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('dashboard.show', compact('project'));
    }
    public function storeContact(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // 1. Simpan ke Database
    Contact::create($request->all());

    // 2. Format Pesan untuk WhatsApp
    $nomor_wa = "6282132448502"; // Ganti dengan nomor WA Anda (awali dengan 62)
    $teks_wa = "Halo Iqbal, ada pesan baru dari Portofolio!\n\n"
             . "Nama: " . $request->name . "\n"
             . "Email: " . $request->email . "\n"
             . "Pesan: " . $request->message;

    $url_wa = "https://api.whatsapp.com/send?phone=" . $nomor_wa . "&text=" . urlencode($teks_wa);

    // Redirect ke WhatsApp (User akan otomatis diarahkan untuk kirim chat)
    return redirect()->away($url_wa);
}
}

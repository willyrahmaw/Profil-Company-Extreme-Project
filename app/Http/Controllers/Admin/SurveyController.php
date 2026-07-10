<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $responses = SurveyResponse::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.surveys.index', compact('responses'));
    }

    public function show(SurveyResponse $survey)
    {
        // Define the question mapping for easy labeling in details
        $questionsMap = [
            "Q1" => "Sudah berapa lama Anda menggunakan vape?",
            "Q2" => "Jenis atomizer yang paling sering Anda gunakan?",
            "Q3" => "Jenis liquid yang paling sering Anda gunakan?",
            "Q4" => "Apakah Anda langsung memahami produk yang dijual setelah membuka website?",
            "Q5" => "Bagian pertama yang paling menarik perhatian Anda?",
            "Q6" => "Seberapa mudah Anda menemukan informasi yang dicari?",
            "Q7" => "Nilai kemudahan navigasi website.",
            "Q8" => "Apakah Anda memahami perbedaan setiap varian coil (V1–V6)?",
            "Q9" => "Bagian mana yang masih membingungkan mengenai produk kami?",
            "Q10" => "Informasi apa yang paling Anda cari sebelum membeli coil?",
            "Q11" => "Informasi apa yang menurut Anda masih kurang di halaman produk?",
            "Q12" => "Apakah Anda membutuhkan halaman edukasi mengenai coil?",
            "Q13" => "Topik edukasi apa yang ingin Anda pelajari?",
            "Q14" => "Setelah melihat website, apakah Anda tertarik membeli?",
            "Q15" => "Jika belum yakin membeli, apa penyebab utamanya?",
            "Q16" => "Apa yang dapat membuat Anda lebih yakin untuk membeli produk kami?",
            "Q17" => "Informasi apa yang membuat Anda lebih percaya terhadap sebuah brand?",
            "Q18" => "Apakah website perlu fitur Compare Product?",
            "Q19" => "Apakah Anda ingin website memberikan rekomendasi coil sesuai kebutuhan Anda?",
            "Q20" => "Fitur apa yang ingin Anda lihat di website?",
            "Q21" => "Berikan penilaian terhadap website kami.",
            "Q22" => "Jika Anda adalah pemilik EXTREME PROJECT, tiga hal apa yang akan Anda ubah pada website ini agar menjadi lebih baik?",
            "Q23" => "Bayangkan Anda baru pertama kali mengenal EXTREME PROJECT. Setelah melihat website selama 3 menit, apa yang membuat Anda ragu untuk membeli? Jelaskan sejujur mungkin.",
        ];

        return view('admin.surveys.show', compact('survey', 'questionsMap'));
    }

    public function destroy(SurveyResponse $survey)
    {
        $survey->delete();
        return redirect()->route('admin.surveys.index')->with('success', 'Hasil survei berhasil dihapus.');
    }
}

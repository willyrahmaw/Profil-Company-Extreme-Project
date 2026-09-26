<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SurveyController extends Controller
{
    public function show()
    {
        return view('survey', ['survey' => $this->definition()]);
    }

    private function definition(): array
    {
        return [
            "research_title" => "EXTREME PROJECT - Customer Experience & Website Research",
            "description" => "Kami sedang mengembangkan website resmi EXTREME PROJECT agar menjadi pusat e-commerce sekaligus pusat edukasi. Mohon luangkan waktu 5–10 menit untuk membantu kami dengan menjawab beberapa pertanyaan berikut.",
            "sections" => [
                [
                    "title" => "Profil Pengguna",
                    "questions" => [
                        [
                            "id" => "Q1",
                            "type" => "single_choice",
                            "question" => "Sudah berapa lama Anda menggunakan vape?",
                            "options" => [
                                "Kurang dari 3 bulan",
                                "3–12 bulan",
                                "1–3 tahun",
                                "Lebih dari 3 tahun"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q2",
                            "type" => "single_choice",
                            "question" => "Jenis atomizer yang paling sering Anda gunakan?",
                            "options" => [
                                "RDA",
                                "RTA",
                                "RDTA",
                                "MTL",
                                "Lainnya"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q3",
                            "type" => "multiple_choice",
                            "question" => "Jenis liquid yang paling sering Anda gunakan?",
                            "options" => [
                                "Fruity",
                                "Creamy",
                                "Dessert",
                                "Menthol",
                                "Tobacco",
                                "Salt Nic",
                                "Freebase"
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Pengalaman Menggunakan Website",
                    "questions" => [
                        [
                            "id" => "Q4",
                            "type" => "single_choice",
                            "question" => "Apakah Anda langsung memahami produk yang dijual setelah membuka website?",
                            "options" => [
                                "Sangat jelas",
                                "Cukup jelas",
                                "Kurang jelas",
                                "Tidak paham sama sekali"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q5",
                            "type" => "single_choice",
                            "question" => "Bagian pertama yang paling menarik perhatian Anda?",
                            "options" => [
                                "Hero Banner",
                                "Produk",
                                "Warna Website",
                                "Penjelasan Produk",
                                "Tidak ada"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q6",
                            "type" => "rating",
                            "question" => "Seberapa mudah Anda menemukan informasi yang dicari?",
                            "scale" => [
                                "min" => 1,
                                "max" => 10,
                                "minLabel" => "Sangat Sulit",
                                "maxLabel" => "Sangat Mudah"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q7",
                            "type" => "rating",
                            "question" => "Nilai kemudahan navigasi website.",
                            "scale" => [
                                "min" => 1,
                                "max" => 10,
                                "minLabel" => "Sulit",
                                "maxLabel" => "Sangat Mudah"
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Informasi Produk",
                    "questions" => [
                        [
                            "id" => "Q8",
                            "type" => "single_choice",
                            "question" => "Apakah Anda memahami perbedaan setiap varian coil (V1–V6)?",
                            "options" => [
                                "Sangat Paham",
                                "Lumayan Paham",
                                "Sedikit Paham",
                                "Tidak Paham"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q9",
                            "type" => "long_text",
                            "question" => "Bagian mana yang masih membingungkan mengenai produk kami?",
                            "required" => true
                        ],
                        [
                            "id" => "Q10",
                            "type" => "multiple_choice",
                            "question" => "Informasi apa yang paling Anda cari sebelum membeli coil?",
                            "options" => [
                                "Flavor",
                                "Sweetness",
                                "Throat Hit",
                                "Durability",
                                "Material",
                                "Harga",
                                "Recommended Watt",
                                "Cocok untuk Liquid",
                                "Cocok untuk Atomizer",
                                "Cara Pemasangan",
                                "Video Penggunaan",
                                "Review Pengguna"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q11",
                            "type" => "long_text",
                            "question" => "Informasi apa yang menurut Anda masih kurang di halaman produk?",
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Customer Education",
                    "questions" => [
                        [
                            "id" => "Q12",
                            "type" => "single_choice",
                            "question" => "Apakah Anda membutuhkan halaman edukasi mengenai coil?",
                            "options" => [
                                "Ya",
                                "Tidak"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q13",
                            "type" => "multiple_choice",
                            "question" => "Topik edukasi apa yang ingin Anda pelajari?",
                            "options" => [
                                "Cara Memilih Coil",
                                "Cara Memasang Coil",
                                "Cara Priming",
                                "Cara Membersihkan Coil",
                                "Mengapa Coil Cepat Gosong",
                                "Tips Memperpanjang Umur Coil",
                                "Perbedaan Semua Coil",
                                "Perbedaan Material",
                                "Setting Watt",
                                "Jenis Liquid"
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Keputusan Membeli",
                    "questions" => [
                        [
                            "id" => "Q14",
                            "type" => "single_choice",
                            "question" => "Setelah melihat website, apakah Anda tertarik membeli?",
                            "options" => [
                                "Sangat Tertarik",
                                "Mungkin",
                                "Belum Yakin",
                                "Tidak Tertarik"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q15",
                            "type" => "multiple_choice",
                            "question" => "Jika belum yakin membeli, apa penyebab utamanya?",
                            "options" => [
                                "Harga",
                                "Kurang Informasi",
                                "Kurang Percaya",
                                "Belum Paham Perbedaan Produk",
                                "Desain Website",
                                "Tidak Menemukan Produk yang Cocok",
                                "Tidak Ada Review",
                                "Tidak Ada Video"
                            ],
                            "required" => false
                        ],
                        [
                            "id" => "Q16",
                            "type" => "long_text",
                            "question" => "Apa yang dapat membuat Anda lebih yakin untuk membeli produk kami?",
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Kepercayaan Terhadap Brand",
                    "questions" => [
                        [
                            "id" => "Q17",
                            "type" => "multiple_choice",
                            "question" => "Informasi apa yang membuat Anda lebih percaya terhadap sebuah brand?",
                            "options" => [
                                "Review Pelanggan",
                                "Video Penggunaan",
                                "Foto Asli Produk",
                                "Garansi",
                                "Marketplace Resmi",
                                "Instagram Aktif",
                                "TikTok Aktif",
                                "Jumlah Pelanggan",
                                "Lama Berdiri",
                                "Behind The Scene Produksi",
                                "Quality Control",
                                "Sertifikasi Produk"
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Fitur Website",
                    "questions" => [
                        [
                            "id" => "Q18",
                            "type" => "single_choice",
                            "question" => "Apakah website perlu fitur Compare Product?",
                            "options" => [
                                "Sangat Perlu",
                                "Perlu",
                                "Tidak Terlalu Perlu",
                                "Tidak Perlu"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q19",
                            "type" => "single_choice",
                            "question" => "Apakah Anda ingin website memberikan rekomendasi coil sesuai kebutuhan Anda?",
                            "options" => [
                                "Ya",
                                "Tidak"
                            ],
                            "required" => true
                        ],
                        [
                            "id" => "Q20",
                            "type" => "multiple_choice",
                            "question" => "Fitur apa yang ingin Anda lihat di website?",
                            "options" => [
                                "Coil Finder",
                                "Compare Product",
                                "FAQ",
                                "Video Tutorial",
                                "Blog Edukasi",
                                "Tips & Trick",
                                "WhatsApp Chat",
                                "Live Chat",
                                "Wishlist",
                                "Loyalty Program",
                                "Promo",
                                "Komunitas"
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Penilaian Website",
                    "questions" => [
                        [
                            "id" => "Q21",
                            "type" => "matrix_rating",
                            "question" => "Berikan penilaian terhadap website kami.",
                            "rows" => [
                                "Desain",
                                "Kemudahan Penggunaan",
                                "Informasi Produk",
                                "Kepercayaan",
                                "Kecepatan Website",
                                "Kemudahan Membeli",
                                "Customer Education",
                                "Versi Mobile",
                                "Versi Desktop"
                            ],
                            "scale" => [
                                "min" => 1,
                                "max" => 10
                            ],
                            "required" => true
                        ]
                    ]
                ],
                [
                    "title" => "Masukan Terbuka",
                    "questions" => [
                        [
                            "id" => "Q22",
                            "type" => "long_text",
                            "question" => "Jika Anda adalah pemilik EXTREME PROJECT, tiga hal apa yang akan Anda ubah pada website ini agar menjadi lebih baik?",
                            "required" => true
                        ],
                        [
                            "id" => "Q23",
                            "type" => "long_text",
                            "question" => "Bayangkan Anda baru pertama kali mengenal EXTREME PROJECT. Setelah melihat website selama 3 menit, apa yang membuat Anda ragu untuk membeli? Jelaskan sejujur mungkin.",
                            "required" => true
                        ]
                    ]
                ]
            ]
        ];
    }

    public function store(Request $request)
    {
        $rules = [];

        foreach ($this->definition()['sections'] as $section) {
            foreach ($section['questions'] as $question) {
                $key = 'answers.'.$question['id'];
                $presence = $question['required'] ? 'required' : 'nullable';

                switch ($question['type']) {
                    case 'single_choice':
                        $rules[$key] = [$presence, 'string', Rule::in($question['options'])];
                        break;
                    case 'multiple_choice':
                        $rules[$key] = [$presence, 'array', $question['required'] ? 'min:1' : 'min:0', 'max:'.count($question['options'])];
                        $rules[$key.'.*'] = ['string', 'distinct', Rule::in($question['options'])];
                        break;
                    case 'rating':
                        $rules[$key] = [$presence, 'integer', 'between:'.$question['scale']['min'].','.$question['scale']['max']];
                        break;
                    case 'long_text':
                        $rules[$key] = [$presence, 'string', 'max:5000'];
                        break;
                    case 'matrix_rating':
                        $rowKeys = array_map(fn (string $row) => str_replace(' ', '_', $row), $question['rows']);
                        $rules[$key] = [$presence, 'array:'.implode(',', $rowKeys)];
                        foreach ($rowKeys as $rowKey) {
                            $rules[$key.'.'.$rowKey] = ['required', 'integer', 'between:'.$question['scale']['min'].','.$question['scale']['max']];
                        }
                        break;
                }
            }
        }

        $validated = $request->validate($rules, [
            'answers.*.required' => 'Pertanyaan ini wajib dijawab.',
            'answers.*.min' => 'Pilih minimal :min opsi.',
            'answers.*.in' => 'Pilihan jawaban tidak valid.',
            'answers.*.*.in' => 'Pilihan jawaban tidak valid.',
            'answers.*.max' => 'Jawaban terlalu panjang (maksimal :max karakter).',
            'answers.Q21.*.required' => 'Semua baris penilaian wajib diisi.',
        ]);

        SurveyResponse::create([
            'ip_address' => $request->ip(),
            'session_id' => session()->getId(),
            // Only store answers that passed validation; unknown keys are dropped.
            'answers' => $validated['answers'],
        ]);

        return redirect()->route('research.show')->with('success_survey', 'Terima kasih banyak atas partisipasi Anda! Masukan Anda sangat berharga bagi pengembangan EXTREME PROJECT.');
    }
}

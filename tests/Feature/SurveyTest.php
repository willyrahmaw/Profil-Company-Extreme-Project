<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\SurveyResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SurveyTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test public questionnaire page renders correctly.
     */
    public function test_public_survey_page_loads(): void
    {
        $response = $this->get(route('research.show'));

        $response->assertOk();
        $response->assertSee('EXTREME PROJECT - Customer Experience & Website Research');
        $response->assertSee('Sudah berapa lama Anda menggunakan vape?');
    }

    /**
     * Test successful survey response submission.
     */
    public function test_survey_submission_saves_to_database(): void
    {
        $answers = [
            'Q1' => 'Kurang dari 3 bulan',
            'Q2' => 'RDA',
            'Q3' => ['Fruity', 'Creamy'],
            'Q4' => 'Sangat jelas',
            'Q5' => 'Hero Banner',
            'Q6' => 8,
            'Q7' => 9,
            'Q8' => 'Sangat Paham',
            'Q9' => 'Tidak ada yang membingungkan.',
            'Q10' => ['Flavor', 'Price'],
            'Q11' => 'Semua sudah cukup jelas.',
            'Q12' => 'Ya',
            'Q13' => ['Cara Memilih Coil'],
            'Q14' => 'Sangat Tertarik',
            'Q15' => ['Harga'],
            'Q16' => 'Video review yang mendalam.',
            'Q17' => ['Review Pelanggan'],
            'Q18' => 'Sangat Perlu',
            'Q19' => 'Ya',
            'Q20' => ['Coil Finder'],
            'Q21' => [
                'Desain' => 9,
                'Kemudahan_Penggunaan' => 9,
                'Informasi_Produk' => 8,
                'Kepercayaan' => 9,
                'Kecepatan_Website' => 8,
                'Kemudahan_Membeli' => 9,
                'Customer_Education' => 8,
                'Versi_Mobile' => 9,
                'Versi_Desktop' => 9,
            ],
            'Q22' => 'Tambahkan live chat, tambahkan panduan, perbaiki loading.',
            'Q23' => 'Harga awal yang terlihat premium.',
        ];

        $response = $this->post(route('research.store'), [
            'answers' => $answers,
        ]);

        $response->assertRedirect(route('research.show'));
        $response->assertSessionHas('success_survey');

        $this->assertDatabaseHas('survey_responses', [
            'answers->Q1' => 'Kurang dari 3 bulan',
            'answers->Q2' => 'RDA',
        ]);
    }

    /**
     * Test survey validation prevents empty submissions.
     */
    public function test_survey_validation_errors(): void
    {
        $response = $this->post(route('research.store'), [
            'answers' => [
                'Q1' => '', // Required
            ],
        ]);

        $response->assertSessionHasErrors(['answers.Q1']);
    }

    /**
     * Test non-authenticated users cannot access admin surveys.
     */
    public function test_unauthenticated_cannot_access_admin_surveys(): void
    {
        $responseIndex = $this->get(route('admin.surveys.index'));
        $responseIndex->assertRedirect(route('login'));
    }

    /**
     * Test authenticated admin can manage surveys.
     */
    public function test_authenticated_admin_can_manage_surveys(): void
    {
        $admin = User::create([
            'name' => 'Test Admin',
            'email' => 'test-admin@vape.com',
            'password' => bcrypt('password'),
        ]);
        
        $survey = SurveyResponse::create([
            'answers' => [
                'Q1' => 'Kurang dari 3 bulan',
                'Q2' => 'RDA',
                'Q3' => ['Fruity'],
                'Q4' => 'Cukup jelas',
                'Q5' => 'Produk',
                'Q6' => 7,
                'Q7' => 8,
                'Q8' => 'Lumayan Paham',
                'Q9' => 'None',
                'Q10' => ['Harga'],
                'Q11' => 'None',
                'Q12' => 'Ya',
                'Q13' => ['Cara Memasang Coil'],
                'Q14' => 'Mungkin',
                'Q15' => ['Desain Website'],
                'Q16' => 'None',
                'Q17' => ['Foto Asli Produk'],
                'Q18' => 'Perlu',
                'Q19' => 'Ya',
                'Q20' => ['FAQ'],
                'Q21' => [
                    'Desain' => 8,
                    'Kemudahan_Penggunaan' => 8,
                    'Informasi_Produk' => 8,
                    'Kepercayaan' => 8,
                    'Kecepatan_Website' => 8,
                    'Kemudahan_Membeli' => 8,
                    'Customer_Education' => 8,
                    'Versi_Mobile' => 8,
                    'Versi_Desktop' => 8,
                ],
                'Q22' => 'None',
                'Q23' => 'None',
            ],
        ]);

        $response = $this->actingAs($admin)->get(route('admin.surveys.index'));
        $response->assertOk();
        $response->assertSee('Kurang dari 3 bulan');

        $responseShow = $this->actingAs($admin)->get(route('admin.surveys.show', $survey->id));
        $responseShow->assertOk();
        $responseShow->assertSee('Detail Jawaban Responden');

        $responseDelete = $this->actingAs($admin)->delete(route('admin.surveys.destroy', $survey->id));
        $responseDelete->assertRedirect(route('admin.surveys.index'));
        
        $this->assertDatabaseMissing('survey_responses', ['id' => $survey->id]);
    }
}

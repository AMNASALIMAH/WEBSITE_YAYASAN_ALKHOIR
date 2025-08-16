<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $program;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user
        $this->user = User::factory()->create();
        
        // Create a test program
        $this->program = Program::create([
            'nama_program' => 'Test Program',
            'deskripsi' => 'Test program description',
            'status' => 'active'
        ]);
    }

    /** @test */
    public function authenticated_user_can_access_student_management_page()
    {
        $response = $this->actingAs($this->user)
                        ->get('/admin/management/data-santri/content');

        $response->assertStatus(200);
        $response->assertViewIs('admin.management.data_santri.view_students');
    }

    /** @test */
    public function unauthenticated_user_cannot_access_student_management_page()
    {
        $response = $this->get('/admin/management/data-santri/content');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function can_create_new_student()
    {
        Storage::fake('public');

        $studentData = [
            'nis' => '12345',
            'nama_lengkap' => 'Test Student',
            'nama_panggilan' => 'Test',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'email_ortu' => 'parent@test.com',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01',
            'catatan' => 'Test notes'
        ];

        $response = $this->actingAs($this->user)
                        ->postJson('/admin/students', $studentData);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Data santri berhasil ditambahkan'
        ]);

        $this->assertDatabaseHas('students', [
            'nis' => '12345',
            'nama_lengkap' => 'Test Student'
        ]);
    }

    /** @test */
    public function can_create_student_with_photo()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('student.jpg');

        $studentData = [
            'nis' => '12346',
            'nama_lengkap' => 'Test Student with Photo',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01',
            'foto' => $file
        ];

        $response = $this->actingAs($this->user)
                        ->postJson('/admin/students', $studentData);

        $response->assertStatus(201);
        
        $this->assertDatabaseHas('students', [
            'nis' => '12346',
            'nama_lengkap' => 'Test Student with Photo'
        ]);

        // Check if photo was stored
        $student = Student::where('nis', '12346')->first();
        $this->assertNotNull($student->foto);
        $this->assertTrue(Storage::disk('public')->exists($student->foto));
    }

    /** @test */
    public function can_update_student()
    {
        $student = Student::create([
            'nis' => '12347',
            'nama_lengkap' => 'Original Name',
            'tempat_lahir' => 'Original City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Original Address',
            'nama_ortu' => 'Original Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $updateData = [
            'nama_lengkap' => 'Updated Name',
            'kelas' => 'XI'
        ];

        $response = $this->actingAs($this->user)
                        ->putJson("/admin/students/{$student->id}", $updateData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Data santri berhasil diperbarui'
        ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'nama_lengkap' => 'Updated Name',
            'kelas' => 'XI'
        ]);
    }

    /** @test */
    public function can_delete_student()
    {
        $student = Student::create([
            'nis' => '12348',
            'nama_lengkap' => 'Student to Delete',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->deleteJson("/admin/students/{$student->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Data santri berhasil dihapus'
        ]);

        $this->assertSoftDeleted('students', [
            'id' => $student->id
        ]);
    }

    /** @test */
    public function can_search_students()
    {
        // Create test students
        Student::create([
            'nis' => '12349',
            'nama_lengkap' => 'John Doe',
            'tempat_lahir' => 'City A',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Address A',
            'nama_ortu' => 'Parent A',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        Student::create([
            'nis' => '12350',
            'nama_lengkap' => 'Jane Smith',
            'tempat_lahir' => 'City B',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'alamat' => 'Address B',
            'nama_ortu' => 'Parent B',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'XI',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->getJson('/admin/students?search=John');

        $response->assertStatus(200);
        $data = $response->json();
        
        $this->assertCount(1, $data['data']);
        $this->assertEquals('John Doe', $data['data'][0]['nama_lengkap']);
    }

    /** @test */
    public function can_filter_students_by_status()
    {
        Student::create([
            'nis' => '12351',
            'nama_lengkap' => 'Active Student',
            'tempat_lahir' => 'City A',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Address A',
            'nama_ortu' => 'Parent A',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        Student::create([
            'nis' => '12352',
            'nama_lengkap' => 'Inactive Student',
            'tempat_lahir' => 'City B',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'alamat' => 'Address B',
            'nama_ortu' => 'Parent B',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'XI',
            'status' => 'nonaktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->getJson('/admin/students?status=aktif');

        $response->assertStatus(200);
        $data = $response->json();
        
        $this->assertCount(1, $data['data']);
        $this->assertEquals('Active Student', $data['data'][0]['nama_lengkap']);
    }

    /** @test */
    public function can_get_student_details()
    {
        $student = Student::create([
            'nis' => '12353',
            'nama_lengkap' => 'Test Student',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->getJson("/admin/students/{$student->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'id' => $student->id,
                'nis' => '12353',
                'nama_lengkap' => 'Test Student'
            ]
        ]);
    }

    /** @test */
    public function can_update_student_status()
    {
        $student = Student::create([
            'nis' => '12354',
            'nama_lengkap' => 'Status Test Student',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->patchJson("/admin/students/{$student->id}/status", [
                            'status' => 'lulus'
                        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Status santri berhasil diperbarui'
        ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'status' => 'lulus'
        ]);
    }

    /** @test */
    public function can_bulk_delete_students()
    {
        $student1 = Student::create([
            'nis' => '12355',
            'nama_lengkap' => 'Bulk Delete Student 1',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'X',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $student2 = Student::create([
            'nis' => '12356',
            'nama_lengkap' => 'Bulk Delete Student 2',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'alamat' => 'Test Address',
            'nama_ortu' => 'Test Parent',
            'telepon_ortu' => '08123456789',
            'program_id' => $this->program->id,
            'kelas' => 'XI',
            'status' => 'aktif',
            'tanggal_masuk' => '2024-01-01'
        ]);

        $response = $this->actingAs($this->user)
                        ->deleteJson('/admin/students/bulk', [
                            'ids' => [$student1->id, $student2->id]
                        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => '2 data santri berhasil dihapus'
        ]);

        $this->assertSoftDeleted('students', [
            'id' => $student1->id
        ]);
        $this->assertSoftDeleted('students', [
            'id' => $student2->id
        ]);
    }
}

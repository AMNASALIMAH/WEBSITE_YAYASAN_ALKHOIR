<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Program;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    public function getManagementStudentsContent()
    {
        $students = Student::with('program')->latest()->paginate(10);
        $programs = Program::active()->get();
        
        return view('admin.management.data_santri.view_students', compact('students', 'programs'));
    }

    public function index()
    {
        $students = Student::with('program')
            ->when(request('search'), function($query, $search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%")
                      ->orWhere('kelas', 'like', "%{$search}%");
            })
            ->when(request('status'), function($query, $status) {
                $query->where('status', $status);
            })
            ->when(request('program_id'), function($query, $programId) {
                $query->where('program_id', $programId);
            })
            ->latest()
            ->paginate(10);

        return response()->json($students);
    }

    public function store(StudentRequest $request)
    {
        try {
            // Check if NIS already exists
            if (Student::where('nis', $request->nis)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIS sudah digunakan'
                ], 422);
            }
            
            $data = $request->validated();
            
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('students', 'public');
            }
            
            $student = Student::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil ditambahkan',
                'data' => $student->load('program')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data santri: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Student $student)
    {
        return response()->json([
            'success' => true,
            'data' => $student->load('program')
        ]);
    }

    public function update(StudentRequest $request, Student $student)
    {
        try {
            $data = $request->validated();
            
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($student->foto) {
                    Storage::disk('public')->delete($student->foto);
                }
                $data['foto'] = $request->file('foto')->store('students', 'public');
            }
            
            $student->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil diperbarui',
                'data' => $student->load('program')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data santri: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            \Log::info('Attempting to delete student with ID: ' . $id);
            
            // Find the student including soft-deleted ones
            $student = Student::withTrashed()->find($id);
            
            if (!$student) {
                \Log::warning('Student not found with ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Data santri tidak ditemukan'
                ], 404);
            }
            
            \Log::info('Found student: ' . $student->nama_lengkap . ' (ID: ' . $student->id . ')');
            
            // Delete photo if exists
            if ($student->foto) {
                Storage::disk('public')->delete($student->foto);
                \Log::info('Deleted photo: ' . $student->foto);
            }
            
            // Use forceDelete to permanently remove from database
            $deleted = $student->forceDelete();
            \Log::info('Student deletion result: ' . ($deleted ? 'success' : 'failed'));
            
            return response()->json([
                'success' => true,
                'message' => 'Data santri berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data santri: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:students,id'
        ]);

        try {
            \Log::info('Attempting bulk delete for student IDs: ' . implode(', ', $request->ids));
            
            // Find students including soft-deleted ones
            $students = Student::withTrashed()->whereIn('id', $request->ids)->get();
            
            \Log::info('Found ' . $students->count() . ' students for bulk delete');
            
            foreach ($students as $student) {
                if ($student->foto) {
                    Storage::disk('public')->delete($student->foto);
                    \Log::info('Deleted photo for student ' . $student->id . ': ' . $student->foto);
                }
            }
            
            // Use forceDelete to permanently remove from database
            $deletedCount = Student::withTrashed()->whereIn('id', $request->ids)->forceDelete();
            \Log::info('Bulk delete result: ' . $deletedCount . ' records deleted');
            
            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' data santri berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error bulk deleting students: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data santri: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif,lulus,pindah'
        ]);

        try {
            $student->update(['status' => $request->status]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status santri berhasil diperbarui',
                'data' => $student
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status santri: ' . $e->getMessage()
            ], 500);
        }
    }
}

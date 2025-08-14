<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->get();
        return view('admin.management.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.management.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_bergabung' => 'nullable|date',
            'kualifikasi' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();
            
            // Handle file upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/teachers', $fotoName);
                $data['foto'] = 'teachers/' . $fotoName;
            }

            $teacher = Teacher::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data guru berhasil ditambahkan',
                'data' => $teacher
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTeacher(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_bergabung' => 'nullable|date',
            'kualifikasi' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $teacher = Teacher::find($id);

            if (!$teacher) {
                return response()->json([
                    'success' => false,
                    'message' => 'Guru tidak ditemukan'
                ], 404);
            }

            $data = $validator->validated();
            
            // Handle file upload
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($teacher->foto && Storage::exists('public/' . $teacher->foto)) {
                    Storage::delete('public/' . $teacher->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('public/teachers', $fotoName);
                $data['foto'] = 'teachers/' . $fotoName;
            }

            $teacher->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data guru berhasil diperbarui',
                'data' => $teacher
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher): JsonResponse
    {
        try {
            // Delete photo if exists
            if ($teacher->foto && Storage::exists('public/' . $teacher->foto)) {
                Storage::delete('public/' . $teacher->foto);
            }
            
            $teacher->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data guru berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get teachers for AJAX requests
     */
    public function getTeachers(): JsonResponse
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $teachers
        ]);
    }

    /**
     * Archive/restore teacher
     */
    public function toggleStatus(Teacher $teacher): JsonResponse
    {
        try {
            $teacher->update([
                'status' => $teacher->status === 'aktif' ? 'nonaktif' : 'aktif'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status guru berhasil diperbarui',
                'data' => $teacher
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function getManagementProgramsContent()
    {
        $programs = Program::orderBy('created_at', 'desc')->get();
        $categories = Program::distinct()->pluck('category')->filter()->values();
        
        return view('admin.management.program.programs', compact('programs', 'categories'));
    }

    public function index()
    {
        $programs = Program::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $programs]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:100',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('programs', 'public');
                $data['image'] = $imagePath;
            }

            $program = Program::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Program berhasil ditambahkan',
                'data' => $program
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan program: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Program $program)
    {
        return response()->json(['success' => true, 'data' => $program]);
    }

    public function update(Request $request, Program $program)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:100',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($program->image) {
                    Storage::disk('public')->delete($program->image);
                }
                $imagePath = $request->file('image')->store('programs', 'public');
                $data['image'] = $imagePath;
            }

            $program->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Program berhasil diperbarui',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui program: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Program $program)
    {
        try {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            
            $program->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Program berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus program: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Program $program)
    {
        try {
            $program->update([
                'status' => $program->status === 'active' ? 'inactive' : 'active'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status program berhasil diubah',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status program: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCategories()
    {
        $categories = Program::distinct()->pluck('category')->filter()->values();
        return response()->json(['success' => true, 'data' => $categories]);
    }
}

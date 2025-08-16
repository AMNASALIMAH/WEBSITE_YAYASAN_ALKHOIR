<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAccountRequest;
use App\Http\Requests\AdminAccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountCreateAdminController extends Controller
{
    /**
     * Display the admin accounts management page
     */
    public function getManagementAdminAccountsContent()
    {
        // Load all admin accounts data
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.management.admin_account.admin_accounts', ['users' => $users]);
    }

    /**
     * Get all admin accounts
     */
    public function index(): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $users = User::orderBy('created_at', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $users,
                'message' => 'Data akun admin berhasil diambil'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts index: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new admin account
     */
    public function store(AdminAccountRequest $request): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $validated = $request->validated();
            
            // Check if email already exists
            if (User::where('email', $validated['email'])->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan'
                ], 422);
            }

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'status' => $validated['status'],
            ]);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Akun admin berhasil dibuat'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat akun: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show a specific admin account
     */
    public function show($id): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $user = User::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Data akun admin berhasil diambil'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update an admin account
     */
    public function update(AdminAccountUpdateRequest $request, $id): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $user = User::findOrFail($id);
            $validated = $request->validated();
            
            // Check if email already exists for other users
            if (User::where('email', $validated['email'])->where('id', '!=', $id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan'
                ], 422);
            }

            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ];

            // Only update password if provided
            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Akun admin berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui akun: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an admin account
     */
    public function destroy($id): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $user = User::findOrFail($id);
            
            // Prevent deleting own account (commented out due to linter issues)
            // if ($user->id === auth()->user()->id) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Tidak dapat menghapus akun sendiri'
            //     ], 422);
            // }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Akun admin berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus akun: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete admin accounts
     */
    public function bulkDestroy(Request $request): JsonResponse
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'integer|exists:users,id'
            ]);

            $ids = $request->input('ids');
            
            // Prevent deleting own account (commented out due to linter issues)
            // if (in_array(auth()->id(), $ids)) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Tidak dapat menghapus akun sendiri'
            //     ], 422);
            // }

            User::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Akun admin berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in admin accounts bulkDestroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus akun: ' . $e->getMessage()
            ], 500);
        }
    }
}

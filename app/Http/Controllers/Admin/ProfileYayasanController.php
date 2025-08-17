<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profileyayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProfileYayasanController extends Controller
{
    public function getManagementProfileContentYayasan()
    {
        try {
            // Clear any cached data to ensure fresh data is loaded
            Cache::forget('yayasan_profile_data');
            
            // Force a fresh query from the database
            $yayasan_data = Profileyayasan::withoutGlobalScopes()->get();
            
            Log::info('Profile yayasan data loaded', [
                'count' => $yayasan_data->count(),
                'data' => $yayasan_data->toArray()
            ]);
            
            // Check if this is an AJAX request for content
            if (request()->ajax() && request()->is('*/content')) {
                return view('admin.management.profile_yayasan.profile', compact('yayasan_data'))->render();
            }
            
            return view('admin.management.profile_yayasan.profile', compact('yayasan_data'));
        } catch (\Exception $e) {
            Log::error('Error loading profile yayasan data', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memuat data profil yayasan.']);
        }
    }

    public function updateProfileyayasan(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
        ]);

        try {
            // Assume only one profile exists, update the first or create if not exists
            $profile = Profileyayasan::first();

            if ($profile) {
                $profile->update($validated);
            } else {
                $profile = Profileyayasan::create($validated);
            }

            // Clear cache to ensure updated data is used
            Cache::forget('yayasan_profile_data');

            return redirect('/admin/management/profile/yayasan')->with('success', 'Profil yayasan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating profile yayasan', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui profil yayasan.']);
        }
    }

    public function debugProfileData()
    {
        try {
            // Get raw database data
            $rawData = DB::table('profileyayasans')->get();
            
            // Get model data
            $modelData = Profileyayasan::all();
            
            // Get cached data
            $cachedData = Cache::get('yayasan_profile_data');
            
            $debugInfo = [
                'database_raw' => $rawData->toArray(),
                'model_data' => $modelData->toArray(),
                'cached_data' => $cachedData,
                'cache_keys' => Cache::get('yayasan_profile_data'),
                'database_connection' => DB::connection()->getDatabaseName(),
                'timestamp' => now()->toISOString(),
            ];
            
            Log::info('Profile yayasan debug data', $debugInfo);
            
            return response()->json($debugInfo);
            
        } catch (\Exception $e) {
            Log::error('Error in debug method', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->latest()->paginate(12);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if ($news->status !== 'published') {
            abort(404);
        }
        
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->where('kategori', $news->kategori)
            ->latest()
            ->limit(3)
            ->get();
            
        return view('news.show', compact('news', 'relatedNews'));
    }

    public function adminIndex()
    {
        $news = News::withTrashed()->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'tanggal_terbit' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'tags' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['judul']);
        
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('news', 'public');
            $data['gambar'] = $imagePath;
        }

        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        $news = News::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dibuat',
            'data' => $news
        ]);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'tanggal_terbit' => 'required|date',
            'kategori' => 'nullable|string|max:100',
            'tags' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['judul']);
        
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }
            $imagePath = $request->file('gambar')->store('news', 'public');
            $data['gambar'] = $imagePath;
        }

        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        $news->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui',
            'data' => $news
        ]);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }
        
        $news->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }

    public function restore($id)
    {
        $news = News::withTrashed()->findOrFail($id);
        $news->restore();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $news = News::withTrashed()->findOrFail($id);
        
        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }
        
        $news->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus permanen'
        ]);
    }

    public function showAdmin($id)
    {
        $news = News::withTrashed()->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $news->id,
                'judul' => $news->judul,
                'konten' => $news->konten,
                'ringkasan' => $news->ringkasan,
                'penulis' => $news->penulis,
                'status' => $news->status,
                'tanggal_terbit' => optional($news->tanggal_terbit)->format('Y-m-d'),
                'kategori' => $news->kategori,
                'tags' => is_array($news->tags) ? implode(', ', $news->tags) : (string) $news->tags,
                'gambar' => $news->gambar,
                'gambar_url' => $news->gambar ? asset('storage/' . $news->gambar) : null,
            ]
        ]);
    }

    public function getLatestNews()
    {
        $news = News::published()->latest()->limit(6)->get();
        return response()->json($news);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramUnitCrudController extends Controller
{
    protected array $allowedTypes = [
        'mahasantri-alkhoir' => 'Mahasantri Al-Khoir',
        'majelis-talim-alkhoir' => 'Majelis Ta\'lim Al-Khoir',
        'rtq-alkhoir' => 'RTQ Al-Khoir',
        'sd-tahfidz-alkhoir' => 'SD Tahfidz Al-Khoir',
    ];

    protected function normalizeType(string $type): string
    {
        return $type;
    }

    protected function ensureValidType(string $type): void
    {
        if (!array_key_exists($type, $this->allowedTypes)) {
            abort(404);
        }
    }

    public function index(string $type)
    {
        $this->ensureValidType($type);
        $items = ProgramUnit::where('type', $this->normalizeType($type))
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.management.program_unit.index', [
            'items' => $items,
            'type' => $type,
            'typeLabel' => $this->allowedTypes[$type],
        ]);
    }

    public function create(string $type)
    {
        $this->ensureValidType($type);
        
        // Check if data already exists for this type
        if (ProgramUnit::where('type', $this->normalizeType($type))->exists()) {
            return redirect()->route('admin.management.program_unit.index', $type)
                ->with('error', 'Data untuk jenis ini sudah ada. Anda hanya dapat menambahkan satu data per jenis.');
        }
        
        return view('admin.management.program_unit.create', [
            'type' => $type,
            'typeLabel' => $this->allowedTypes[$type],
        ]);
    }

    public function store(Request $request, string $type)
    {
        $this->ensureValidType($type);
        $data = $request->validate([
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi_tujuan' => ['nullable', 'string'],
            'profil_ketua_program' => ['nullable', 'string'],
            'fasilitas' => ['nullable', 'string'],
        ]);
        $data['type'] = $this->normalizeType($type);

        ProgramUnit::create($data);
        return redirect()->route('admin.management.program_unit.index', $type)
            ->with('success', 'Data berhasil dibuat.');
    }

    public function show(string $type, int $id)
    {
        $this->ensureValidType($type);
        $item = ProgramUnit::where('type', $this->normalizeType($type))->findOrFail($id);
        return view('admin.management.program_unit.show', [
            'item' => $item,
            'type' => $type,
            'typeLabel' => $this->allowedTypes[$type],
        ]);
    }

    public function edit(string $type, int $id)
    {
        $this->ensureValidType($type);
        $item = ProgramUnit::where('type', $this->normalizeType($type))->findOrFail($id);
        return view('admin.management.program_unit.edit', [
            'item' => $item,
            'type' => $type,
            'typeLabel' => $this->allowedTypes[$type],
        ]);
    }

    public function update(Request $request, string $type, int $id)
    {
        $this->ensureValidType($type);
        $item = ProgramUnit::where('type', $this->normalizeType($type))->findOrFail($id);
        $data = $request->validate([
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi_tujuan' => ['nullable', 'string'],
            'profil_ketua_program' => ['nullable', 'string'],
            'fasilitas' => ['nullable', 'string'],
        ]);
        $item->update($data);
        return redirect()->route('admin.management.program_unit.index', $type)
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $type, int $id)
    {
        $this->ensureValidType($type);
        $item = ProgramUnit::where('type', $this->normalizeType($type))->findOrFail($id);
        $item->delete();
        return redirect()->route('admin.management.program_unit.index', $type)
            ->with('success', 'Data berhasil dihapus.');
    }
}



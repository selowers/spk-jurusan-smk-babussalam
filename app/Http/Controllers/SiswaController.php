<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->query('search'));

        $siswa = Siswa::with('user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%")
                        ->orWhere('kelas', 'like', "%{$search}%")
                        ->orWhere('jurusan_sekolah', 'like', "%{$search}%")
                        ->orWhere('tahun_ajaran', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_siswa')
            ->paginate(10)
            ->withQueryString();

        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak perlu mengambil users karena hanya ada 1 user (guru BK)
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan_sekolah' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        // Otomatis set id_user ke 1 (guru BK) karena hanya ada 1 user
        $data = $request->all();
        $data['id_user'] = 1;

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        // Tidak perlu mengambil users karena hanya ada 1 user (guru BK)
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan_sekolah' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $siswa = Siswa::findOrFail($id);
        // Otomatis set id_user ke 1 (guru BK) karena hanya ada 1 user
        $data = $request->all();
        $data['id_user'] = 1;
        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}

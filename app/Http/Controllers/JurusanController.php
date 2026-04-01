<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::paginate(10);
        $totalJurusan = Jurusan::count();
        $jurusanPerFakultas = Jurusan::selectRaw('fakultas, COUNT(*) as jumlah')
            ->groupBy('fakultas')
            ->get();

        return view('jurusan.index', compact('jurusan', 'totalJurusan', 'jurusanPerFakultas'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:150|unique:jurusan,nama_jurusan',
            'fakultas' => 'required|string|max:150',
            'perguruan_tinggi' => 'required|string|max:150',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique' => 'Nama jurusan sudah ada.',
            'fakultas.required' => 'Fakultas wajib diisi.',
            'perguruan_tinggi.required' => 'Perguruan tinggi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.show', compact('jurusan'));
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required|string|max:150|unique:jurusan,nama_jurusan,' . $id . ',id_jurusan',
            'fakultas' => 'required|string|max:150',
            'perguruan_tinggi' => 'required|string|max:150',
        ], [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.unique' => 'Nama jurusan sudah ada.',
            'fakultas.required' => 'Fakultas wajib diisi.',
            'perguruan_tinggi.required' => 'Perguruan tinggi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $jurusan->update($request->all());

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Cek apakah jurusan masih digunakan di tabel hasil_SAW
        if ($jurusan->hasilSAW()->count() > 0) {
            return redirect()->route('jurusan.index')
                ->with('error', 'Jurusan tidak dapat dihapus karena masih digunakan dalam hasil SPK.');
        }

        $jurusan->delete();

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil dihapus.');
    }

    public function addFakultas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_fakultas' => 'required|string|max:150|unique:jurusan,fakultas',
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib diisi.',
            'nama_fakultas.unique' => 'Fakultas sudah ada.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        // Fakultas disimpan sebagai data referensi, tidak perlu disimpan di database
        // Hanya return success untuk update dropdown

        return response()->json([
            'success' => true,
            'message' => 'Fakultas berhasil ditambahkan.',
            'fakultas' => $request->nama_fakultas
        ]);
    }

    public function addPerguruanTinggi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perguruan_tinggi' => 'required|string|max:150|unique:jurusan,perguruan_tinggi',
        ], [
            'nama_perguruan_tinggi.required' => 'Nama perguruan tinggi wajib diisi.',
            'nama_perguruan_tinggi.unique' => 'Perguruan tinggi sudah ada.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        // Perguruan tinggi disimpan sebagai data referensi, tidak perlu disimpan di database
        // Hanya return success untuk update dropdown

        return response()->json([
            'success' => true,
            'message' => 'Perguruan tinggi berhasil ditambahkan.',
            'perguruan_tinggi' => $request->nama_perguruan_tinggi
        ]);
    }
}
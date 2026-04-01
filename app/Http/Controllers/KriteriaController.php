<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::paginate(10);

        // Statistik untuk dashboard
        $totalKriteria = Kriteria::count();
        $benefitCount = Kriteria::where('tipe', 'benefit')->count();
        $costCount = Kriteria::where('tipe', 'cost')->count();
        $totalBobot = Kriteria::sum('bobot');

        return view('kriteria.index', compact('kriterias', 'totalKriteria', 'benefitCount', 'costCount', 'totalBobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kriteria' => 'required|string|max:100|unique:kriteria,nama_kriteria',
            'bobot' => 'required|numeric|min:0|max:1',
            'tipe' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.show', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_kriteria' => 'required|string|max:100|unique:kriteria,nama_kriteria,' . $kriteria->id_kriteria . ',id_kriteria',
            'bobot' => 'required|numeric|min:0|max:1',
            'tipe' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        // Cek apakah kriteria masih digunakan di tabel nilai
        if ($kriteria->nilai()->count() > 0) {
            return redirect()->route('kriteria.index')
                ->with('error', 'Kriteria tidak dapat dihapus karena masih memiliki data nilai terkait.');
        }

        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus.');
    }
}
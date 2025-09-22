<?php

namespace App\Http\Controllers;

use App\Models\Perwira;
use Illuminate\Http\Request;

class PerwiraController extends Controller
{
    /**
     * Tampilkan semua data perwira.
     */
    public function index()
    {
        $perwira = Perwira::all();
        return view('admin.perwira.index', compact('perwira'));
    }

    /**
     * Form tambah data perwira.
     */
    public function create()
    {
        return view('admin.perwira.create');
    }

    /**
     * Simpan data perwira baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|unique:perwira,nrp',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:perwira,email',
        ]);

        Perwira::create($request->all());

        return redirect()->route('admin.perwira.index')
                         ->with('success', 'Data perwira berhasil ditambahkan.');
    }

    /**
     * Detail perwira.
     */
    public function show(Perwira $perwira)
    {
        return view('admin.perwira.show', compact('perwira'));
    }

    /**
     * Form edit data perwira.
     */
    public function edit(Perwira $perwira)
    {
        return view('admin.perwira.edit', compact('perwira'));
    }

    /**
     * Update data perwira.
     */
    public function update(Request $request, Perwira $perwira)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|unique:perwira,nrp,' . $perwira->id,
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:perwira,email,' . $perwira->id,
        ]);

        $perwira->update($request->all());

        return redirect()->route('admin.perwira.index')
                         ->with('success', 'Data perwira berhasil diperbarui.');
    }

    /**
     * Hapus data perwira.
     */
    public function destroy(Perwira $perwira)
    {
        $perwira->delete();

        return redirect()->route('admin.perwira.index')
                         ->with('success', 'Data perwira berhasil dihapus.');
    }
}

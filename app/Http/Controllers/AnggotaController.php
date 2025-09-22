<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        // Ambil semua user dari database
        $anggota = User::all();

        // Kirim data ke view
        return view('admin.anggota.index', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nrp' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nrp' => $request->nrp,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'nrp' => 'required|unique:users,nrp,' . $id,
        ]);

        $user->update($request->only(['name', 'email', 'nrp', 'no_hp']));

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}

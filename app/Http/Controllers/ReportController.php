<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan untuk user biasa
     */
    public function index()
    {
        // Ambil laporan milik user yang login
        $reports = Report::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Menampilkan laporan untuk admin
     */
    public function adminIndex()
    {
        // Ambil semua laporan
        $reports = Report::with('user')->latest()->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Menampilkan halaman form untuk membuat laporan baru
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Simpan laporan baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload file jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        // Simpan ke database
        Report::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Hapus laporan (hanya untuk admin)
     */
    public function destroy(Report $report)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Hapus gambar jika ada
        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
    public function update(Request $request, Report $report)
    {
        // Validasi input
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data
        $report->title = $validated['title'];
        $report->description = $validated['description'];

        // Jika ada gambar baru diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($report->image && Storage::exists('public/' . $report->image)) {
                Storage::delete('public/' . $report->image);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('reports', 'public');
            $report->image = $path;
        }

        $report->save();

        // Redirect sesuai role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diperbarui!');
        }

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Menampilkan halaman detail laporan
     *
     * @param Report $report
     * @return \Illuminate\View\View
     */
    /*******  13f913d1-3b63-43ef-b127-dc60c3c12ed5  *******/
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}

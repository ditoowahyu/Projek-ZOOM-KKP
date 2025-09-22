<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan
     * - Admin → semua laporan
     * - User → hanya laporan miliknya
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $reports = Report::with('user')->latest()->paginate(10);
            return view('admin.reports.index', compact('reports'));
        }

        $reports = Report::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Menampilkan halaman form membuat laporan baru
     */
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            return view('admin.reports.create');
        }

        return view('reports.create');
    }

    /**
     * Simpan laporan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('reports', 'public')
            : null;

        Report::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dikirim!');
        }

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Menampilkan halaman detail laporan
     */
    public function show(Report $report)
    {
        if (Auth::user()->role === 'admin') {
            return view('admin.reports.show', compact('report'));
        }

        return view('reports.show', compact('report'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $report->title = $validated['title'];
        $report->description = $validated['description'];

        if ($request->hasFile('image')) {
            if ($report->image && Storage::exists('public/' . $report->image)) {
                Storage::delete('public/' . $report->image);
            }
            $report->image = $request->file('image')->store('reports', 'public');
        }

        $report->save();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diperbarui!');
        }

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Hapus laporan (hanya untuk admin)
     */
    public function destroy(Report $report)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
}

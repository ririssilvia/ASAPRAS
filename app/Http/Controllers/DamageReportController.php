<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\User;
use App\Http\Requests\DamageReport\StoreDamageReportRequest;
use App\Http\Requests\DamageReport\UpdateDamageReportRequest;
use App\Services\DamageReportService;
use Illuminate\Http\Request;

class DamageReportController extends Controller
{
    private $damageReportService;

    public function __construct(DamageReportService $damageReportService)
    {
        $this->damageReportService = $damageReportService;
    }

    // Menampilkan semua laporan kerusakan
    public function index()
    {
        $damageReports = $this->damageReportService->all();
        return view('damageReport.index', compact('damageReports'));
    }

    // Menampilkan form untuk membuat laporan baru
    public function create()
    {
        // Ambil data fasilitas dan pengguna dari database
        $facilities = Facility::all(); // Pastikan model Facility sudah di-import
        $users = User::all(); // Ambil semua user untuk dropdown
        $statuses = ['laporan_diterima', 'dalam_perbaikan', 'selesai']; // Pilihan status
        
        return view('damageReport.form', [
            'mode' => 'Add',
            'action' => route('damageReport.store'),
            'facilities' => $facilities, // Kirim data fasilitas ke view
            'users' => $users, // Kirim data user ke view
            'statuses' => $statuses, // Pilihan status
        ]);
    }

    // Menyimpan laporan kerusakan baru
    public function store(StoreDamageReportRequest $request)
    {
        $validated = $request->validated();

        // Menyimpan data laporan
        $this->damageReportService->create($request);
        return redirect()->route('damageReport.index')->with('success', 'Laporan kerusakan berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit laporan kerusakan
    public function edit($id)
    {
        $damageReport = $this->damageReportService->find($id);
        $facilities = Facility::all(); // Ambil data fasilitas
        $users = User::all(); // Ambil semua user
        $statuses = ['laporan_diterima', 'dalam_perbaikan', 'selesai']; // Pilihan status

        return view('damageReport.form', [
            'mode' => 'Edit',
            'action' => route('damageReport.update', $id),
            'damageReport' => $damageReport,
            'facilities' => $facilities,
            'users' => $users,
            'statuses' => $statuses, // Pilihan status
        ]);
    }

    // Memperbarui laporan kerusakan
    public function update(UpdateDamageReportRequest $request, $id)
    {
        $validated = $request->validated();

        // Memperbarui data laporan
        $this->damageReportService->update($request, $id);
        return redirect()->route('damageReport.index')->with('success', 'Laporan kerusakan berhasil diperbarui.');
    }

    // Fungsi untuk memperbarui status laporan (opsional jika hanya admin yang bisa)
    public function updateStatus(Request $request, $id)
    {
        $damageReport = $this->damageReportService->find($id);

        // Mengubah status laporan
        $damageReport->status = $request->status;
        $damageReport->save();

        return redirect()->route('damageReport.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    // Menghapus laporan kerusakan
    public function destroy($id)
    {
        $this->damageReportService->delete($id);
        return redirect()->route('damageReport.index')->with('success', 'Laporan kerusakan berhasil dihapus.');
    }
}

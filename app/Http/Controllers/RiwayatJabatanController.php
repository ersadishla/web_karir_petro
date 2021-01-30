<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\RiwayatJabatanExport;
use App\Services\RiwayatJabatanService;

class RiwayatJabatanController extends Controller
{
    protected RiwayatJabatanService $riwayatJabatanService;

    public function __construct(RiwayatJabatanService $riwayatJabatanService)
    {
        $this->riwayatJabatanService = $riwayatJabatanService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->riwayatJabatanService->getAll())->make(true);
        }
        return view('riwayat.index');
    }

    public function upload()
    {
        return view('riwayat.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('riwayat.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->riwayatJabatanService->upload($request);
            return redirect()->route('riwayat.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('riwayat.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('riwayat.upload')->with('error', 'Terjadi kesalahan');
        }

    }

    public function download(Request $request)
    {
        return Excel::download(new RiwayatJabatanExport, 'riwayat_jabatan_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->riwayatJabatanService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('riwayat.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

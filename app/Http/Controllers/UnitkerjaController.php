<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\UnitkerjaExport;
use App\Services\UnitkerjaService;

class UnitkerjaController extends Controller
{
    protected UnitkerjaService $unitkerjaService;

    public function __construct(UnitkerjaService $unitkerjaService)
    {
        $this->unitkerjaService = $unitkerjaService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->unitkerjaService->getAll())->make(true);
        }
        return view('unitkerja.index');
    }

    public function upload()
    {
        return view('unitkerja.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('unitkerja.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->unitkerjaService->upload($request);
            return redirect()->route('unitkerja.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('unitkerja.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('unitkerja.upload')->with('error', 'Terjadi kesalahan');
        }

    }

    public function download(Request $request)
    {
        return Excel::download(new UnitkerjaExport, 'unit_kerja_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->unitkerjaService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('unitkerja.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

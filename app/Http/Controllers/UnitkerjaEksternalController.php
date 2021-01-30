<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\UnitkerjaEksternalExport;
use App\Services\UnitkerjaEksternalService;

class UnitkerjaEksternalController extends Controller
{
    protected UnitkerjaEksternalService $unitkerjaEksternalService;

    public function __construct(UnitkerjaEksternalService $unitkerjaEksternalService)
    {
        $this->unitkerjaEksternalService = $unitkerjaEksternalService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->unitkerjaEksternalService->getAll())->make(true);
        }
        return view('eksternal.index');
    }

    public function upload()
    {
        return view('eksternal.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('eksternal.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->unitkerjaEksternalService->upload($request);
            return redirect()->route('eksternal.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('eksternal.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('eksternal.upload')->with('error', 'Terjadi kesalahan');
        }
    }

    public function download(Request $request)
    {
        return Excel::download(new UnitkerjaEksternalExport, 'unit_kerja_eksternal_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->unitkerjaEksternalService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('eksternal.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

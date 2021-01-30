<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\PelatihanExport;
use App\Services\PelatihanService;

class PelatihanController extends Controller
{
    protected PelatihanService $pelatihanService;

    public function __construct(PelatihanService $pelatihanService)
    {
        $this->pelatihanService = $pelatihanService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->pelatihanService->getAll())->make(true);
        }
        return view('pelatihan.index');
    }

    public function upload()
    {
        return view('pelatihan.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('pelatihan.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->pelatihanService->upload($request);
            return redirect()->route('pelatihan.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('pelatihan.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('pelatihan.upload')->with('error', 'Terjadi kesalahan');
        }

    }

    public function download(Request $request)
    {
        return Excel::download(new PelatihanExport, 'pelatihan_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->pelatihanService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('pelatihan.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

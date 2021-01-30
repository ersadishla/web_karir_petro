<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\PosisiExport;
use App\Services\PosisiService;

class PosisiController extends Controller
{
    protected PosisiService $posisiService;

    public function __construct(PosisiService $posisiService)
    {
        $this->posisiService = $posisiService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->posisiService->getAll())->make(true);
        }
        return view('posisi.index');
    }

    public function upload()
    {
        return view('posisi.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('posisi.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->posisiService->upload($request);
            return redirect()->route('posisi.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('posisi.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('posisi.upload')->with('error', 'Terjadi kesalahan');
        }

    }

    public function download(Request $request)
    {
        return Excel::download(new PosisiExport, 'posisi_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->posisiService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('posisi.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

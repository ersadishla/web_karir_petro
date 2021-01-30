<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exceptions\FailedUploadException;
use App\Exports\PegawaiExport;
use App\Services\PegawaiService;

class PegawaiController extends Controller
{
    protected PegawaiService $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->pegawaiService->getAll($request))->make(true);
        }
        return view('pegawai.index');
    }

    public function upload()
    {
        return view('pegawai.upload');
    }

    public function uploadPost(Request $request)
    {
        if(!$request->has('excelfile'))
            return redirect()->route('pegawai.upload')->with('error', 'Mohon pilih berkas yang sesuai');

        try {
            $this->pegawaiService->upload($request);
            return redirect()->route('pegawai.index')->with('success', 'Data sedang diunggah, harap menunggu');
        } catch (FailedUploadException $e) {
            return redirect()->route('pegawai.upload')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('pegawai.upload')->with('error', 'Terjadi kesalahan');
        }

    }

    public function download(Request $request)
    {
        return Excel::download(new PegawaiExport, 'pegawai_'.time().'.xlsx');
    }

    public function truncate()
    {
        try {
            $this->pegawaiService->truncate();
            return redirect()->back()->with('success', 'Seluruh data berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('pegawai.upload')->with('error', 'Terjadi kesalahan');
        }
    }
}

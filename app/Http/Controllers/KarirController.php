<?php

namespace App\Http\Controllers;

use App\Exports\KarirExport;
use App\Jobs\GenerateKarirJob;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PegawaiService;
use App\Services\KarirService;
use Exception;
use App\Exceptions\ObjectNotFoundException;

class KarirController extends Controller
{
    protected PegawaiService $pegawaiService;
    protected KarirService $karirService;

    public function __construct(PegawaiService $pegawaiService, KarirService $karirService)
    {
        $this->pegawaiService = $pegawaiService;
        $this->karirService = $karirService;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of($this->pegawaiService->getAll($request))->make(true);
        }

        $dept = DB::table('pegawai')->whereNotNull('departemen')->select(['kode_dept', 'departemen'])->distinct()->orderBy('departemen')->get();
        $p_grade = DB::table('pegawai')->whereNotNull('p_grade')->select(['p_grade'])->distinct()->orderBy('p_grade')->get();

        return view('karir.index', compact('dept', 'p_grade'));
    }

    public function edit(Request $request)
    {
        try {
            $pegawai = $this->karirService->find($request->nik_sap);
            return view('karir.edit', compact('pegawai'));
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }
    }

    public function update(Request $request)
    {
        try {
            $this->karirService->update($request->nik_sap, $request);
            return redirect()->route('karir.show', ['nik_sap' => $request->nik_sap])
                ->with('success', 'Data karir berhasil diubah');
        } catch (Exception $e) {
            return redirect()->route('karir.show', ['nik_sap' => $request->nik_sap])
                ->with('error', 'Terjadi kesalahan');
        }
    }

    public function show(Request $request)
    {
        try {
            $pegawai = $this->karirService->find($request->nik_sap);
            return view('karir.show', compact('pegawai'));
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }
    }

    public function generatePdf(Request $request)
    {
        try {
            $pegawai = $this->karirService->find($request->nik_sap);
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('karir.pdf')->with([
            'pegawai' => $pegawai,
        ])->render());

        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('CV_' . $pegawai->nik_sap . '.pdf', array('Attachment' => false));
    }

    public function generateExcel(Request $request)
    {
        try {
            $pegawai = $this->karirService->find($request->nik_sap);
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }

        return Excel::download(new KarirExport($pegawai), 'CV_' . $pegawai->nik_sap . '.xlsx');
    }

    public function generateKarir()
    {
        GenerateKarirJob::dispatch($this->karirService);

        return redirect()->route('karir.index')->with('success', 'Data karir sedang diproses');
    }

    public function generateObject(Request $request)
    {
        try {
            $karir = $this->karirService->find($request->nik_sap);
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }

        try {
            $pegawai = $this->pegawaiService->find($request->nik_sap);
        } catch (ObjectNotFoundException $e) {
            return redirect()->route('karir.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('karir.index')->with('error', 'Terjadi kesalahan');
        }

        $unitkerja_eksternal = DB::table('unitkerja_eksternal')->pluck('unitkerja')->toArray();

        $karir = $this->karirService->process($karir, $pegawai, $unitkerja_eksternal);

        $karir->update();

        return redirect()->back()->with('success', 'Data karir berhasil diperbarui');
    }
    //
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karir;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function beranda()
    {
        $count_pegawai = DB::table('pegawai')->count();
        $komp = DB::table('pegawai')->whereNotNull('kompartemen')->select(['kode_komp', 'kompartemen'])->distinct()->orderBy('kompartemen')->get();

        return view('page.beranda', compact('count_pegawai', 'komp'));
    }

    public function chartBeranda(Request $request)
    {
        if(isset($request->data['kode_komp']) && $request->data['kode_komp'] != null) {
            $pegawai_by_departemen = DB::table('pegawai')
                                        ->whereNotNull('departemen')
                                        ->where('kode_komp', $request->data['kode_komp'])
                                        ->select(
                                            DB::raw('departemen'),
                                            DB::raw('count(*) as pegawai_by_departemen'),
                                        )
                                        ->groupBy('departemen')
                                        ->get();

            $pegawai_by_p_grade = DB::table('pegawai')
                                        ->whereNotNull('p_grade')
                                        ->where('kode_komp', $request->data['kode_komp'])
                                        ->select(
                                            DB::raw('p_grade'),
                                            DB::raw('count(*) as pegawai_by_p_grade'),
                                        )
                                        ->groupBy('p_grade')
                                        ->get();
        } else {
            $pegawai_by_departemen = DB::table('pegawai')
                                        ->whereNotNull('departemen')
                                        ->select(
                                            DB::raw('departemen'),
                                            DB::raw('count(*) as pegawai_by_departemen'),
                                        )
                                        ->groupBy('departemen')
                                        ->get();

            $pegawai_by_p_grade = DB::table('pegawai')
                                        ->whereNotNull('p_grade')
                                        ->select(
                                            DB::raw('p_grade'),
                                            DB::raw('count(*) as pegawai_by_p_grade'),
                                        )
                                        ->groupBy('p_grade')
                                        ->get();
        }
        $result['count_filter_pegawai_p_grade'] = 0;
        $result['count_filter_pegawai_departemen'] = 0;
        $result['pieChart1'] = [];
        foreach ($pegawai_by_departemen as $key => $value) {
            $result['pieChart1'][] = [
                'departemen'            => $value->departemen,
                'pegawai_by_departemen' => $value->pegawai_by_departemen,
            ];
            $result['count_filter_pegawai_departemen'] += $value->pegawai_by_departemen;
        }
        $result['pieChart2'] = [];
        foreach ($pegawai_by_p_grade as $key => $value) {
            $result['pieChart2'][] = [
                'p_grade'               => $value->p_grade,
                'pegawai_by_p_grade'    => $value->pegawai_by_p_grade,
            ];
            $result['count_filter_pegawai_p_grade'] += $value->pegawai_by_p_grade;
        }

        return $result;
    }

    public function pegawaiBeranda(Request $request)
    {
        $pegawai = Pegawai::find($request->nik_sap);

        return $pegawai;
    }

    //
}

<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KarirExport implements FromView
{
    protected $pegawai;

    public function __construct($pegawai) {
        $this->pegawai = $pegawai;
    }

    public function view(): View
    {
        return view('karir.excel', [
            'pegawai' => $this->pegawai,
        ]);
    }
}

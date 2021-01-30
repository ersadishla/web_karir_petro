<?php

namespace App\Interfaces;

interface KarirRepositoryInterface
{
    public function process($karir, $pegawai, $unitkerja_eksternal);

    public function find($nik_sap);

    public function update($nik_sap, $request);
}

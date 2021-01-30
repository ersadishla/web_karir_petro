<?php

namespace App\Services;

use App\Models\Karir;
use App\Models\Pegawai;
use App\Exceptions\ObjectNotFoundException;
use App\Interfaces\KarirRepositoryInterface;

class KarirService
{
    protected KarirRepositoryInterface $karirRepository;

    public function __construct(KarirRepositoryInterface $karirRepository)
    {
        $this->karirRepository = $karirRepository;
    }

    public function process(Karir $karir, Pegawai $pegawai, array $unitkerja_eksternal)
    {
        return $this->karirRepository->process($karir, $pegawai, $unitkerja_eksternal);
    }

    public function find($nik_sap)
    {
        if(!$data = $this->karirRepository->find($nik_sap))
            throw new ObjectNotFoundException;
        return $data;
    }

    public function update($nik_sap, $request)
    {
        $this->karirRepository->update($nik_sap, $request);
    }
}

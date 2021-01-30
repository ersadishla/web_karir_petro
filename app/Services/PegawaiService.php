<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportPegawaiJob;
use App\Exceptions\FailedUploadException;
use App\Interfaces\PegawaiRepositoryInterface;
use App\Exceptions\ObjectNotFoundException;

class PegawaiService
{
    protected PegawaiRepositoryInterface $pegawaiRepository;

    public function __construct(PegawaiRepositoryInterface $pegawaiRepository)
    {
        $this->pegawaiRepository = $pegawaiRepository;
    }

    public function getAll(Request $request)
    {
        if($request->dept && $request->p_grade) {
            $params = [['p_grade', $request->p_grade], ['kode_dept', $request->dept]];
        }
        elseif($request->dept) {
            $params = [['kode_dept', $request->dept]];
        }
        elseif($request->p_grade) {
            $params = [['p_grade', $request->p_grade]];
        }
        else {
            $params = null;
        }
        return $this->pegawaiRepository->get($params);
    }

    public function find($nik_sap)
    {
        if(!$data = $this->pegawaiRepository->find($nik_sap))
            throw new ObjectNotFoundException;
        return $data;
    }

    public function upload(Request $request)
    {
        $file = $request->file('excelfile');
        $fileName = $file->getClientOriginalName();
        $isFileUploaded = Storage::putFileAs("public/import", $request->file('excelfile'), $fileName);

        if(!$isFileUploaded)
            throw new FailedUploadException;

        ImportPegawaiJob::dispatch($fileName);
    }

    public function truncate()
    {
        return $this->pegawaiRepository->truncate();
    }
}

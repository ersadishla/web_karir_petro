<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportRiwayatJabatanJob;
use App\Exceptions\FailedUploadException;
use App\Interfaces\RiwayatJabatanRepositoryInterface;

class RiwayatJabatanService
{
    protected RiwayatJabatanRepositoryInterface $riwayatJabatanRepository;

    public function __construct(RiwayatJabatanRepositoryInterface $riwayatJabatanRepository)
    {
        $this->riwayatJabatanRepository = $riwayatJabatanRepository;
    }

    public function getAll()
    {
        return $this->riwayatJabatanRepository->get();
    }

    public function upload(Request $request)
    {
        $file = $request->file('excelfile');
        $fileName = $file->getClientOriginalName();
        $isFileUploaded = Storage::putFileAs("public/import", $request->file('excelfile'), $fileName);

        if(!$isFileUploaded)
            throw new FailedUploadException;

        ImportRiwayatJabatanJob::dispatch($fileName);
    }

    public function truncate()
    {
        return $this->riwayatJabatanRepository->truncate();
    }
}

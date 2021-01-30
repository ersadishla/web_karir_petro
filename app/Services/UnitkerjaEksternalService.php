<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportUnitkerjaEksternalJob;
use App\Exceptions\FailedUploadException;
use App\Interfaces\UnitkerjaEksternalRepositoryInterface;

class UnitkerjaEksternalService
{
    protected UnitkerjaEksternalRepositoryInterface $unitkerjaRepository;

    public function __construct(UnitkerjaEksternalRepositoryInterface $unitkerjaRepository)
    {
        $this->unitkerjaRepository = $unitkerjaRepository;
    }

    public function getAll()
    {
        return $this->unitkerjaRepository->get();
    }

    public function upload(Request $request)
    {
        $file = $request->file('excelfile');
        $fileName = $file->getClientOriginalName();
        $isFileUploaded = Storage::putFileAs("public/import", $request->file('excelfile'), $fileName);

        if(!$isFileUploaded)
            throw new FailedUploadException;

        ImportUnitkerjaEksternalJob::dispatch($fileName);
    }

    public function truncate()
    {
        return $this->unitkerjaRepository->truncate();
    }
}

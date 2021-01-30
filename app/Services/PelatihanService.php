<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportPelatihanJob;
use App\Exceptions\FailedUploadException;
use App\Interfaces\PelatihanRepositoryInterface;

class PelatihanService
{
    protected PelatihanRepositoryInterface $pelatihanRepository;

    public function __construct(PelatihanRepositoryInterface $pelatihanRepository)
    {
        $this->pelatihanRepository = $pelatihanRepository;
    }

    public function getAll()
    {
        return $this->pelatihanRepository->get();
    }

    public function upload(Request $request)
    {
        $file = $request->file('excelfile');
        $fileName = $file->getClientOriginalName();
        $isFileUploaded = Storage::putFileAs("public/import", $request->file('excelfile'), $fileName);

        if(!$isFileUploaded)
            throw new FailedUploadException;

        ImportPelatihanJob::dispatch($fileName);
    }

    public function truncate()
    {
        return $this->pelatihanRepository->truncate();
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportPosisiJob;
use App\Exceptions\FailedUploadException;
use App\Interfaces\PosisiRepositoryInterface;

class PosisiService
{
    protected PosisiRepositoryInterface $posisiRepository;

    public function __construct(PosisiRepositoryInterface $posisiRepository)
    {
        $this->posisiRepository = $posisiRepository;
    }

    public function getAll()
    {
        return $this->posisiRepository->get();
    }

    public function upload(Request $request)
    {
        $file = $request->file('excelfile');
        $fileName = $file->getClientOriginalName();
        $isFileUploaded = Storage::putFileAs("public/import", $request->file('excelfile'), $fileName);

        if(!$isFileUploaded)
            throw new FailedUploadException;

        ImportPosisiJob::dispatch($fileName);
    }

    public function truncate()
    {
        return $this->posisiRepository->truncate();
    }
}

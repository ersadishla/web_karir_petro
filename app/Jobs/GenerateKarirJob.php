<?php

namespace App\Jobs;

use App\Models\Karir;
use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Services\KarirService;

class GenerateKarirJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected KarirService $karirService;

    public function __construct(KarirService $karirService)
    {
        $this->karirService = $karirService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pegawais = Pegawai::with([
            'riwayat',
            'riwayat.posisi',
            'pelatihanDN',
            'pelatihanLN',
        ])->get();

        DB::table('pegawai')->update(['is_processed' => 0]);

        Karir::truncate();

        $unitkerja_eksternal = DB::table('unitkerja_eksternal')->pluck('unitkerja')->toArray();

        /**
         * @var Pegawai
         */
        foreach ($pegawais as $pegawai) {
            $karir = new Karir();

            $karir = $this->karirService->process($karir, $pegawai, $unitkerja_eksternal);

            $karir->save();

            $pegawai->update([
                'is_processed' => 1
            ]);
        }
    }
}

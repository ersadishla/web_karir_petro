<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SqlKarirRepository;
use App\Repositories\SqlPosisiRepository;
use App\Repositories\SqlPegawaiRepository;
use App\Interfaces\KarirRepositoryInterface;
use App\Repositories\SqlPelatihanRepository;
use App\Repositories\SqlUnitkerjaRepository;
use App\Interfaces\PosisiRepositoryInterface;
use App\Interfaces\PegawaiRepositoryInterface;
use App\Interfaces\PelatihanRepositoryInterface;
use App\Interfaces\UnitkerjaRepositoryInterface;
use App\Repositories\SqlRiwayatJabatanRepository;
use App\Interfaces\RiwayatJabatanRepositoryInterface;
use App\Repositories\SqlUnitkerjaEksternalRepository;
use App\Interfaces\UnitkerjaEksternalRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;

        $this->app->singleton(UnitkerjaRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlUnitkerjaRepository::class);
        });

        $this->app->singleton(UnitkerjaEksternalRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlUnitkerjaEksternalRepository::class);
        });

        $this->app->singleton(PosisiRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlPosisiRepository::class);
        });

        $this->app->singleton(PegawaiRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlPegawaiRepository::class);
        });

        $this->app->singleton(PelatihanRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlPelatihanRepository::class);
        });

        $this->app->singleton(RiwayatJabatanRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlRiwayatJabatanRepository::class);
        });

        $this->app->singleton(KarirRepositoryInterface::class, function () use ($app) {
            return $app->make(SqlKarirRepository::class);
        });
    }
}

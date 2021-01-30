<?php

namespace Tests\Unit;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use App\Interfaces\UnitkerjaRepositoryInterface;
use App\Models\Unitkerja;
use App\Repositories\SqlUnitkerjaRepository;
use Carbon\Carbon;

class UnitkerjaTest extends MockeryTestCase
{
    public function setUp(): void
    {
        $this->repository = Mockery::mock(UnitkerjaRepositoryInterface::class);
        $this->service = new SqlUnitkerjaRepository($this->repository);
    }

    public function test_get_unit_kerja()
    {
        $unit_kerjas = collect();
        $unit_kerjas->add(new Unitkerja([
            "unitkerja" => '100000',
            "nm_unitkerja" => 'Satu',
            "parentorgcode" => '100001',
            "orglevelname" => 'Test',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]));
        $unit_kerjas->add(new Unitkerja([
            "unitkerja" => '200000',
            "nm_unitkerja" => 'Dua',
            "parentorgcode" => '200001',
            "orglevelname" => 'Test',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]));
        $unit_kerjas->add(new Unitkerja([
            "unitkerja" => '300000',
            "nm_unitkerja" => 'Tiga',
            "parentorgcode" => '300001',
            "orglevelname" => 'Test',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]));
        $unit_kerjas->add(new Unitkerja([
            "unitkerja" => '400000',
            "nm_unitkerja" => 'Empat',
            "parentorgcode" => '400001',
            "orglevelname" => 'Test',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]));
        $this->repository->shouldReceive('get')
            ->andReturn($unit_kerjas)
            ->once();
        $response = $this->service->get();
        $this->assertTrue(is_a($response, 'Illuminate\Support\Collection'));
        $this->assertEquals(4, $response->count());
    }
}

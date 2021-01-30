<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'emp_history_no';

    public $incrementing = false;

    protected $table = 'pelatihan';

    protected $guarded = [];

    public $timestamps = true;

    protected $dates = ['start_date', 'end_date'];

    public function setStartDateAttribute($rawDate)
    {
        $this->attributes['start_date'] = Carbon::instance(Date::excelToDateTimeObject($rawDate))->format('Y-m-d H:i:s');
    }

    public function setEndDateAttribute($rawDate)
    {
        $this->attributes['end_date'] = Carbon::instance(Date::excelToDateTimeObject($rawDate))->format('Y-m-d H:i:s');
    }

    public function getFormattedStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->translatedFormat('d-m-Y');
    }

    public function getFormattedEndDateAttribute()
    {
        return Carbon::parse($this->attributes['end_date'])->translatedFormat('d-m-Y');
    }
}

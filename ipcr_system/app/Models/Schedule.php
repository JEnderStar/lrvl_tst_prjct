<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = "schedule_ipcr";

    protected $casts = [
        'employees' => 'array'
    ];

    protected $fillable = ['type','purpose','covered_period','office','employees','division_chief','director','duration_from','duration_to'];
}

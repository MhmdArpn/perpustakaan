<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['type', 'report_date', 'total_summary', 'status'];

    protected $casts = [
        'report_date' => 'date',
    ];
}

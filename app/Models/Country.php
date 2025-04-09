<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Country extends Model
{
    use HasFactory;

    public $table = 'country';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

}

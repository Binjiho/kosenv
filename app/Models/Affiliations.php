<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliations extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'affiliations';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];
    protected $casts = [
//        'phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->timestamps = false; // updated_at 자동 생성 비활성화
            $model->created_at = date('Y-m-d H:i:s'); // created_at 강제 생성
        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->abs_sid = $data['abs_sid'];
        }

        $this->affi_kr = $data['affi_kr'] ?? null;
        $this->affi_en = $data['affi_en'] ?? null;
    }

    public function abstract()
    {
        return $this->hasOne(Abs::class, 'sid', 'abs_sid');
    }
    
}

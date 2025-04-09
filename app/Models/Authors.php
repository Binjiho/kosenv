<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authors extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'authors';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];
    protected $casts = [
        'affiliation' => 'array',
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

        $this->c_author_yn = $data['c_author_yn'] ?? 'N';
        $this->name_kr = $data['name_kr'] ?? null;
        $this->first_name = $data['first_name'] ?? null;
        $this->last_name = $data['last_name'] ?? null;
        $this->affiliation = $data['affiliation'] ?? null;
    }

    public function abstract()
    {
        return $this->hasOne(Abs::class, 'sid', 'abs_sid');
    }

//    public function abstracts()
//    {
//        return $this->belongsTo(Abs::class, 'abs_sid');
//    }

}

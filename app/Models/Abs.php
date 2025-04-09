<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abs extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'abstracts';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'workshop_sid',
        'reg_sid',
    ];
    protected $casts = [
//        'phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'complete_at',
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
            $this->workshop_sid = $data->workshop_sid;
            $this->reg_sid = $data->reg_sid ?? null;
            $this->regnum = $data->regnum ?? null ;
            $this->work_code = $data->work_code ?? null ;
            $this->year = $data->year ?? date('Y');
        }

        $this->topic = $data->topic ?? null;
        $this->title_kr = $data->title_kr ?? null;
        $this->title_en = $data->title_en ?? null;
        $this->contents = $data->contents ?? null;
        $this->keyword1 = $data->keyword1 ?? null;
        $this->keyword2 = $data->keyword2 ?? null;
        $this->keyword3 = $data->keyword3 ?? null;
        $this->keyword4 = $data->keyword4 ?? null;
        $this->keyword5 = $data->keyword5 ?? null;
        $this->contents_words = $data->contents_words ?? null;

        $this->ack = $data->ack ?? null;
        
        $this->del = $data->del ?? 'N';
    }

    public function workshop()
    {
        return $this->hasOne(Workshop::class, 'sid', 'workshop_sid');
    }

    public function registration()
    {
        return $this->hasOne(Registration::class, 'sid', 'reg_sid');
    }

    public function authors()
    {
        return $this->hasMany(Authors::class, 'abs_sid')->withTrashed()->orderBy('sid');
    }

    public function affiliations()
    {
        return $this->hasMany(Affiliations::class, 'abs_sid')->withTrashed()->orderBy('sid');
    }

    public function isGraceTarget()
    {
        $result = Abs::withTrashed()->where(['sid'=>$this->sid, 'status'=>'N'])->first();
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
}

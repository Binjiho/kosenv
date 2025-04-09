<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'registration';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'workshop_sid',
        'user_sid',
    ];
    protected $casts = [
//        'phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'complete_at',
        'refund_at',
        'refund_complete_at',
        'payment_date',
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
        if(!empty($data['phone'])) $phone = $data['phone'][0] . '-' . $data['phone'][1] . '-' . $data['phone'][2];

        if(empty($this->sid)) {
            $this->workshop_sid = $data->workshop_sid;
            $this->user_sid = $data->user_sid ?? null;
            $this->user_password = $data->user_password ?? null;
            $this->user_chk = $data->user_chk ?? 'N';
            $this->fee_chk = $data->fee_chk ?? 'N';
            $this->regnum = $data->regnum ?? null ;
            $this->work_code = $data->work_code ?? null ;

            $this->year = $data->year ?? date('Y');
        }

        $this->country = $data->country ?? null;
        $this->name_kr = $data->name_kr ?? null;
        $this->sosok_kr = $data->sosok_kr ?? null;
        $this->position = $data->position ?? null;
        $this->email = $data->email ?? null;
        $this->phone = $phone ?? null;

        $this->gubun = $data->gubun ?? null;
        $this->category = $data->category ?? null;
        $this->price = empty($data->price) ? null : unComma($data->price);
        $this->shuttle_yn = $data->shuttle_yn ?? 'N';

//        $this->payment_method = $data->payment_method ?? null;
//        $this->payment_status = $data->payment_status ?? null;
//        $this->payment_date = $data->payment_date ?? null;
//        $this->resultCode = $data->resultCode ?? null;
        
        $this->del = $data->del ?? 'N';
    }

    public function workshop()
    {
        return $this->hasOne(Workshop::class, 'sid', 'workshop_sid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }

    public function isGraceTarget()
    {
        $result = Registration::withTrashed()->where(['sid'=>$this->sid, 'status'=>'N', 'payment_status'=>'N'])->first();
        if(!empty($result)){
            return true;
        }else{
            return false;
        }
    }
}

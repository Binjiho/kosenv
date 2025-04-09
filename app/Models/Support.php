<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'supports';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'workshop_sid',
    ];
    protected $casts = [
//        'phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'complete_at',
        'deposit_date',
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
        if(!empty($data['tel'])) $tel = $data['tel'][0] . '-' . $data['tel'][1] . '-' . $data['tel'][2];
        if(!empty($data['fax'])) $fax = $data['fax'][0] . '-' . $data['fax'][1] . '-' . $data['fax'][2];

        if(empty($this->sid)) {
            $this->workshop_sid = $data->workshop_sid;
            $this->work_code = $data->work_code ?? null ;
            $this->regnum = $data->regnum ?? null ;
            $this->year = $data->year ?? date('Y');
        }

        $this->grade = $data->grade ?? null;
        $this->price = $data->price ?? null;
        $this->company = $data->company ?? null;
        $this->ceo = $data->ceo ?? null;
        $this->company_zipcode = $data->company_zipcode ?? null;
        $this->company_address = $data->company_address ?? null;
        $this->company_address2 = $data->company_address2 ?? null;

        $this->manager = $data->manager ?? null;
        $this->position = $data->position ?? null;
        $this->department = $data->department ?? null;
        $this->tel = $tel ?? null;
        $this->phone = $phone ?? null;
        $this->fax = $fax ?? null;
        $this->email = $data->email ?? null;
        $this->manager_zipcode = $data->manager_zipcode ?? null;
        $this->manager_address = $data->manager_address ?? null;
        $this->manager_address2 = $data->manager_address2 ?? null;
        
        $this->del = $data->del ?? 'N';
    }

    public function workshop()
    {
        return $this->hasOne(Workshop::class, 'sid', 'workshop_sid');
    }

}

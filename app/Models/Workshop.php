<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Workshop extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'workshop';

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
        'event_sdate',
        'event_edate',
        'regist_sdate',
        'regist_edate',
        'regist_grace_sdate',
        'regist_grace_edate',
        'abs_sdate',
        'abs_edate',
        'abs_grace_sdate',
        'abs_grace_edate',
        'support_sdate',
        'support_edate',
        'display_sdate',
        'display_edate',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->work_code = $data->work_code ?? '202501';
        }

        $this->subject = $data->subject ?? null;
        $this->place = $data->place ?? null;
        $this->event_sdate = empty($data->event_sdate) ? null : $data->event_sdate;
        $this->event_edate = empty($data->event_edate) ? null : $data->event_edate;
        $this->regist_sdate = empty($data->regist_sdate) ? null : $data->regist_sdate;
        $this->regist_edate = empty($data->regist_edate) ? null : $data->regist_edate;
        $this->regist_grace_yn = $data->regist_grace_yn ?? 'N';
        $this->regist_grace_sdate = empty($data->regist_grace_sdate) ? null : $data->regist_grace_sdate;
        $this->regist_grace_edate = empty($data->regist_grace_edate) ? null : $data->regist_grace_edate;

        $this->abs_sdate = empty($data->abs_sdate) ? null : $data->abs_sdate;
        $this->abs_edate = empty($data->abs_edate) ? null : $data->abs_edate;
        $this->abs_grace_yn = $data->abs_grace_yn ?? 'N';
        $this->abs_grace_sdate = empty($data->abs_grace_sdate) ? null : $data->abs_grace_sdate;
        $this->abs_grace_edate = empty($data->abs_grace_edate) ? null : $data->abs_grace_edate;

        $this->support_sdate = empty($data->support_sdate) ? null : $data->support_sdate;
        $this->support_edate = empty($data->support_edate) ? null : $data->support_edate;

        $this->display_sdate = empty($data->display_sdate) ? null : $data->display_sdate;
        $this->display_edate = empty($data->display_edate) ? null : $data->display_edate;

        $this->del = $data->del ?? 'N';
        $this->adminPass = $data->adminPass ?? 'N';
    }

    public function workshop()
    {
        return $this->hasOne(Workshop::class, 'sid', 'workshop_sid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }

    public function eventDate(){
        $result = null;
        $sdate = $this->event_sdate;
        $edate = $this->event_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $result = $sdate->format('Y-m-d');
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $result .= ' ~ '.$edate->format('Y-m-d');
        }
        return $result;
    }

    public function eventMainDate(){
        // 요일 매핑 (0: 일요일, 1: 월요일, ... 6: 토요일)
        $weekDays = ['일', '월', '화', '수', '목', '금', '토'];

        $result = null;
        $sdate = $this->event_sdate;
        $edate = $this->event_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $sDate = Carbon::parse($sdate);
            $result = $sDate->format('Y년 m월 d일') . ' (' . $weekDays[$sDate->format('w')] . ')';
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $eDate = Carbon::parse($edate);
            $result .= ' ~ '.$eDate->format('d일') . ' (' . $weekDays[$eDate->format('w')] . ')';
        }
        return $result;
    }

    public function getDday($target_date){
        if(empty($target_date)){
            return "";
        }

        $eventDate = Carbon::parse($target_date)->startOfDay(); // 이벤트 날짜 (시간 00:00:00으로 설정)
        $today = Carbon::today(); // 오늘 날짜

        $diff = $today->diffInDays($eventDate, false); // 날짜 차이 계산 (음수 허용)

        if ($diff > 0) {
            return "D-{$diff}";  // 미래
        } elseif ($diff < 0) {
            return "END";  // 과거
        } else {
            return "D-Day";  // 오늘
        }
    }

    public function regDate(){
        $result = null;
        $sdate = $this->regist_sdate;
        $edate = $this->regist_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $result = $sdate->format('Y.m.d');
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $result .= ' ~ '.$edate->format('Y.m.d');
        }
        return $result;
    }

    public function absDate(){
        $result = null;
        $sdate = $this->abs_sdate;
        $edate = $this->abs_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $result = $sdate->format('Y.m.d');
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $result .= ' ~ '.$edate->format('Y.m.d');
        }
        return $result;
    }

    public function supportDate(){
        $result = null;
        $sdate = $this->support_sdate;
        $edate = $this->support_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $result = $sdate->format('Y.m.d');
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $result .= ' ~ '.$edate->format('Y.m.d');
        }
        return $result;
    }

    public function displayDate(){
        $result = null;
        $sdate = $this->display_sdate;
        $edate = $this->display_edate;
        if(!empty($sdate) && isValidTimestamp($sdate)){
            $result = $sdate->format('Y.m.d');
        }
        if(!empty($edate) && isValidTimestamp($edate)){
            $result .= ' ~ '.$edate->format('Y.m.d');
        }
        return $result;
    }

    public function isRegistGraceDue(){
        if($this->regist_grace_yn == 'Y'){
            return now() <= $this->regist_grace_edate && now() >= $this->regist_grace_sdate;
        }
        return false;
    }

    public function isAbsGraceDue(){
        if($this->abs_grace_yn == 'Y'){
            return now() <= $this->abs_grace_edate && now() >= $this->abs_grace_sdate;
        }
        return false;
    }
}

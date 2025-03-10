<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'password_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [

    ];

    protected static function booted()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->timestamps = false; // updated_at 자동 생성 비활성화
            $model->created_at = date('Y-m-d H:i:s'); // created_at 강제 생성
        });

        static::created(function ($user) {

            if (request()->route()->getName() != 'transfer' /* 데이터 이전 작업아닐때 */) {
                /**
                 * 회비 생성
                 * 일반회원 > 입회비 + 당해연도 연회비 + 종신회비 셋팅 (당해연도의 회원의 생년월일 기준으로 55세 이상일 경우 회비 40만원으로 자동 변경)
                 * 특별회원 > 당해연도 연회비 셋팅
                 * 단체회원 > 당해연도 연회비 셋팅
                 */
                if($user->gubun == 'N'/*일반회원*/)
                {
                    //입회비
                    $data = [
                        'user_sid' => $user->sid,
                        'year' => now()->format('Y'),
                        'gubun' => $user->gubun,
                        'category'=>'A',
                        'price'=>self::feeConfig()['price'][$user->gubun]['A'],
                    ];

                    $fee_A = new Fee();
                    $fee_A->setByData($data);
                    $fee_A->save();

                    //당해연도 연회비
                    $data = [
                        'user_sid' => $user->sid,
                        'year' => now()->format('Y'),
                        'gubun' => $user->gubun,
                        'category'=>'B',
                        'price'=>self::feeConfig()['price'][$user->gubun]['B'],
                    ];
                    $fee_B = new Fee();
                    $fee_B->setByData($data);
                    $fee_B->save();

                    //종신회비
                    $fee_price = self::feeConfig()['price'][$user->gubun]['C'];
                    if(self::isAge55OrOlder($user->birth)){
                        $fee_price = self::feeConfig()['price'][$user->gubun]['D'];
                    }
                    $data = [
                        'user_sid' => $user->sid,
                        'year' => now()->format('Y'),
                        'gubun' => $user->gubun,
                        'category'=>'C',
                        'price'=>$fee_price,
                    ];
                    $fee_C = new Fee();
                    $fee_C->setByData($data);
                    $fee_C->save();

                }else if($user->gubun == 'S'/*특별회원*/)
                {
                    //당해연도 연회비
                    $data = [
                        'user_sid' => $user->sid,
                        'year' => now()->format('Y'),
                        'gubun' => $user->gubun,
                        'category'=>'B',
                        'price'=>self::feeConfig()['price'][$user->gubun][$user->grade]['B'],
                    ];

                    $fee_B = new Fee();
                    $fee_B->setByData($data);
                    $fee_B->save();

                }else if($user->gubun == 'G'/*단체회원*/)
                {
                    //당해연도 연회비
                    $data = [
                        'user_sid' => $user->sid,
                        'year' => now()->format('Y'),
                        'gubun' => $user->gubun,
                        'category'=>'B',
                        'price'=>self::feeConfig()['price'][$user->gubun]['B'],
                    ];

                    $fee_B = new Fee();
                    $fee_B->setByData($data);
                    $fee_B->save();
                }

            }
        });

        static::deleting(function ($user) {
            $user->timestamps = false; // 업데이트 시간 저장 안하려고 timestamps 값 false 로 변경

            $user->del_type = '2';
            $user->del = 'Y';
            $user->update();

//            $user->fees()->delete(); // 회비 삭제
            $user->fees()->update(['del' => 'Y', 'deleted_at'=>date('Y-m-d H:i:s')]); // 회비 삭제 대신 상태 업데이트

            $user->timestamps = true; // timestamps 다시 활성
        });
    }

    private function userConfig()
    {
        return getConfig('user');
    }
    private static function feeConfig()
    {
        return config('site.fee');
    }

    public function setByData($data)
    {
        if(!empty($data['phone'])) $phone = $data['phone'][0] . '-' . $data['phone'][1] . '-' . $data['phone'][2];
        if(!empty($data['companyTel'])) $companyTel = $data['companyTel'][0] . '-' . $data['companyTel'][1] . '-' . $data['companyTel'][2];
        if(!empty($data['companyFax'])) $companyFax = $data['companyFax'][0] . '-' . $data['companyFax'][1] . '-' . $data['companyFax'][2];
        if(!empty($data['homeTel'])) $homeTel = $data['homeTel'][0] . '-' . $data['homeTel'][1] . '-' . $data['homeTel'][2];
        if(!empty($data['managerTel'])) $managerTel = $data['managerTel'][0] . '-' . $data['managerTel'][1] . '-' . $data['managerTel'][2];

        if(empty($this->sid)) {
            $this->gubun = $data['gubun'];
            $this->grade = $data['grade'] ?? null;
            $this->level = $data['gubun'].($data['grade'] ?? null) ?? null;
            $this->id = $data['id'];
//            $this->password = bcrypt($data['password']);
            $this->password = Hash::make($data->password);
            $this->password_at = now();
        }

        $this->name_kr = $data['name_kr'] ?? ( $data['manager'] ?? null);
        $this->name_en = $data['name_en'] ?? null;
        $this->birth = $data['birth'] ?? null;
        $this->sex = $data['sex'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->emailReception = $data['emailReception'] ?? null;
        $this->phone = $phone ?? null;
        $this->smsReception = $data['smsReception'] ?? null;
        $this->post = $data['post'] ?? null;

        $this->company = $data['company'] ?? null;
        $this->ceo = $data['ceo'] ?? null;
        $this->department = $data['department'] ?? null;
        $this->job = $data['job'] ?? null;
        $this->position = $data['position'] ?? null;
        $this->position_etc = $data['position_etc'] ?? null;
        $this->company_zipcode = $data['company_zipcode'] ?? null;
        $this->company_address = $data['company_address'] ?? null;
        $this->company_address2 = $data['company_address2'] ?? null;

        $this->companyTel = $companyTel ?? null;
        $this->companyFax = $companyFax ?? null;
        $this->home_zipcode = $data['home_zipcode'] ?? null;
        $this->home_address = $data['home_address'] ?? null;
        $this->home_address2 = $data['home_address2'] ?? null;
        $this->homeTel = $homeTel ?? null;

        $this->degree = $data['degree'] ?? null;
        $this->graduate = $data['graduate'] ?? null;
        $this->degreeCountry = $data['degreeCountry'] ?? null;
        $this->degreeAgency = $data['degreeAgency'] ?? null;
        $this->tutor = $data['tutor'] ?? null;
        $this->journalKor = $data['journalKor'] ?? null;
        $this->journalEng = $data['journalEng'] ?? null;

        $this->business = $data['business'] ?? null;
        $this->manager = $data['manager'] ?? null;
        $this->managerTel = $managerTel ?? null;
        $this->managerEmail = $data['managerEmail'] ?? null;
        $this->memo = $data['memo'] ?? null;
    }

    public static function isAge55OrOlder($birthDate = null) {

        if(empty($birthDate)){
            return false;
        }

        // 생년월일을 DateTime 객체로 변환
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $birthDate);

        if (!$birthDateObj) {
            return false; // 잘못된 날짜 형식이면 false 반환
        }

        // 현재 날짜 가져오기
        $today = Carbon::today();

        // 나이 계산 (만 나이)
        $age = $today->diffInYears($birthDateObj);

        // 생일이 지나지 않았다면 나이 1살 빼기
        if ($today->isBefore($birthDateObj->copy()->year($today->year))) {
            $age--; // 생일이 지나지 않았다면 1살 빼기
        }

        // 55세 이상인지 확인
        return $age >= 55;
    }

    public function fees()
    {
        return $this->hasMany(Fee::class, 'user_sid')->orderByDesc('year')->orderByDesc('sid');
    }

    public function lastFee()
    {
        return $this->hasOne(Fee::class, 'user_sid')->orderByDesc('year')->orderByDesc('sid')->limit('1');
    }

    public function isLifeMember() // 종신회원
    {
        return ($this->gubun == 'N' && $this->grade =='B');
    }

    public function isLifeFee() // 종신회비
    {
        return $this->hasOne(Fee::class, 'user_sid')->where(['gubun'=>'N', 'category'=>'B']);
    }

    public function nextMFeeDate() // 차기 회비 납부일
    {
        $period = '';
        $lastFee = $this->lastFee;

        if (!empty($lastFee->sDate)) {
            $sDate = Carbon::createFromFormat('Y-m-d', $lastFee->sDate)->addYear(1)->subDays(30)->format('Y-m-d');
            $eDate = Carbon::createFromFormat('Y-m-d', $lastFee->sDate)->addYear(2)->subDays(1)->format('Y-m-d');

            $period = $sDate . " ~ " . $eDate;
        }

        return $period;
    }

    public function addCustomData()
    {
        $user = $this;
        $user->getLevel = $this->getLevel();
        $user->isAge55OrOlder = false;
        if($this->gubun == 'N'){
            $user->isAge55OrOlder = self::isAge55OrOlder($this->birth);
        }

        return $user;
    }

    public function getLevel()
    {
        return $this->userConfig()['level'][$this->level] ?? '';
    }
}

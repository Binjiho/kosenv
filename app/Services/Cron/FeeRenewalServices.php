<?php

namespace App\Services\Cron;

use App\Models\User;
use App\Models\Fee;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * Class FeeRenewalServices
 * @package App\Services
 */
class FeeRenewalServices extends AppServices
{
    public function renewalService() // 회비 목록 갱신
    {
//        if (php_sapi_name() == 'cli') {
            Log::channel('cronLog')->error("================================== 회비 목록 갱신 ===================================");
//        }

        // 현재일로 부터 30일 후 날짜 구하기
        $dateAfter30Days = Carbon::now()->addDays(30)->format('Y-m-d');
        $userList = User::whereNotIn('level', ['NB'])->whereNotIn('del_type', ['1','2'])->orWhereNull('del_type')->get(); // 종신회원 & 관리자 및 탈퇴 or 삭제회원 제외

        $this->transaction();

        try {
            $next_year = date('Y', strtotime('+1 year'));
            $sDate = Carbon::create(Carbon::now()->year + 1, 1, 1, 0, 0, 0)->format('Y-m-d');
            $this->feeConfig = getConfig('fee');

            foreach ($userList as $user) {
                if (php_sapi_name() == 'cli') {
                    Log::channel('cronLog')->error("USER sid: {$user->sid} | USER ID {$user->id} 차기 회비 셋팅");
                }

                $already_annual_fee = Fee::where(['del'=>'N', 'year'=>$next_year, 'category'=>'B', 'user_sid'=>$user->sid])->first();
                if($already_annual_fee) continue;

                if($user->gubun == 'S'){
                    $fee_price = $this->feeConfig['price'][$user->gubun][$user->grade]['B'];
                }else{
                    $fee_price = $this->feeConfig['price'][$user->gubun]['B'];
                }

                $data = [
                    'user_sid' => $user->sid,
                    'year' => $next_year,
                    'gubun' => $user->gubun,
                    'category'=>'B',
                    'price'=>$fee_price,
                    'sDate'=>$sDate,
                ];

                $fee = new Fee();
                $fee->setByData($data);
                $fee->save();
            }

            $this->dbCommit('회비 자동 갱신');

//            if (php_sapi_name() == 'cli') {
                Log::channel('cronLog')->error("================================== END 회비 목록 갱신 SUC ===================================" . PHP_EOL);
//            }

            return 'suc';
        } catch (\Exception $e) {
//            if (php_sapi_name() == 'cli') {
                Log::channel('cronLog')->error("================================== END 회비 목록 갱신 ERROR ===================================" . PHP_EOL);
//            }

            return $this->dbRollback($e);
        }
    }
}

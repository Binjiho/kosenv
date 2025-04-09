<?php

namespace App\Services\Workshop;

use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class AbstractServices
 * @package App\Services
 */
class SupportServices extends AppServices
{
    public function indexService(Request $request)
    {
        // 동적으로 클래스 이름 생성
        $className = 'App\\Services\\Workshop\\CODE_' . $request->work_code . '\\SupportServices';

        // 클래스가 존재하는지 확인
        if (class_exists($className)) {
            return (new $className())->indexService($request);
        }
        // 클래스가 없으면 기본 처리
        return notFoundRedirect();
    }

    public function listService(Request $request)
    {
        // 동적으로 클래스 이름 생성
        $className = 'App\\Services\\Workshop\\CODE_' . $request->work_code . '\\SupportServices';

        // 클래스가 존재하는지 확인
        if (class_exists($className)) {
            return (new $className())->listService($request);
        }
        // 클래스가 없으면 기본 처리
        return notFoundRedirect();
    }

    public function dataAction(Request $request)
    {
        // 동적으로 클래스 이름 생성
        $className = 'App\\Services\\Workshop\\CODE_' . $request->work_code . '\\SupportServices';

        // 클래스가 존재하는지 확인
        if (class_exists($className)) {
            return (new $className())->dataAction($request);
        }
        // 클래스가 없으면 기본 처리
        return notFoundRedirect();
    }
}

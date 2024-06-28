<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Department;
use App\Models\DisplaySetting;
use App\Models\TokenSetting;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $display = DisplaySetting::first();
        $keyList = DB::table('token_setting AS s')
            ->select('d.key', 's.department_id', 's.counter_id', 's.user_id')
            ->leftJoin('department AS d', 'd.id', '=', 's.department_id')
            ->where('s.status', 1)
            ->get();
        $keyList = json_encode($keyList);

        if ($display->display == 5)
        {
            $departmentList = TokenSetting::select(
                    'department.name',
                    'token_setting.department_id',
                    'token_setting.counter_id',
                    'token_setting.user_id',
                    DB::raw('CONCAT(user.firstname ," " ,user.lastname) AS officer')
                )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->where('token_setting.status',1)
                ->groupBy('token_setting.user_id')
                ->orderBy('token_setting.department_id', 'ASC')
                ->get();
        }
        else
        {
            $departmentList = TokenSetting::select(
                    'department.name',
                    'token_setting.department_id',
                    'token_setting.counter_id',
                    'token_setting.user_id'
                    )
                ->join('department', 'department.id', '=', 'token_setting.department_id')
                ->join('counter', 'counter.id', '=', 'token_setting.counter_id')
                ->join('user', 'user.id', '=', 'token_setting.user_id')
                ->where('token_setting.status', 1)
                ->groupBy('token_setting.department_id')
                ->get();
        }

        //return view('backend.receptionist.token.auto', compact('display', 'departmentList', 'keyList'));
        return view('front.home', compact('display', 'departmentList', 'keyList') );
    }
}

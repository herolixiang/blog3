<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
	//展示页面
 	public function index()
 	{
 		return view('admin.index');
 	}
 	//登陆添加页面
 	public function login()
 	{
 		return view('admin.login');
 	}
 	//登陆添加执行页面
 	public function login_do(Request $request)
 	{
 		$name=$request->input('name');
        $pwd=$request->input('pwd');
        $yan=$request->input('yan');
        // dd($name);
        // 从缓存里取
        // $data = Cache::get('code'.$name);
        // // dd($data);
        // if($data != $yan){
        //     echo "<script>alert('验证码不正确');location.href='/admin/login';</script>";die;
        // }
		//验证用户名和密码是否正确
        $userData = User::where(['name'=>$name,'pwd'=>$pwd])->first();
        if (!$userData) {
			//报错
            echo "<script>alert('用户名密码错误');location.href='/admin/login';</script>";
		}else{                          
			//登陆成功
            echo "<script>alert('登陆成功');location.href='/admin/index';</script>";
		}
 	}
 	// //发送验证码
  //   public function yan(Request $request)
  //   {
  //       $data=$request->all();
  //       $name=$request->input('name');
  //       $pwd=$request->input('pwd');
  //       $bandData = Bang::where(['name'=>$name,'pwd'=>$pwd])->first();
  //       $openid=$bandData['openid'];
  //       $codes=rand(1000,9999);
  //       //验证码缓存
  //       $code="code".$name;
  //       //存缓存
  //       Cache::put($code,$codes,60);
  //       $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
  //       // dd($url);
  //       $data = [
  //           'touser'=>"on2efw6EPqBtK512Vg77-ekTc1Wo",
  //           'template_id'=>'YdT94z9LQ3WQfHDlcYGoJRD1EAYFIEOYk2bS27gWp8I',
  //           'url'=>'',
  //           'data' => [
  //               'keyword1' => [
  //                   'value' => $codes,
  //                   'color' => ''
  //               ],
  //               'keyword2' => [
  //                   'value' => $name,
  //                   'color' => ''
  //               ]
  //           ]
  //       ];
  //       // dd($data);
  //       $res = $this->wechat->post($url,json_encode($data));
  //       // var_dump($res);
  //   }
}

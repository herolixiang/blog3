<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\User;
class UserController extends Controller
{
	//接口用户添加
    public function add(Request $request)
    {
   		$name=$request->input('name');
   		// dd($name);
   		$pwd=$request->input('pwd');
   		// if(empty($name) || empty($pwd)) {
   		// 	return json_encode(['code'=>000,'msg'=>'参数不能为空']);
   		// }
   		  //文件上传
        $path="";
        if ($request->hasFile('file')) {
            $path = $request->file->store('img/'.date("Y-n-j"));
            // dd($res);
        }
   		$data=User::insert([
   			'name'=>$name,
   			'pwd'=>$pwd,
   			'img'=>$path
   		]);
   		if ($data) {
   			return json_encode(['code'=>200,'msg'=>'添加成功']);
   		}else{
   			return json_encode(['code'=>201,'msg'=>'添加失败']);
   		}
    }
    //接口用户展示
    public function list(Request $request)
    {	
    	$name=$request->input('name');
    	$where=[];
    	if(isset($name)) {
    		$where[]=['name','like',"%$name%"];
    	}
    	$data=User::where($where)->paginate(2)->toArray();
    	if(!empty($name)) {
 			foreach ($data['data'] as $key => $value) {
 				$data['data'][$key]['name']=str_replace($name,"<b style='color:red'>".$name."</b>",$value['name']);
 			}
 			// var_dump($data);die;
 		}
        return json_encode(['code'=>'200','data'=>$data]);
    }

    //接口用户删除
    public function delete()
    {
    	$id=request()->id;
    	// dd($id);
    	$res=User::where(['id'=>$id])->delete();
    	if ($res){
   			return json_encode(['code'=>200,'msg'=>'删除成功']);
   		}else{
   			return json_encode(['code'=>201,'msg'=>'删除失败']);
   		}
    }

    //接口修改
    public function edit()
    {
    	$id=request()->id;
    	$res= User::where(['id'=>$id])->first();
        //  dd($res);
         return json_encode(['code'=>200,'res'=>$res]);
    }

    //接口修改执行
    public function update(Request $request)
    {
    	$id = $request->input('id');
        $name = $request->input('name');
        //dd($name);
        $pwd = $request->input('pwd');
        $res = User::find($id);

        $res->name = $name;
        $res->pwd = $pwd;
        $res->save();
        if($res){
         return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
          return json_encode(['code'=>201,'msg'=>'修改失败']);
        }
    }
}

@extends('layouts.admin')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
  <table class="table table-bordered table-striped form-horizontal">
    <h3>接口基础-留言修改</h3>
      <div class="form-group">
        <label for="exampleInputEmail1">姓名</label>
        <input type="text" class="form-control" name="name" placeholder="用户名">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">密码</label>
        <input type="text" class="form-control" name="pwd" placeholder="电话号">
      </div>
      <button type="button" class="btn btn-info sub">修改</button>
  </table> 
</form>
<script type="text/javascript">
     var url="http://www.blog3.com/api/edit";

     var id = getUrlParam('id');
      //alert(id);
        $.ajax({
            url:url,
            type:"GET",
            data:{id:id},
            dataType:'json',
            success:function(res){
                var name = $("[name='name']").val(res.res.name);
                var pwd = $("[name='pwd']").val(res.res.pwd);
            },
        });


      $(".sub").on('click',function(){
          //alert(111);
          var name = $("[name='name']").val();
          var pwd = $("[name='pwd']").val();
          $.ajax({
              url:"http://www.blog3.com/api/update",
              data:{id:id,name:name,pwd:pwd},
              dataType:"json",
              type:"POST",
              success:function(res){
                  alert(res.msg);location.href='http://www.blog3.com/admin/userlist';
              }
          })
      })
   

    function getUrlParam(name) {
      var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
      var r = window.location.search.substr(1).match(reg);  //匹配目标参数
      if (r != null) return decodeURI(r[2]); return null; //返回参数值
    }
</script>
@endsection
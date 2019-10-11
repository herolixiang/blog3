@extends('layouts.admin')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
  <table class="table table-bordered table-striped form-horizontal">
    <h3>接口基础-留言添加</h3>
      <div class="form-group">
        <label for="exampleInputEmail1">姓名</label>
        <input type="text" class="form-control" name="name" placeholder="用户名">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">电话号</label>
        <input type="text" class="form-control" name="pwd" placeholder="电话号">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">图片</label>
        <input type="file" class="form-control" name="file" id="file" placeholder="图片">
      </div>
      <button type="button" class="btn btn-info sub">添加</button>
  </table> 
</form>

<script>
    var url="http://www.blog3.com/api/add";
    $('.sub').on('click',function(){
        // alert(1);
        //异步上传表单
        var fd = new FormData();

        var name=$("[name='name']").val();
        var pwd=$("[name='pwd']").val();
        var file =($("#file")[0].files[0]);

        fd.append('name',name);
        fd.append('pwd',pwd);
        fd.append('file',file);
        // alert(pwd);
        $.ajax({
            url:url,
            type:'post',
            data:fd,
            dataType:"json",
            processData:false,
            contentType:false,
            success:function(res){
                alert(res.msg);location.href='http://www.blog3.com/admin/userlist';
            }
        })
    });
</script>
@endsection

@extends('layouts.admin')
@section('content')
<h3>接口基础-用户展示</h3>
        用户姓名：<input type="text" name="name" id="name" >
        <input type="button" class='search btn btn-info' value='搜索'>
    <table class="table table-bordered table-striped form-horizontal">
        <tr>
            <td>Id</td>
            <td>姓名</td>
            <td>电话号</td>
            <td>图片</td>
            <td>操作</td>
        </tr>
        <tbody class="add">
            
        </tbody>
    </table>
    <!-- 分页样式 -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a> -->
            <!-- </li> -->
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <!-- <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li> -->
        </ul>
    </nav>

    <script>
         var url="http://www.blog3.com/api/list";
          $.ajax({
              url:url,
              type:"GET",
              dataType:'json',
              success:function(res){
                // console.log(res);
                listData(res);
              },
           });

          //删除事件（动态元素需要使用document）
          $(document).on('click',".del",function(){
                var id=$(this).attr('id');
                // alert(id);
                //在ajax中如果用当前对象 需要提前定义$(this)
                var _this=$(this);
              //发送delete请求删除 
              $.ajax({
                  url:"http://www.blog3.com/api/delete",
                  dataType:"json",
                  data:{id:id},
                  success:function(res){
                      _this.parents('tr').remove();
                      alert(res.msg);location.href='http://www.blog3.com/admin/userlist';
                  }
              });
          });

          //修改跳转链接
          $(document).on('click','.edit',function(){
              var id = $(this).attr('id');
              location.href='http://www.blog3.com/admin/useredit?id='+id+'';
          });


          //分页功能
          //点击分页按钮
          $(document).on('click',".pagination a",function(){
              //获取分页页码
              var page =$(this).attr('page');
              var name=$("#name").val();
              //发送ajax请求到后台接口
              $.ajax({
                  url:url,
                  type:"GET",
                  data:{page:page,name:name},
                  dataType:'json',
                  success:function(res){
                      // console.log(res);
                      listData(res);
                  },
              });
          });



          //搜索功能
          //点击搜索按钮
          $(".search").on('click',function(){
              //获取搜索内容
              var name=$("#name").val();
              //发送ajax请求后台接口
              $.ajax({
                  url:url,
                  type:"GET",
                  data:{name:name},
                  dataType:'json',
                  success:function(res){
                      listData(res);
                  },
              });
          });

          //页面渲染代码优化
          function listData(res)
          {
            //渲染页面
            $(".add").empty();
            $.each(res.data.data,function(i,v){
                var tr= $("<tr></tr>");  //构建一个空对象
                tr.append("<td>"+v.id+"</td>");
                tr.append("<td>"+v.name+"</td>");
                tr.append("<td>"+v.pwd+"</td>");
                tr.append("<td>"+'<img src="/'+v.img+'" height="100" width="100">'+"</td>");
                tr.append("<td><button id="+v.id+" class='del btn btn-success'>删除</button>||<button id="+v.id+" class='edit btn btn-success'>修改</button></td>");
                $(".add").append(tr);
            });
                var page="";
                //构建页码
                for(var i=1;i<=res.data.last_page;i++){
                    page+="<li><a page='"+i+"'>第"+i+"页</a></li>";
                }
                $('.pagination').html(page);
          }
    </script>
@endsection
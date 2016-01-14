$(function(){
    //全选或者全不选
    $('.check_all').click(function(){
        $('.id').prop('checked',$('.check_all').prop('checked'));
    });
    //控制全选复选框
    $('.id').click(function(){
        $('.check_all').prop('checked',$('.id:not(:checked)').length==0);
    });
    //通用的ajax的get方式请求
    $('.ajax-get').click(function(){
        //发生点击事件时发送ajax的get请求
        //获取当前标签的URL地址
        var url=$(this).attr('href');
        $.get(url,function(data){
//                    console.debug(data);
            showMsg(data);
        });
        return false;
    });

    //通用的ajax的post方式请求
    $('.ajax-post').click(function(){
        var url=$(this).attr('url')?$(this).attr('url'):$(this).closest('form').attr('action');
        var params=$('.id').serialize()?$('.id').serialize():$(this).closest('form').serialize();//序列化选中的表单元素
        $.post(url,params,function(data){
            showMsg(data);
        });
        return false;
    });
});


function showMsg(data){
    layer.msg(data.info,{
        offset:0,
        icon: data.status==1?1:2,
        time: 1000,
    },function(){
        //隐藏之后刷新
        if(data.url){
            //跳转到请求页面
            location.href=data.url;
        }else{
            //自身刷新
            location.reload();
        }
    });
}
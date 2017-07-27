// 默认AjaxForm选项
var ajaxFormOptions = {
    beforeSubmit: function () {
        layer.load(1);
    }
    , complete: function () {
        layer.closeAll('loading');
    }
    , success: function (data) {
        if (data.status === 'success') {
            layer.alert(data.msg, {icon: 6});
        } else {
            layer.alert(data.msg, {icon: 5});
        }
    }
    , error: function () {
        layer.alert('网络服务器错误,请刷新重试 ! ', {icon: 2});
    }
};
// 默认Ajax提交选项
var ajaxOptions = {
    method:'POST',
    url:null,
    data:{},
    beforeSend: function () {
        layer.load(1);
    }
    , complete: function () {
        layer.closeAll('loading');
    }
    , success: function (data) {
        if (data.status === 'success') {
            layer.alert(data.msg, {icon: 6});
        } else {
            layer.alert(data.msg, {icon: 5});
        }
    }
    , error: function () {
        layer.alert('网络服务器错误,请刷新重试 ! ', {icon: 2});
    }
};
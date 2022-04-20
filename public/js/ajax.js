// ajax封装
function ajax(url, data, success, cache, alone, async, type, dataType, error) {
    var type = type || 'post'; //请求类型
    var dataType = dataType || 'json'; //接收数据类型
    var async = async ||true; //异步请求
    var alone = alone || false; //独立提交（一次有效的提交）
    var cache = cache || false; //浏览器历史缓存
    var success = success || function (data) {
        console.log(data);
        if (data.status) { //服务器处理成功
            lightyear.notify(data.msg, 'success', 100);
            setTimeout(function () {
                if (data.replace) {
                    location.replace(data.url);
                } else if (data.reload) {
                    location.reload(true);
                } else {
                    lightyear.loading('hide');
                }
            }, 1500);
        } else { //服务器处理失败
            lightyear.loading('hide');
            lightyear.notify(data.msg, 'danger', 100);
            if (alone) { //改变ajax提交状态
                ajaxStatus = true;
            }
        }
    };
    var error = error || function (data) {
        /*console.error('请求成功失败');*/
        /*data.status;//错误状态吗*/
        lightyear.loading('hide');
        if (data.status == 404) {
            lightyear.notify('請求失敗，請求未找到', 'danger', 100);
        } else if (data.status == 503) {
            lightyear.notify('請求失敗，伺服器內部錯誤', 'danger', 100);
        } else {
            lightyear.notify('請求失敗,網路連線超時', 'danger', 100);
        }
        ajaxStatus = true;
    };
    /*判断是否可以发送请求*/
    if (!ajaxStatus) {
        return false;
    }
    ajaxStatus = false; //禁用ajax请求
    /*正常情况下1秒后可以再次多个异步请求，为true时只可以有一次有效请求（例如添加数据）*/
    if (!alone) {
        setTimeout(function () {
            ajaxStatus = true;
        }, 1000);
    }
    $.ajax({
        'url': url,
        'data': data,
        'type': type,
        'dataType': dataType,
        'async': async,
        'success': success,
        'error': error,
        'jsonpCallback': 'jsonp' + (new Date()).valueOf().toString().substr(-4),
        'beforeSend': function () {
            lightyear.loading('show');
        },
    });
}

// submitAjax(post方式提交)
function submitAjax(form, success, cache, alone) {
    cache = cache || true;
    var form = $(form);
    var url = form.attr('action');
    var data = form.serialize();
    ajax(url, data, success, cache, alone, false, 'post', 'json');
}

// ajax提交(post方式提交)
function post(url, data, success, cache, alone) {
    ajax(url, data, success, cache, alone, false, 'post', 'json');
}

// ajax提交(get方式提交)
function get(url, success, cache, alone) {
    ajax(url, {}, success, alone, false, 'get', 'json');
}

// jsonp跨域请求(get方式提交)
function jsonp(url, success, cache, alone) {
    ajax(url, {}, success, cache, alone, false, 'get', 'jsonp');
}
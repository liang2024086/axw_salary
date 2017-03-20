/**
* 跳转
*/
function toNewPage(durl,isNewWindow) {
	if(isNewWindow==1)
		window.open(durl); 
	else
		window.location.href = durl;
}


/**
 * 跳转到错误的锚点
 * @param tagId
 * @return
 */
function go2Position(tagId) {
    location.href = "#" + tagId;

}

/**
* 打开登陆框
*/
function openLogin() {
    $("#J-pop-div").load("/views/user/login_pop.jsp", 
    function() {
        $("#J-pop-div").css({
            "display": "block"
        });
        fn_pop.maskShow();

    }
    );

}


/**
* 用户验证
*/
function checkUser() {
    if (SU <= 0) {
        openLogin();
        return false;

    } else
    return true;

}


/**
* 用户验证
*/
function isLoginUser() {
    if (SU <= 0) {
        return false;

    } else
    return true;

}

/**
* 用户头像加载失败
*/
function userImgError(obj) {
    $(obj).attr("src", "http://zhaopins.com/assets/images/user_def_150x150.png");
    //控制不要一直跳动
    //obj.onerror=null; 

}

/**
* 公司logo加载失败
*/
function companyLogoError(obj) {
    $(obj).attr("src", "http://zhaopins.com/assets/images/company_def_200x200.png");
    //控制不要一直跳动
    //obj.onerror=null; 

}


/**
 * 私信数
 */
function loadNewMessageInfo() {
    var _obj = $("#messageDotDiv");
    _obj.removeClass();
    _obj.html("");

    if (isLoginUser()) {
        $.ajax({
            type: "post",
            url: "/message/countud.html",
            async: false,
            dataType: 'json',
            success: function(data) {
                if (403 == data) {
                    openLogin();

                } else if (data.count > 0) {
                    if (data.count > 99) {
                        _obj.html("99+");

                    } else {
                        _obj.html(data.count);

                    }
                    _obj.addClass("red_yuan");

                }

            }

        });

    }

}
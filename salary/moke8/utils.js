/**
 * 邮箱验证
 * @param str
 * @returns
 */
function isEmail(str) {
	return checkData(str, /^[\w_-]+([\.\\w_-]*[\w_-]+)?@[\w-]+\.[a-zA-Z0-9]+(\.[a-zA-Z]+)?$/);
}

/**
 * 手机验证
 * @param str
 * @returns
 */
function isMobile(str) {
	return checkData(str, /^1[34578]\d{9}$/i);
}

/**
 * qq验证
 * @param str
 * @return
 */
function isQQ(str){
	return   checkData(str, /^[1-9]\d{4,11}$/); 
}

/**
 * URL验证
 * @param URL
 * @return
 */
function isURL(str){
	return   checkData(str, /(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/); 
}

/**
 * 去空
 * @param str
 * @returns
 */
function trim(str) {
	if(str==null)
		return "";
	else 
		return str.replace(/(^\s*)|(\s*$)/g, "");
}

/**
 * 数字验证
 * @param str
 * @returns
 */
function isInt(str) {
	return checkData(str, /^[1-9][0-9]*$/);
}

/**
 * 数字验证
 * @param str
 * @returns
 */
function isNumber(str) {
	return checkData(str, /^[0-9]+$/);
}

/**
 * 中文
 * @param str
 * @return
 */
function isChn(str){ 
	var reg = /^[\u4E00-\u9FA5]+$/; 
	if(!reg.test(str)){ 
	return false; 
	} 
	return true; 
	}

function isNoAndEng(str){
	var reg = /W]/g;
	if(reg.test(str)){ 
		alert("有乱码");
		return false; 
		} 
		alert("全是数字和英文");
		return true; 
}

function checkData(str, pattern) {
	if (pattern.test(str)) {
		return true;
	} else {
		return false;
	}
}

/**
 * 获取字符串长度
 * @param str
 * @return
 */
function strLength(str){
	if(str==null)
		return 0;
	else 
		return str.replace(/[^x00-xff]/g,"01").length;
}

/**
 * 获取字符串长度
 * @param str
 * 要求匹配格式
 * <textarea   onKeyUp="showStrLength(this)" onblur="showStrLength(this)"></textarea>
 * <div class="textcount"><span class="inputCount">0</span>/1000</div>
 * 注意：textarea可以是input
 * @return
 */
function showStrLength(obj){
	var _obj = $(obj);
	str = trim(_obj.val());
	var cou = 0;
	if(str!=null)
		cou =  str.replace(/[^x00-xff]/g,"01").length;
	_obj.siblings(".textcount").find(".inputCount").html(cou);
}

/**
 * 对输入框限制的内容与字数处理
 * @param obj
 * @return
 */
function dealInputContentAndSize(obj){
	var _obj = $(obj);
	str = trim(_obj.val());
	var maxLength=_obj.attr("maxlength");
	
	var returnValue = ''; 
	var count = 0; 
	var temp = 0;
	for (var i = 0; i < str.length; i++) { 
		if (str[i].match(/[^\x00-\xff]/ig) != null) {
			count += 2; 
			temp = 2;
		}else {
			count += 1; 
			temp = 1;
		}
		if (count > maxLength) {
			count -= temp;
			break; 
		}
		returnValue += str[i]; 
	} 
	_obj.val(returnValue);
	$("#numSpan").html(count);
}

/**
 * 只能输入数字
 * @return
 */
function onlyNumber(){ 
	 if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39)) 
	 if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105))) 
	 event.returnValue=false; 
}

/**
 * 除法
 * @param exp1
 * @param exp2
 * @returns {Number}
 */
function Div(exp1, exp2)
{
	var n1 = Math.round(exp1); // 四舍五入
	var n2 = Math.round(exp2); // 四舍五入

	var rslt = n1 / n2; // 除

	if (rslt >= 0)
	{
		rslt = Math.floor(rslt); // 返回值为小于等于其数值参数的最大整数值。
	}
	else
	{
		rslt = Math.ceil(rslt); // 返回值为大于等于其数字参数的最小整数。
	}

	return rslt;
}

function sleep(numberMillis) {
	var now = new Date();
	var exitTime = now.getTime() + numberMillis;

	while (true) {
		now = new Date();
		if (now.getTime() > exitTime)
			return;
	}
}

function removeElementById(id) {
	var obj = document.getElementById(id);
	if (null==obj) return;
	obj.parentNode.removeChild(obj);
}

function escapeHTML(palinText) {
// var div = document.createElement('div');
// var text = document.createTextNode(palinText);
// div.appendChild(text);
// return div.innerHTML;
	return palinText.replace(/</gi , "&lt;").replace(/>/gi , "&gt;").replace(/\"/gi , "&#34;").replace(/\'/gi , "&#39;");
}

function unescapeHTML(htmlText) {
	return htmlText.replace(/&lt;/gi , "<").replace(/&gt;/gi , ">").replace(/&#39;/gi, "\'").replace(/&#34;/gi, "\"").replace(/&amp;/gi, "&").replace(/&#37;/gi, "%").replace(/＄/gi, "$");
}

/**
 * function unescapeHTML(htmlText) { var div = document.createElement('div');
 * div.innerHTML = stripTags(htmlText); return div.childNodes[0].nodeValue; }
 */

function isPunct(src) {
	var regex = /!|"|#|\$|%|&|'|\(|\)|\*|\+|,|-|\.|\/|:|;|<|=|>|\?|@|\[|\|]|\^|_|`|\{|\||}|~/;
	return regex.test(src);
}


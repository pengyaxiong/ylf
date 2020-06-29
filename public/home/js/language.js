/**
 * Created by Administrator on 2018/11/5.
 */
$(function(){
    // do something
    var value = sessionStorage.getItem("language");
    // 
	var textList={
		'language':['中文','English'],
		'mission':['OUR MISSION','我们的使命'],
		'principle':['PRINCIPLE VALUES','核心价值观'],
		'business':['OUR BUSINESS','我们的业务'],
		'content':['CONTENT','研究与洞察'],
		'contactUs':['Contact Us','联系我们'],
		'wechatSign':['Sign in with Wechat','通过微信账号登录']
	}
	// 
	if(value == null){
		value = 0
	}
	$('.dataText').each(function(){
		$(this).html(textList[$(this).attr("data-text")][value])
	})
});

function translate(){
    var value = sessionStorage.getItem("language");
    if(value==="1"){
        sessionStorage.setItem("language", "0");
    }else{
        sessionStorage.setItem("language", "1");
    }
	$('body').append('<div class="loading-bg"><img class="loading-gif" src="images/loading-big.gif" alt=""/></div>')
	var t = setTimeout(function(){
		clearInterval(t)
		window.location.reload();//刷新当前页面.
	},200)
    
}
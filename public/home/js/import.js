$(function(){
	// 
  var url=decodeURIComponent(window.location.href);
  
  $('#header').load('index.html .header',function(response,status,xhr){
    var flag=-1;
    if($('#aboutSign').is('div')){
      flag=1;
    }else if($('#contentSign').is('div')){
      flag=2;
    }else if($('#contactSign').is('div')){
      flag=3;
    }else if($('#loginSign').is('div')){
      flag=8;
    }else if($('#registerSign').is('div')){
      flag=9;
    }
    var navItem=$('.header-nav-item');
    var loginItem=$('.header-login-item');
    if(flag<8){
      navItem.each(function(index,item){
        if(flag===index){
          $(item).addClass('on')
        }else{
          $(item).removeClass('on')
        }
      })
      loginItem.each(function(index,item){
        $(item).removeClass('on')
      })
    }else{
      navItem.each(function(index,item){
        $(item).removeClass('on')
      })
      loginItem.each(function(index,item){
        if(flag===index+8){
          $(item).addClass('on')
        }else{
          $(item).removeClass('on')
        }
      })
    }
    // 点击 退出
    $('#logout').on('click',function(){
      removeLocalStorage('hasLogin')
      window.location.href='login.html'
    })
    
    setHeaderStatus(getLocalStorage('hasLogin'))
	// 
	var textList=['中文','English']
	var value = sessionStorage.getItem("language");
	$('#header .dataText').html(textList[value])
  });
  $('#footer').load('index.html .index-contact',function(){
	  var textList=['Contact Us','联系我们']
	  var value = sessionStorage.getItem("language");
	  $('#footer .dataText').html(textList[value])
  })
  
  function setHeaderStatus(status){
    var not=$('#notLogin');
    var has=$('#hasLogin');
    if(status){
      has.show();
      not.hide();
    }else{
      has.hide();
      not.show();
    }
  }
})

function importLoading(fn){
  $('#pageLoading').load('components/loading.html .loading-bg',function(response,status,xhr){
    // console.log('----------------',response)
    // console.log('+++++++++++++++++',status)
    // console.log('*******************',xhr)
    if(status=='success'){
      console.log('导入成功！！！')
      fn && fn()
    }
  })
}

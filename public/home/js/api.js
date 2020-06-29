var API_HOST='';
var route={
  login:'',
  getCode:'',
  register:''
};
function ajax(url,data,method,successFn,failFn){
  data=data || {};
  method=method || 'GET';
  $.ajax({
    url:API_HOST+url,
    data:data,
    type:method,
    success:function(data){
      successFn && successFn(data)
    },
    error:function(err){
      console.log('请求出错了~~~',err)
      failFn && failFn(err)
    }
  })
}

function setLocalStorage(key,val){
  val=typeof val === 'string' ? val : JSON.stringify(val)
  localStorage.setItem(key,val)
}
function getLocalStorage(key){
  return localStorage.getItem(key) || ''
}
function removeLocalStorage(key){
  localStorage.removeItem(key)
}
function handlePrevClick(input,fn){
  var pageNum=input.val().trim()
  if(pageNum>1){
    input.val(--pageNum)
    fn && fn(pageNum)
  }
}
function handleNextClick(input,totalPage,fn){
  var pageNum=input.val().trim()
  if(pageNum<totalPage){
    input.val(++pageNum)
    fn && fn(pageNum)
  }
}
function showLoading(){
  var loading=$('#pageLoading');
  if(importedLoading){
    loading.show();
  }else{
    importedLoading=true
    importLoading()
  }
}
function hideLoading(){
  $('#pageLoading').hide();
}
function getSearchParam(key){
  var search=decodeURIComponent(window.location.search);
  if(search){
    var arr=search.split('?')[1].split('&')
    for(var i=0;i<arr.length;++i){
      var t=arr[i].split('=')
      if(t[0]==key){
        return t[1]
      }
    }
    return ''
  }
  return ''
}
function requestCode(appId,redirectURI,state){
  var url=encodeURIComponent(redirectURI)
  console.log('url=====',url)
  window.location.href='https://open.weixin.qq.com/connect/qrconnect?appid='+appId+'&redirect_uri='+url+'&response_type=code&scope=snsapi_login&state='+state+'#wechat_redirect'
}
function getParam(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  var r = window.location.search.substr(1).match(reg);
  console.log('=======================',r);
  if (r) return decodeURIComponent(r[2]);
  return null;
}
function getAccessToken(appId,secret){
  var code=getParam('code')
  console.log('code=======',code)
  if(!code) return;
  var url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='+appId+'&secret='+secret+'&code='+code+'&grant_type=authorization_code'
  console.log('url--------',url)
  ajax(url,'','',function(data){
    console.log('获取token：',data);
    /*
     "access_token":"ACCESS_TOKEN",  // 接口调用凭证
     "expires_in":7200,   // access_token接口调用凭证超时时间，单位（秒）
     "refresh_token":"REFRESH_TOKEN",  // 用户刷新access_token
     "openid":"OPENID",    // 授权用户唯一标识
     "scope":"SCOPE",    // 用户授权的作用域，使用逗号（,）分隔
     "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL" // 当且仅当该网站应用已获得该用户的userinfo授权时，才会出现该字段。
    * */
    
    url='https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID';
    ajax(url,'','',function(da){
      console.log('用户信息：',da)
    })
  })
}
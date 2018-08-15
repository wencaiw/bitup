// var address = 'http://54.95.38.134:8080';    //个人IP
// var address = 'http://54.95.38.134:8080';    //目前线上测试地址
var address = window.url;       //后端准环境
//var address = 'https://preapi.bitup.com';       //后端准环境
// var address = 'https://api.bitup.com';      //线上正式地址

//用户点击领取红包接口
var getReward = address + '/v1/rest/activity/red/envelope/receive';

window.onload = function(){
    getRem(375,10);
};
window.onresize = function(){
    getRem(375,10);
};
function getRem(pwidth,prem){
    const html = document.getElementsByTagName("html")[0];
    let oWidth = document.body.clientWidth || document.documentElement.clientWidth;
    html.style.fontSize = oWidth/pwidth*prem + "px";
}
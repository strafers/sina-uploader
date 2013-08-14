<?php
/**************************************************
	#  微博图床 V1 &copy;  lolimilk.com
	#  index.php  Created on 2013.08.06
	#  Weibo: http://weibo.com/614520789
***************************************************/
function curPageURL() 
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") 
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return rtrim($pageURL ,"index.php"); 
}
?>
<?php
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
//print_r($_SESSION);   //获取access_token
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪图床程序Beta1.0</title>
<style type="text/css">
body {
	background-color:#FFF;
	font-size: 14px;
	line-height:20px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
.sapload {
	padding: 1em;
	width: 450px;
	background-color: #fff;
	-moz-border-radius:10px;
	-webkit-border-radius: 10px;
	border-radius:10px;
	border: 2px dashed #CCC;
}
.title{
	font-size:12px;
}
#footer{
    text-align: center;
    border-top: 2px dashed #CCC;
	font-size:12px;
	margin-bottom: -10px;
}
#btm{
	margin-bottom: 5px;
}
#pw{
margin: 20px 5px;
}
.thumbnail{
position: relative;
z-index: 0;
}
.thumbnail:hover{
z-index: 50;
}
.thumbnail span{ 
position: absolute;
background-color: lightyellow;
padding: 1px;
left: -1000px;
border: 2px dashed #CCC;
visibility: hidden;
color: black;
text-decoration: none;
}
.thumbnail span img{
border-width: 0;
padding: 2px;
}
.thumbnail:hover span{ 
visibility: visible;
top: 0;
left: 50px; 
}
</style>
<script type="text/javascript" src="as/as.js"></script>
</head>
<body>
<!--SWF上传Start-->
<div class="sapload">
	<div class="title"><b>SINA 图床程序</b></div>
    <div id="btm">每次选图至多20张,每张不大于2M</div>
    <div id="sapload"></div>
    <div id="pw"></div>
<script type="text/javascript">
	// <![CDATA[
	var so = new SWFObject("as/sapload.swf", "sapload", "450", "25", "9", "#ffffff");
	so.addVariable('types','*.jpg;*.png;*.gif'); //配置图片后缀
	so.addVariable('args','myid=111;yid=222');
	so.addVariable('upUrl','<?php echo curPageURL(); ?>upsina.php');
	so.addVariable('fileName','Filedata1');
	so.addVariable('maxNum','20'); //可同时上传的图片数量
	so.addVariable('maxSize','2'); //最大图片大小
	so.addVariable('etmsg','1');   
	so.addVariable('ltmsg','1');
	so.write("sapload");
	function sapLoadMsg(t){
		var pstr=$("#pw").html();
		var itml = pstr + t;
		$("#pw").html(itml);
	}
</script>
    <div id="footer">部分基于<a href="http://karonl.com/" target="_blank">Karonl</a>的源码,升级渣浪接口为Oauth2.0，我的博客：<a href="http://lolimilk.com">Lolimilk</a></div>
</body>
</html>


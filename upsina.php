<?php
/**************************************************
	#  微博图床 V1 &copy;  lolimilk.com
	#  upsina.php  Created on 2013.08.06
	#	 Weibo: http://weibo.com/614520789
***************************************************/
header('Content-Type:text/html;charset=utf-8'); 
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
if(isset($_FILES['Filedata1']['tmp_name'])){
$weekarray=array("日","一","二","三","四","五","六");
$msg1  = $c->upload("#SinaUploader#".date("Y-m-d H:i:s")."星期".$weekarray[date("w")] ,$_FILES['Filedata1']['tmp_name']);
$msg2=$c->user_timeline_by_id($_SESSION['userinfo']['id'] , 1, 1 , 0, 0, 0, 1, 0);
?>

<?php
	echo '<input type="text" readonly="readonly" onmouseover="this.select()" onfocus="this.select()" value="[img]'.$msg2['statuses']['0']['original_pic'].'[/img]" style="width:340px;">';
	echo '<button class="thumbnail">预览<span><img src="'.$msg2['statuses']['0']['bmiddle_pic'].'" width="50" border="0"></span>';
	echo "<br>";
?>
<?php
}
?>
<?php session_start();
if(!(isset($_SESSION['status']) && $_SESSION['unm']=='admin'))
{
	header("location:../index.php");
}
$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
mysql_select_db ("jobscope",$link) or die("can not select database");
$q="delete from contact where cont_fnm='".$_GET['cat']."'";
mysql_query($q,$link) or die ("wrong query");
mysql_close($link);
header("location:contact.php");
?>
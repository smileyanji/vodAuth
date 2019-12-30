<?php
include_once("../class/Authentication.class.php") ;
include_once("../setting.inc") ;
$post = $_POST ;
$ATUH = new Authentication ( $_API ) ;
$arr = array (
	'storage_detail' => 'storageDetail' ,
	'storage_total' => 'totalStorage' ,
	'storage_rest' => 'restStorage' ,
	'storage_used' => 'usedStorage' ,
	'catagory_create' => 'catagoryCreate' ,
	'catagory_select' => 'catagorySelect' ,
	'video_upload' => 'videoUpload' ,
	'video_list' => 'videoList' ,
	'video_detail' => 'videoDetail' ,
	'video_update' => 'videoUpdate' ,
	'video_delete' => 'videoDelete'
) ;
if ( array_key_exists ( $post['type'] , $arr ) )
{
	$type = $post['type'] ;
	unset ( $post['type'] ) ;
	$ATUH -> getToken () ;
	ksort ( $post ) ;
	$param = array_values ( $post ) ;
	$value = call_user_func_array ( array ( $ATUH , $arr[$type] ) , $param ) ;
	if ( gettype ( $value ) == 'object' )
	{
		$data = ( array ) $value ;
		echo json_encode ( $data ) ;
	}
	else
	{
		echo json_encode ( $value ) ;
	}
}
else
	echo 'illegal access' ;
?>
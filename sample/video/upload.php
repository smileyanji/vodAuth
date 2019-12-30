<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc' ;
$title = 'Storage - Rest' ;
$AUTH -> getToken () ;
?>

<?php include_once '../inc/header.inc' ; ?>
<input type="hidden" id="token" value="<?= $AUTH -> token ; ?>">
<div class="div_main">
	<div class="item">
		<h2>video-upload </h2>

		<div class="item_body">
			<form name="formUpload" id="formUpload" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="token" value="<?= $AUTH -> token ?>">
				<span>video : </span>
				<input type="file" name="video" id="video" class="tag" multiple="multiple">
				<br/>
				<span>encoding : </span>
				<input type="text" name="encodings" class="tag"placeholder="360P,480P,720P,1080P">
				<br/>
				<span>title : </span>
				<input type="text" name="title" class="tag">
				<br/>
				<span>memo : </span>
				<input type="text" name="memo" class="tag">
				<br/>
				<span>storageKey : </span>
				<select name ="storageKey">
					<?php
					foreach ( $_API['storageKey'] as $k => $v )
					{
						echo "<option value ='$v'>$k</option>" ;
					}
					?>
				</select>
				<br/>
				<br/>
				<span>pcQuality : </span>
				<input type="text" name="pcQuality" class="tag">
				<br/>
				<span>mobileQuality : </span>
				<input type="text" name="mobileQuality" class="tag">
			</form>
			<button  type="button" name="btnUpload">submit </button>
			<progress name="progressBar" value="0" max="100"> </progress>
		</div>
	</div>


	<div class="item">
		<h2> video-update </h2>
		<span>video key : </span>
		<input type="text" name="videokey_up" class="tag">
		<br/>
		<span>title : </span>
		<input type="text" name="title_up" class="tag">
		<br/>
		<span>memo : </span>
		<input type="text" name="memo_up" class="tag">
		<br/>
		<span>pc : </span>
		<input type="text" name="pc_up" class="tag">
		<br/>
		<span>mobile : </span>
		<input type="text" name="mobile_up" class="tag">
		<br/>
		<div class="item_body">
			<button type="button" name="videoUpdate">수 정</button>
		</div>

	</div>


	<div class="item">
		<h2> videodelete </h2>

		<div class="item_body">
			<span>video key:</span>
			<input type="text" name="videokey_delete"></input>
			<button type="button" name="videodelete">delete</button>
		</div>

	</div>
</div>

</body>

<!-- jQuery -->
<script src="../jquery.min.js" type="text/javascript"></script>

<script>
$ ( document ).ready ( function () {
	$ ( 'button[name="btnUpload"]' ).click ( function () {
		var fileInput = $ ( '#video' ).get ( 0 ).files[0] ;
		if ( ! fileInput )
		{
			alert ( "업로드할 파일을 선택해주세요." ) ;
			return ;
		}
		var token = $ ( '#token' ).val () ,
				form = new FormData ( document.getElementsByName ( "formUpload" )[0] ) ,
				encoding = form.get ( 'encodings' ) ;
		if ( form.get ( "title" ) == null )
		{
			alert ( 'no title' ) ;
			return ;
		}
		if ( form.get ( "encodings" ) == null )
		{
			alert ( 'no encoding' ) ;
			return ;
		}
		if ( form.get ( "pcQuality" ) == null )
		{
			alert ( 'no pcQuality' ) ;
			return ;
		}
		if ( form.get ( "mobileQuality" ) == null )
		{
			alert ( 'no mobileQuality' ) ;
			return ;
		}
		if ( ! encoding.includes ( ',' ) )
			encoding = encoding + ',' ;
		var encoding_arr = encoding.split ( "," ) ,
				encoding_arr = encoding_arr.filter ( function ( s )
				{
					return s && s.trim () ;
				} ) ;
		form.delete ( "encodings" ) ;
		for ( var i = 0 ; i < encoding_arr.length ; i ++ )
		{
			form.append ( 'encoding[' + i + ']' , encoding_arr[i] ) ;
		}

		$.ajax ( {
			url : "<? echo $AUTH::$videoUrl ?>" ,
			type : "POST" ,
			data : form ,
			dataType : "json" ,
			cache : false ,
			processData : false ,
			contentType : false ,
			xhr : function () {
				myXhr = $.ajaxSettings.xhr () ;
				if ( myXhr.upload )
				{
					myXhr.upload.addEventListener ( 'progress' , function ( e )
					{
						var progressBar = $ ( "progress[name=progressBar]" ) ;
						progressBar.prop ( 'max' , e.total ) ;
						progressBar.val ( e.loaded ) ;
					} , false ) ;
				}
				return myXhr ;
			} ,
			success : function ( data )	{
				console.log ( data ) ;
				if ( typeof ( data.Result ) == "undefined" )
				{
					alert ( "Upload error" ) ;
				}
				else
				{
					alert ( data.Result ) ;
					location.href = location.href ;
				}

			} ,
			error : function ( XMLHttpRequest , textStatus , errorThrown ) {
				console.log ( XMLHttpRequest.status ) ;
				console.log ( XMLHttpRequest.readyState ) ;
				console.log ( textStatus ) ;
			}
		} ) ;
	} ) ;

	$ ( 'button[name="videoUpdate"]' ).click ( function () {
		var title_up = $ ( 'input[name=title_up]' ).val () ,
				memo_up = $ ( 'input[name=memo_up]' ).val () ,
				pc_up = $ ( 'input[name=pc_up]' ).val () ,
				mobile_up = $ ( 'input[name=mobile_up]' ).val () ,
				videokey_up = $ ( 'input[name=videokey_up]' ).val () ;
		$.post ( '../service.php' , {
			'videokey' : videokey_up ,
			'title' : title_up ,
			'memo' : memo_up ,
			'pc' : pc_up ,
			'mobile' : mobile_up ,
			'type' : 'video_update'
		} , function ( data ) {
			//console.log ( data ) ;
			if ( typeof ( data.Result ) == 'undefined' )
			{
				alert ( "update error" ) ;
			}
			else
			{
				alert ( data.Result ) ;
				if ( data.Result.includes ( 'success' ) )
					location.href = location.href ;
			}
		} , "json" ) ;
	} ) ;
	$ ( 'button[name="videodelete"]' ).click ( function () {
		var videokey = $ ( 'input[name=videokey_delete]' ).val () ;
		$.post ( '../service.php' , {
			'type' : 'video_delete' ,
			'videokey' : videokey
		} , function ( data ) {
			if ( typeof ( data.Result ) == "undefined" )
			{
				alert ( "update error" ) ;
			}
			else
			{
				alert ( data.Result ) ;
				if ( data.Result.includes ( 'success' ) )
					location.href = location.href ;
			}
		} , "json" ) ;
	} ) ;
} ) ;
</script>
</html>
<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc' ;
$title = 'Video - play' ;
$AUTH -> getToken () ;
$video_key = $_GET['video_key'] ;
$arr = $AUTH -> videoDetail ( $video_key ) ;
$response = json_decode ( json_encode ( $arr ) , true ) ;
$title_text = empty ( $response['Videos']['title'] ) ? null : $response['Videos']['title'] ;
$memo = empty ( $response['Videos']['memo'] ) ? ' - ' : $response['Videos']['memo'] ;
$size = empty ( $response['Videos']['size'] ) ? null : $response['Videos']['size'] ;
$date_insert = empty ( $response['Videos']['date_insert'] ) ? null : $response['Videos']['date_insert'] ;
$url = empty ( $response['Videos']['url'] ) ? null : $response['Videos']['url'] ;
?>
<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc' ; ?>
<div class="div_head">
	<p><a href="./list.php"> - back - </a></p>
</div>
<div class="div_main">
	<div class="item">
		<div class="item_body clearfix">
			<iframe width="100%" height="720" src="<?= $url ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
			</iframe>
		</div>
		<h1><?= $title_text ?></h1>
		<p><span class="span_title">key : </span><?= $video_key ?></p>
		<p><span class="span_title">내용 : </span><?= $memo ?></p>
		<p><span class="span_title">원본크기 : </span><?= $size ?></p>
		<p><span class="span_title">업로드 일자 : </span><?= $date_insert ?></p>
	</div>
</div>
</body>
</html>
<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc' ;
$title = 'video - list' ;
$AUTH -> getToken () ;
$arr = $AUTH -> videoList () ;
$data = $AUTH -> catagorySelect () ;
?>
<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc' ; ?>
<style>h3{overflow: hidden; text-overflow: ellipsis;}</style>
<link rel="stylesheet" href="../inc/main.css"  />
<div class="div_main">
	<?php foreach ( ( array ) $data -> Catagories as $key => $val ): ?>
		<div class="item">
			<h2><?= $val -> name ?></h2>
			<div class="item_body">
				<ul class="case">
					<?php
					$i = 0 ;
					foreach ( ( array ) $arr -> Videos as $k => $v ):
						if ( $key == $v -> catagory_idx ):
							$i ++ ;
					?>
					<a href="./play.php?video_key=<?= $v -> video_key ?>">
						<li class="">
							<img src="<? echo empty ( $v -> thumbnail_small ) ? '../../img/img1.jpg' : $v -> thumbnail_small ?>">
							<div class="menu_title">
								<h3><?= $v -> title ?></h3>
							</div>
							<p><?= $v -> memo == null ? ' - ' : $v -> memo ?></p>
						</li>
					</a>
					<?php
						endif ;
					endforeach ;
					if ( $i == 0 ):
					?>
					<span>no content</content>
					<?php endif ; ?>

				</ul>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
<?php endforeach ; ?>
	<div class="item">
		<h2>기타</h2>
		<div class="item_body">
			<ul class="case">
				<?php
				$i = 0 ;
				foreach ( ( array ) $arr -> Videos as $k => $v ):
					if ( $v -> catagory_idx == '' ):
						$i ++ ;
				?>
				<a href="./play.php?video_key=<?= $v -> video_key ?>">
					<li class="">
						<img src="<? echo empty ( $v -> thumbnail_small ) ? '../../img/img1.jpg' : $v -> thumbnail_small ?>">
						<div class="menu_title">
							<h3><?= $v -> title ?></h3>
						</div>
						<p><?= $v -> memo == null ? ' - ' : $v -> memo ?></p>
					</li>
				</a>
				<?php
					endif ;
				endforeach ;
				if ( $i == 0 ):
				?>
					<span>no content</content>
				<?php endif ; ?>
			</ul>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
</div>
</body>
</html>
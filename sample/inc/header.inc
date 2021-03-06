<html>
	<head>
	<meta charset="UTF-8" />

	<!-- 웹사이트 정보 -->
	<meta name="description" content=" 홈페이지" />
	<meta name="keywords" content="홈페이지" />
	<title><?=$title?></title>

	<!-- 구글 검색 -->
	<meta name="google" content="nositelinkssearchbox" />
	<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex" />

	<!-- HTML5 비표준이나 대부분의 브라우저는 여전히 참조하고 있다 -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="<?= strftime ( '%b, %d %a %Y %H:%M:%S GMT' ) ?>" />
	<meta http-equiv="imagetoolbar" content="no" />

	<link href="../style.css" rel="stylesheet">
	<script type="text/javascript" src='../inc/jquery.min.js'></script>
	<script type="text/javascript" src='../inc/ajax.js'></script>
	</head>

	<body>
	<div class="div_head">
		<h1><?= $title ?></h1>
		<p><a class = "homeUrl" href=""> - home - </a></p>
	</div>
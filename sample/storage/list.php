<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc' ;

/*
 * Token 생성
 */

$AUTH -> getToken () ;

$title = 'list - Storage' ;
?>

<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc' ; ?>

<div class="div_main">
    <div class="item">
        <h2>소트리지 목록 리스트 : </h2>
		<?php
		/*
		 * 스토리지list 검색
		 */
		$storages = $AUTH -> storageList ( $AUTH -> token ) ;
		if ( $storages && isset ( $storages -> Storages ) )
		{
			$storages = $storages -> Storages ;
			?>
			<div class="item_body">
				<table name="storagesTable" >
					<thead>
						<tr>
							<th width="8%">소트리지명</th>
							<th width="38%">소트리지키</th>
							<th width="10%">소트리지 총용량</th>
							<th width="10%">소트리지 남은용량</th>
							<th width="8%">소트리지 사용률</th>
							<th width="6%">디폴트</th>
							<th width="10%">생성시간</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ( $storages as $val )
						{
							$trSytle = "" ;
							if ( $AUTH -> storageKey == $val -> storage_key )
								$trSytle = "style='font-weight:bolder'" ;
							echo "<tr {$trSytle}>"
							. "<td width= '8%' align='center'>{$val -> name}</td>"
							. "<td width='38%'align='center'>{$val -> storage_key}</td>"
							. "<td width='10%'align='center'>{$val -> hdd}</td>"
							. "<td width='10%'align='center'>{$val -> available}</td>"
							. "<td width='8%'align='center'>{$val -> percent}%</td>"
							. "<td width='6%'align='center'>{$val -> active}</td>"
							. "<td width='10%'align='center'>{$val -> date_insert}</td>"
							. "</tr>" ;
						}
						?>
					</tbody>
				</table>
				<?php
			}
			else
				echo "<script>	alert( '스토리지 조회할때 오류 발생했습니다.' );</script>" ;
			?>
        </div>
    </div>
</div>
</body>
</html>
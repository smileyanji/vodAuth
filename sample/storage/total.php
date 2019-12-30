<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc';
$title = 'Storage - Space';
?>

<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc'; ?>
<div class="div_main">
    <div class="item">
        <h2>소트리지 단일 상세정보 : </h2>
        <div class="item_body">
            Storages:
            <select name ="storagekey">
                <?php
                echo "<option value =''>Choice</option>";
                foreach ($_API['storageKey'] as $k => $v) {
                    echo "<option value ='$v'>$k</option>";
                }
                ?>
            </select>
            <table id="storagSingleTable">
                <tr>
                    <th width="45%">스토리지 총용량 ( byte ) : </th>
                    <td>please select</td>
                </tr>
                <tr>
                    <th>스토리지 남은 용량 ( byte ) : </th>
                    <td>please select</td>
                </tr>
                <tr>
                    <th>스토리지 사용용량 ( byte ) : </th>
                    <td>please select</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        
        $('select[name="storagekey"]').change(function () {
            var storagekey = $(this).val(),
                obj = $('#storagSingleTable').find('td');
            if(storagekey=='')
               return false;
            $.post('../service.php', {
                'storagekey': storagekey,
                'type': 'storage_total',
            }, function (result) {
                //console.log(result);
                if (typeof (result.Result) != "undefined")
                {
                    if (result.Result.includes('success'))
                    {
                      obj.eq(0).html(result.TotalStorage);
                    } else
                        alert(result.Message)
                } else
                    alert(result);
            }, 'json')
            $.post('../service.php', {
                'storagekey': storagekey,
                'type': 'storage_rest',
            }, function (result) {
                //console.log(result);
                if (typeof (result.Result) != "undefined")
                {
                    if (result.Result.includes('success'))
                    {
                        obj.eq(1).html(result.RestStorage);
                       
                    } else
                        alert(result.Message)
                } else
                    alert(result);
            }, 'json')
            $.post('../service.php', {
                'storagekey': storagekey,
                'type': 'storage_used',
            }, function (result) {
                //console.log(result);
                if (typeof (result.Result) != "undefined")
                {
                    if (result.Result.includes('success'))
                    {
                      obj.eq(2).html(result.UsedStorage);
                       
                    } else
                        alert(result.Message)
                } else
                    alert(result);
            }, 'json')
        })
    })
    
    
    
</script>
</html>
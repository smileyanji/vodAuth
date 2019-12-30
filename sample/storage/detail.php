<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc';
$title = 'Storage - Detail';
?>

<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc'; ?>
<div class="div_main">
    <div class="item">
        <h2>소트리지 목록 리스트 : </h2>
        <div class="item_body">
            <div class="item_body">
                Storages:
                <select name ="storage">
                    <option value='' selected="selected">select</option>
                    <?php
                    foreach ($_API['storageKey'] as $k => $v) {
                        echo "<option value ='$v'>$k</option>";
                    }
                    ?>
                </select>
            </div>
            <table name="storagesTable" >
                <thead>
                    <tr>
                        <th width="8%">name</th>
                        <th width="20%">storage_key</th>
                        <th width="10%">hdd</th>
                        <th width="10%">available</th>
                        <th width="8%">percent</th>
                        <th width="6%">state</th>
                        <th width="10%">active</th>
                        <th width="8%">date_update</th>
                        <th width="8%">date_insert</th>
                    </tr>
                </thead>
                <tbody>
                     <tr class="">
                         <td colspan="9">please select</td>
                    </tr>
                    <tr class="storage">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
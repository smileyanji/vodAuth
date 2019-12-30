<?php
/**
 * 스토리지 검색
 * @package storage
 */
include_once '../inc/config.inc';
$title = 'catagory - create/list';
?>
<?php include_once INC . DIRECTORY_SEPARATOR . 'header.inc'; ?>
<div class="div_main">

    <div class="item">
        <h2>분류 추가 : </h2>
        <div class="item_body">
            분류 명 : <input type="text" name = "catagoryname">
            <input type = "button" name = "catagory" class="" value="submit">
        </div>
    </div>
    <div class="item">
        <h2>분류 목록 리스트 : </h2>
        <div class="item_body">
            <table name="storagesTable" >
                <thead>
                    <tr>
                        <th width="8%">name</th>
                        <th width="10%">file_count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $AUTH->getToken();
                    $data = $AUTH->catagorySelect();
                    foreach ((array) $data->Catagories as $val) {
                        echo "<tr><td>" . $val->name . "</td><td>" . $val->file_count . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
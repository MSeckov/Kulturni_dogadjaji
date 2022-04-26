<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<?php $keys = array_keys((array)$data[0]);?><!--get the name of columns for table header-->

<div class="d-flex justify-content-between">
   <h1 class="font">Logs</h1>
</div>
<table class="table table-hover table-bordered caption-top " cellspacing='0' cellpadding='0'>
    <thead>
        <tr>
            <?php 
                foreach($keys as $key){
                    echo '<th>'.tabname_f($key).'</th>';
                }
            ?>
        </tr>
    </thead>
<?php
    foreach($data as $obj => $value):?>
     <tr>
         <?php foreach($value as $key => $v):?>
        <td class="custom-td"><div><?=$v?></div></td>
        <?php 
            $arr_id[] = $v;/*push values*/ 
        ?>
        <?php endforeach ?>
    </tr>
    <?php endforeach ?>
</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>
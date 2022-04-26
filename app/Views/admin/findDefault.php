<?= $this->extend('admin/find') ?>
<?= $this->section('cont') ?>
<?php $keys = array_keys((array)$data[0]);?><!--get the name of columns for table header-->


<div style="overflow-x: auto;" class="mb-3" id="findContent">    
    <table class="table table-hover table-bordered caption-top m-2 " cellspacing='0' cellpadding='0'>
        <thead>
            <tr>
                <?php 
                    foreach($keys as $key){
                        echo '<th>'.tabname_f($key).'</th>';
                    }
                ?>
                <th class="text-end">Actions</th>
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
            <td class="text-end">
            <?php 
                $id = array_shift($arr_id);/*get id*/ 
            ?>
                <?=anchor('admin/edit/'.$heading.'/'.$id,'<i class="far fa-edit" style="color:#d7d7d7"></i>')?>
                <?=anchor('admin/delete/'.$heading.'/'.$id,'<i class="far fa-trash-alt" style="color:#d7d7d7"></i>')?>
                <?php  $arr_id = [];?><!--reset array for each record-->
            </td>
        </tr>
        <?php endforeach ?>
    </table>
    <?=anchor('admin/add/'.$heading,'Add record',['class'=>'add-record mb-3 ms-2','id'=>'addRecord'])?>
    <?= $pager->links() ?>
    <?= $this->endSection() ?>
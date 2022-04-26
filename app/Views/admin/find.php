<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>
<?php $keys = array_keys((array)$data[0]);?><!--get the name of columns for table header-->

<div class="d-flex justify-content-between" >


<h1 class="font ms-1"><?=tabname_f($heading) ?></h1>
<form class="d-flex h-50" style="font-family:  cursive;" action="<?=site_url('admin/search/'.$heading)?>" method="get">
        <label for="tabName" class="custom-label">Pretraga po:</label>
        <select class="form-select" id="tabName" name="column">
            <!--<option value="false">Choose parametar</option>-->
        <?php 
            foreach($keys as $key):?>
                <option value="<?=$key?>"><?=tabname_f($key)?></option>;
            <?php endforeach?>
        </select>
     <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search" data-table="<?=$heading?>">
     <button class="btn btn-outline-dark" type="submit">Search</button>
</form>

 
</div>
<?php if(session()->has('message')):?>
 <script>
     swal(
         'Good job!',
         '<?= session('message')?>',
         'success'
         )
 </script>
<?php endif ?>

<?= $this->renderSection('cont')?>
</div>

<?= $this->endSection() ?>

<?= $this->extend('admin/index') ?>
<?= $this->section('content') ?>

<h1 class="mx-5 my-5">Edit record <?=$id?></h1>
<?php if(session()->has('message')):?>
    <script>
        swal(
            'Good job!',
            '<?= session('message')?>',
            'success'
            )
    </script>
<?php endif ?>    
<?php if (session()->has('errors')) : ?>
	<ul class="alert alert-danger">
	<?php foreach (session('errors') as $error) : ?>
		<li><?= $error ?></li>
	<?php endforeach ?>
	</ul>
<?php endif ?>
<form action="<?=site_url('admin/update/'.$heading.'/'.$id)?>"  class="mx-5 mb-5" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <h3 class="my-5 text-primary"><?=tabname_f($heading)?></h3>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?php $row = (array)$row ?><!-- make std object in to array for easear handling-->
            <?php 
                $array_of_types = ['int'=>'number','varchar'=>'text','datetime'=>'datetime-local','tinyint'=>'checkbox','date'=>'date','text'=>'text','char'=>'text',];//this is just some basic types for project purpose, if you want more just add to array
                foreach($fields as $field):?>
                    <?php if($field->name == 'vesti_image' or $field->name == 'dogadjaji_image') continue;?><!--skip this fields-->
                    <div class="mb-3">
                        <label class="form-labels" for="<?=$field->name?>"><?=tabname_f($field->name)?></label>

                        <!--block for making input fields-->
                        <?php 
                        if($field->max_length > 127):?>
                            <textarea  id="<?=$field->name?>" name="<?=$field->name?>" class="form-control <?php if(session('errors.'.$field->name)) : ?>is-invalid<?php endif ?>" value="<?=$row[$field->name]?>"><?=$row[$field->name]?></textarea>
                       
                        <?php elseif (array_key_exists($field->name, $fkeys)):?>
                            <select class="form-select form-select-sm<?php if(session('errors.'.$field->name)) : ?>is-invalid<?php endif ?>" name="<?=$field->name?>" id="<?=$field->name?>" >
                                <?php foreach($fkeys[$field->name] as $fkey):?>
                                       
                                      <?php foreach(array_chunk($fkey ,2)  as $f):?>
                                   <!--take id for value-->
                                        <option value="<?php $n = array_shift($fkey); echo $n ?>"<?php if($n == $row[$field->name]) echo 'selected' ?>><?=implode(' - ', $f)?></option>
                                        
                                        <?php endforeach ?>

                                    <?php endforeach ?>
                                    
                            </select>
                            
                        <?php else:?>          
                            <input 
                            type="<?php if(array_key_exists($field->type, $array_of_types)) echo $array_of_types[$field->type]?>"
                            id="<?=$field->name?>" 
                            name="<?=$field->name?>" 
                            class="<?= $array_of_types[$field->type] == 'checkbox'? 'form-check-input ' : 'form-control ' ?><?php if(session('errors.'.$field->name)) : ?>is-invalid<?php endif ?>" 
                            value="<?php
                                if($field->type == 'datetime') echo date('Y-m-d\TH:i:s', strtotime($row[$field->name]));
                                elseif($field->type == 'date') echo date('Y-m-d', strtotime($row[$field->name]));
                                elseif($array_of_types[$field->type] == 'checkbox') echo 1;
                                else echo $row[$field->name] 
                                ?>" 
                            <?= $array_of_types[$field->type] == 'checkbox' ? $row[$field->name] == 1 ? 'checked' :'' : ''?>>
                       <?php endif?>

                    </div>    
                <?php endforeach ?>
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <!--block for creating image uploading-->
        <?php if($heading == 'vesti' or $heading == 'dogadjaji'):?>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="<?=$heading.'_image'?>">Image</label>
                <input type="file" class="form-control <?php if(session('errors.poster')) : ?>is-invalid<?php endif ?>"
                    name="<?=$heading.'_image'?>" aria-describedby="posterHelp" placeholder="Title" value="<?= old($heading.'_image') ?>" id="poster_input">
                <small id="posterHelp" class="form-text text-muted">Supported file types: jpg,png,jpeg</small>
                <div>
                <img class="card-img-top" src="<?=base_url('assets/images/'.$heading.'/'.$row[$heading.'_image'])?>" alt="..." id="poster_preview"/>
                </div>
            </div>        
        </div>
        <?php endif?>

        <div class="col-sm-6 col-xs-12 my-5 offset-6">
            <div class="form-group">
        <label class="form-labels" for="reason">Enter your reason for editing &nbsp;<span style="color: red;"> * optional</span></label>
        <input type="text" class="form-control" id="reason" name="reason" value="<?=old('reason')?>"> 
            </div>
        </div> 

    </div>            
</form>
<script> 
    /**script for viewing img when uploading */
    let inputElem = document.getElementById('poster_input');
    let previewElem = document.getElementById('poster_preview');

    inputElem.onchange = event => {
        const [file] = inputElem.files;
        if(file){
            previewElem.src = URL.createObjectURL(file);
        }
    };
</script>

<?= $this->endSection() ?>
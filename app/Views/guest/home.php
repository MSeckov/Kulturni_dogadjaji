<?= $this->extend('master') ?>
<?= $this->section('content') ?>
 <!-- Carousel-->
    <header class="py-3">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-left">
                <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"          class="active indicator" aria-current="true" aria-label="Slide 1">
                    </button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class="indicator">
                    </button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" class="indicator">
                    </button>
                </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="col-6 ms-5">
                                <img src="<?=base_url('assets/images/dogadjaji/'.$dates[0]->dogadjaji_image)?>" alt="..." style="float: left;" width="450px" height="300px">
                            </div>
                            <div class="col-6 ms-4" style="float: left;">
                                <div class="headline">
                                <?php
                                  date_f($dates[0],'dogadjaj_vreme_od','dogadjaj_vreme_do');
                                ?>
                                </div>
                                <div class="title"><?=$dates[0]->dogadjaj_naslov?></div>
                                <p class="txt-of"><?=$dates[0]->dogadjaj_tekst?></p>
                            </div>   
                        </div>
                        <div class="carousel-item">
                            <div class="col-6 ms-5">
                                <img src="<?=base_url('assets/images/dogadjaji/'.$dates[1]->dogadjaji_image)?>" alt="..." style="float: left;" width="450px" height="300px">
                            </div>
                            <div class="col-6 ms-4" style="float: left;">
                                <div class="headline">
                                <?php 
                                     date_f($dates[1],'dogadjaj_vreme_od','dogadjaj_vreme_do');
                                  ?>
                                </div>
                                <div class="title"><?=$dates[1]->dogadjaj_naslov?></div>
                                <p class="txt-of"><?=$dates[1]->dogadjaj_tekst?></p>
                            </div>   
                        </div>
                        <div class="carousel-item">
                            <div class="col-6 ms-5">
                                <img src="<?=base_url('assets/images/dogadjaji/'.$dates[2]->dogadjaji_image)?>" alt="..." style="float: left;" width="450px" height="300px" >
                            </div>
                            <div class="col-6 ms-4" style="float: left;">
                                <div class="headline">
                                <?php 
                                      date_f($dates[2],'dogadjaj_vreme_od','dogadjaj_vreme_do');
                                ?>
                                </div>
                                <div class="title"><?=$dates[2]->dogadjaj_naslov?></div>
                                <p class="txt-of"><?=$dates[2]->dogadjaj_tekst?></p>
                            </div>   
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>
                </div>
            </div>
    </header>
    <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <hr class="h3"> 
                <div class="d-flex justify-content-between" >
                    <h1 class="mb-5">Dogadjaji</h1>
                    <form class="d-flex h-50" style="font-family:  cursive;" action="<?=site_url('home/index')?>" method="get">
                            <select class="form-select" id="tabName" name="column">
                                <option value="">Kategorija</option>
                           <?php foreach($kategorije as $kat):?>
                                <option value="<?=$kat->kat_naziv?>"><?=tabname_f($kat->kat_naziv)?></option>
                            <?php endforeach ?>
                            </select>
                            <select class="form-select" id="mestoNaziv" name="mestoNaziv">
                                <option value="">Mesto</option>
                            <?php foreach($mesto as $mes): ?>
                                <option value="<?=$mes->mesto_naziv?>"><?=tabname_f($mes->mesto_naziv)?></option>
                            <?php endforeach ?>
                            </select>
                            <input type="date"name="searchDatum" id="searchDatum" class="form-control" style="width: 150%;">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
                    
                    <!--Row 1-->
                    <?php 
                    foreach($dogadjaj as $dog):?>

                    <div class="col mb-5" >
                        <div class="card h-100 p-4 carta-hover" >
                            <div class="cart-icons">
                                <img src="<?=base_url('assets/images/kategorije/'.$dog->kat_naziv.'.svg')?>" alt="" >
                            </div>
                            <div class="headline">
                            <?php 
                              date_f($dog,'dogadjaj_vreme_od','dogadjaj_vreme_do');
                            ?>
                            </div>
                            <div class="title title-h"><?=$dog->dogadjaj_naslov?></div>
                            <div class="frame-zoom"><img class="card-img-top slow-zoom" src="<?=base_url('assets/images/dogadjaji/'.$dog->dogadjaji_image)?>" alt="..." /></div>
                            <div class="card-body">
                                <div>
                                    <p class="txt-of"><?=$dog->dogadjaj_tekst?></p>
                                    <span class="more">...procitaj jos</span>
                                    
                                    <div class="headline">Mesto</div>
                                    <div class="title"><?=$dog->mesto_naziv?></div>
                                    <div class="headline">Organizator</div>
                                    <div class="organ-info">
                                        <?php 
                                        echo $dog->organ_naziv.'<br>';
                                        echo $dog->kontakt_tel.'<br>';
                                        echo $dog->email.'<br>';
                                        echo $dog->web_sajt.'<br>';
                                        echo $dog->mesto_naziv.'<br>';
                                        foreach($users as $user=>$u){
                                            if($dog->id_organ == $u->id_organ){
                                                echo $u->ulica_naziv;
                                            }
                                        }
                                       ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php endforeach?>
                </div>
                <hr class="h3">
                <h1 class="">Vesti</h1>
                <!--Row 2-->
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                        $vest_curent_time = date('Y-m-d');
                        foreach($vesti as $vest):?>
                        <?php 
                                $string_time = strtotime($vest->vesti_datum);
                                if($vest_curent_time == date('Y-m-d',$string_time)) $format = '%H:%M';
                                else $format = '%d.%b.%Y';?> 
                        
                       
                            <div class="col mb-5" >
                                <div class="card h-100 p-4 carta-hover" >
                                <img class="card-img-top" src="<?=base_url('assets/images/vesti/'.$vest->vesti_image)?>" alt="..." height="140px"/>
                                <div class="title title-h"><?=$vest->vesti_naziv?></div>
                                <div class="vest-info"><?='<span>'.$vest->kat_naziv.'</span>'.' | '.strftime($format,$string_time).' | '.$vest->organ_naziv?></div>
                                </div>
                            </div>   
                    <?php endforeach?>
                </div>
                <hr class="h3">
                <h1 class="">Oglasi</h1>
                <!--Row 3 -->
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php 
                foreach($oglasi as $oglas):?>

                     <div class="col mb-5" >
                        <div class="card h-100 p-4 carta-hover">
                        <div class="headline">
                            <?php 
                                date_f($oglas,'oglas_datum_od','oglas_datum_do');
                            ?>
                            </div>
                            <div class="title title-h"><?=$oglas->oglas_naslov?></div>
                            <div class="organ-info"><?= $oglas->organ_naziv?></div>
                        </div>
                    </div>
                <?php endforeach?>
                </div>
                <hr class="h3">
                <h1 class="">Ankete</h1> 
                   
            </div>
    </section>

<?= $this->endSection() ?>
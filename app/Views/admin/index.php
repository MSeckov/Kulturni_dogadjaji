<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <?php 
            helper('html');
            helper('auth');
            echo link_tag('css/admin.css');
            echo link_tag('css/styles.css');
            echo link_tag('css/sweat.css');
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('js/sweat.js')?>"></script>
    </head>
    <body class="sb-nav-fixed">
        <div style="margin-left: 15%;">
        <?= view('common/header') ?>
        <?= view('common/contact') ?>
        </div>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="padding-top: 0;">
                    <h4 class="text-center pt-4">Dashboard</h4>
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Database</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php
                                        $arr_of_tab = ['Kategorije','Dogadjaji','Vesti','Oglasi','Karakteristika_prostora','Mesto','Oblast_delovanja','Ulica','Starosno_doba','Organizacija'];
                                     foreach($arr_of_tab as $arr){
                                       echo anchor('admin/find/'.strtolower($arr), str_replace('_',' ',$arr), ['class'=>'nav-link']);
                                     }
                                     ?>
                                </nav>
                            </div>
                           
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                                <div class="sb-nav-link-icon"><i class="far fa-file-alt" style="width:1em;"></i></div>
                                 Izvestaji
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Kreiraj izvestaj</a>
                                    <a class="nav-link" href="layout-static.html">Postojeci izvestaji</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistike
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Kreiraj statistiku</a>
                                    <a class="nav-link" href="layout-static.html">Postojece statistike</a>
                                </nav>
                            </div>
                            <?=anchor('admin/show_logs','<i class="fas fa-clipboard-list"></i><span style="margin-left:10px">Logs</span>',['class'=>'nav-link collapsed'])?>
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="background-color: #212529;">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                         <!-- Section-->

                         <!--for deafult admin view-->
                         <?php if($_SERVER['REQUEST_URI'] == '/admin/index'):?>
                            <h1>Welcome Admin</h1>
                         <?php endif?>
                         <!--sections depend of actions-->
                        <?= $this->renderSection('content') ?>
                    </div>
                </main>
                 <!-- Footer-->
                <?= view('common/footer') ?>
            </div>
            
        </div>
              
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('js/admin.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    </body>
</html>

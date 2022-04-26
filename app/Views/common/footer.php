<footer class="py-5 bg-dark">
            <div class="container d-flex">
                <p class="m-0 text-start text-white col-md-4">
                    Copyright &copy; 2020-<?php echo date("Y");?> 
                </p>
                <!--cube logo-->
                <div class="div-cube col-md-4 text-white text-center" style="margin-top:0;">
                        <section class="cube d-inline-block">
                            <div class="cube-container">
                                <div class="cube-item front"></div>
                                <div class="cube-item back"></div>
                                <div class="cube-item right"></div>
                                <div class="cube-item left"></div>
                                <div class="cube-item top"></div>
                                <div class="cube-item botom"></div>
                            </div>
                        </section>
                        <span class="d-inline-block ms-2">PKDS</span>
                </div>
                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><?=anchor('home/index','Home',['class'=>'nav-link px-2 text-white'])?></li>
                    <li class="nav-item"><?=anchor('home/terms','Terms of use',['class'=>'nav-link px-2 text-white'])?>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link px-2  text-white">About</a></li>
                </ul>
            </div>
</footer>


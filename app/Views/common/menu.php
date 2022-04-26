<?php
    $active_url = $_SERVER['REQUEST_URI']; //for adding active class in links
    $links = [
        'Home' => 'home/index',
        'About' => 'home/index#about',
    ];
    if(logged_in()){
        $links['Logout ' . ucfirst(user()->username)] = 'logout';
    }else{
        $links['Login'] = 'login';
        $links['Sign in'] = 'register';
    }
    if(in_groups('admin')){
        $links['Dashbord'] = 'admin/index';
    }

    foreach($links as $text => $url):?>
        <li class="nav-item mx-0 mx-lg-1">
            <?php if('/'.$url == $active_url) $active = 'active';else $active = ''?>
            <?=anchor($url, $text, ['class'=>'nav-link py-3 px-0 px-lg-3 rounded '.$active])?>
        </li>
    <?php endforeach; ?>
    <li class="nav-item mx-0 mx-lg-1">
            <?php
                if(logged_in()){
                    echo "<span class='nav-link py-3 px-0 px-lg-3 rounded'>Hello " . ucfirst( user()->username)."</span>";
                }?>
    </li>
    <li class="nav-item mx-0 mx-lg-1">
    <span class="nav-link py-3 px-0 px-lg-3 rounded" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">Contact Us</span>
    </li>
    <li class="nav-item mx-0 mx-lg-1" style="position: absolute;right: 5px;">
        <span id="locat" class="nav-link py-2 px-0 px-lg-3 rounded d-flex" style="align-items: center;" ></span>
    </li>
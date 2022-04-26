<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kulturni dogadjaji u Srbiji</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <?php 
            helper('html');
            helper('auth');
            echo link_tag('css/styles.css');
        ?>
    </head>
    <body>
        <!-- Navigation-->
        <?= view('common/header') ?>
        <?= view('common/contact') ?>
        <!-- Section-->
        <?= $this->renderSection('content') ?>
        <!-- Footer-->
        <?= view('common/footer') ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?=base_url('js/scripts.js')?>"></script>
    </body>
</html>

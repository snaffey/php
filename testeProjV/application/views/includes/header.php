<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php if ($this->stylesheet != ""): ?>
        <link rel="stylesheet" href="<?php echo HOME_URI . 'public/static/css/' . $this->stylesheet;?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo HOME_URI . 'public/static/css/style.css';?>">
    <script src="https://kit.fontawesome.com/0c6dcf304d.js" crossorigin="anonymous"></script>
    <?php if ($this->script != ""): ?>
        <script src="<?php echo HOME_URI . 'public/static/js/' . $this->script;?>"></script>
    <?php endif; ?>
    <script src="<?php echo HOME_URI ;?>public/static/js/main.js"></script>
    <script src="<?php echo HOME_URI ;?>public/static/js/onload.js"></script>
    <title><?php echo $this->title; ?></title>
</head>
<body>

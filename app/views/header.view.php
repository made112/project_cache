<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ASSETS ?>css/normalize.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/all.min.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/main.css">

    <title>doc</title>
</head>

<body>
<!-- Start Header -->

<header>

    <nav class="container">

        <a href="#" class="logo">

            <img src="<?= ASSETS ?>logo/logo2.png" alt="" width="100px">

        </a>

        <ul class="links">

            <li><i class="fas fa-times close"></i></li>
            <li><a class="<?= $page_title == "home" ? "active" : "" ?>" href="<?= ROOT ?>home">Home</a></li>
            <li><a class="<?= $page_title == "upload" ? "active" : "" ?>" href="<?= ROOT ?>upload">Upload</a></li>
            <li><a class="<?= $page_title == "Show-images" ? "active" : "" ?>" href="<?= ROOT ?>show_images">Show images</a></li>
            <li><a class="<?= $page_title == "Show-Keys" ? "active" : "" ?>" href="<?= ROOT ?>show_Keys">Show keys</a></li>
            <li><a class="<?= $page_title == "configuration" ? "active" : "" ?>" href="<?= ROOT ?>configuration">Configurations</a></li>
            <li><a class="<?= $page_title == "Statistics" ? "active" : "" ?>" href="<?= ROOT ?>statistics">Details</a></li>

        </ul>

        <i class="fas fa-bars bar"></i>

    </nav>

</header>

<!-- End Header -->


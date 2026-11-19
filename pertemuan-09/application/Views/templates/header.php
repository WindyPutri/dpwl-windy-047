<?php
// Memulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// URL AdminLTE
$adminlte_url = 'http://localhost/template/AdminLTE-2.4.18/';

// Mengambil username admin dari session
$username = $username
    ?? ($_SESSION['admin_username'] ?? 'Admin');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>AdminLTE 2 | Starter</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport">

    <!-- CSS AdminLTE -->
    <link rel="stylesheet"
          href="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet"
          href="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet"
          href="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>dist/css/AdminLTE.min.css">

    <link rel="stylesheet"
          href="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Header utama -->
    <header class="main-header">

        <!-- Logo -->
        <a href="<?= htmlspecialchars(site_url('admin'), ENT_QUOTES, 'UTF-8') ?>"
           class="logo">
            <span class="logo-mini"><b>R</b>NT</span>
            <span class="logo-lg"><b>Rental</b> Mobil</span>
        </a>

        <!-- Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#"
               class="sidebar-toggle"
               data-toggle="push-menu"
               role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Akun admin -->
                    <li class="dropdown user user-menu">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown">

                            <img
                                src="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>dist/img/user2-160x160.jpg"
                                class="user-image"
                                alt="Foto Admin">

                            <span class="hidden-xs">
                                <?= htmlspecialchars(
                                    (string) $username,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu">

                            <!-- Foto dan nama admin -->
                            <li class="user-header">
                                <img
                                    src="<?= htmlspecialchars($adminlte_url, ENT_QUOTES, 'UTF-8') ?>dist/img/user2-160x160.jpg"
                                    class="img-circle"
                                    alt="Foto Admin">

                                <p>
                                    <?= htmlspecialchars(
                                        (string) $username,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                    <small>Administrator</small>
                                </p>
                            </li>

                            <!-- Tombol logout -->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a
                                        href="<?= htmlspecialchars(site_url('auth/logout'), ENT_QUOTES, 'UTF-8') ?>"
                                        class="btn btn-default btn-flat">
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
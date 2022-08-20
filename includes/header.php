<?php

use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();
$usuario = $usuarioLogado ? $usuarioLogado['nome'].'<a class="text-light font-weight-bold m-2" href="logout.php">Sair</a>' : 'Visitante ' . '<a class="text-light font-weight-bold ml-2" href="login.php">Entrar</a>'
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>PHP - Developer</title>
    <style type="text/css">
        .btn-close {
        }
    </style>
</head>
<body class="bg-dark text-light">
    <div class="container">
        <div class="jumbotron bg-primary p-5 text-center">
            <h1>CRUD - Vagas</h1>
            <p>CRUD com PHP Orientado a objetos</p>
            <hr class="border-light">
            <div class="d-flex justify-content-start"> <?= $usuario ?></div>
        </div>


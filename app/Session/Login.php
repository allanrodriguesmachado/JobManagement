<?php

namespace App\Session;

use http\Header;

class Login
{
    /**
     * método responsavel por iniciar sessao
     */
    private static function init()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * método responsavel por retornar dados do usuario
     */
    public static function getUsuarioLogado()
    {
        self::init();

        return self::isLogged() ? $_SESSION['ususario'] : null;
    }

    /**
     * Método responsavel por logar usuario
     */
    public static function login($obUsuario)
    {
        self::init();

        $_SESSION['ususario'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        header('location: index.php');
        exit();
    }

    /**
     * Método responsavel por deslogar usuario
     */
    public static function logout()
    {
        self::init();

        unset($_SESSION['ususario']);
        header('location: login.php');
        exit();
    }

    /**
     * Método responsavel por verificar se o ususario está logado
     */
    public static function isLogged()
    {
        self::init();

        return isset($_SESSION['ususario']['id']);
    }

    /**
     * Método responsavel por obrigar usuario a estar logado para acessar
     */
    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('location: login.php');
            exit();
        }
    }

    /**
     * Método responsavel por obrigar usuario a estar deslogado para acessar
     */
    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('location: index.php');
            exit();
        }
    }
}
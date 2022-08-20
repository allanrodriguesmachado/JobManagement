<?php

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Usuario;
use \App\Session;

Session\Login::requireLogout();

//Mensagem de alerta
$alertaLogin = '';
$alertaCadastro = '';

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'logar':

            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)) {
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }
            Session\Login::login($obUsuario);
            break;
        case 'cadastrar':

            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            if ($obUsuario instanceof Usuario) {
                $alertaCadastro = 'O E-mail digitado já está em uso';
                break;
            }


            if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
                $obUsuario = new Usuario();
                $obUsuario->nome = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();
            }
            Session\Login::login($obUsuario);
            break;
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario-login.php';
include __DIR__ . '/includes/footer.php';
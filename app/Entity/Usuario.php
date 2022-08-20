<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario
{
    /*
     * Identificador unico
     */
    public $id;

    /*
     * Nome do ususario
     */
    public $nome;

    /*
    * Email
    */
    public $email;

    /*
    * Senha
    */
    public $senha;

    /*
    * Método responsavel por cadastrar um novo usuario no banco
    */
    public function cadastrar(): bool
    {
        $obDatabase = new Database('usuarios');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        return true;
    }

    /*
    * Método responsavel por uma instancia do usuario com base do seu email
    */
    public static function getUsuarioPorEmail($email)
    {
        return (new Database('usuarios'))->select('email = "' . $email.'"')->fetchObject(self::class);
    }
}
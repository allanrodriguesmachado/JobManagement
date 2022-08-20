<?php
$alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">' . $alertaLogin . '</div>' : '';
$alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">' . $alertaCadastro . '</div>' : '';
?>
<div class="jumbotron text-light pt-4">
    <div class="row">
        <div class="col">
            <form method="post">
                <h2>Login</h2>
                <?= $alertaLogin ?>
                <div class="form-group">

                    <label for="">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>

                <div class="form-group pt-3">
                    <button type="submit" name="acao" value="logar" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>

        <div class="col">
            <form method="post">
                <h2>Cadatra-se</h2>
                <?= $alertaCadastro ?>
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>

                <div class="form-group pt-3">
                    <button type="submit" name="acao" value="cadastrar" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
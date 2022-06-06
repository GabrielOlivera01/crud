<?php

    require_once "config.php";

    // $usuario = "User.Teste";
    // $senha = "Senha123";
    // $email = "mail.teste@email.com";

    $obj = new Sql();
    $listaReg = $obj->listaUsuariosCadastrados();

    // echo json_encode($listaReg);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Criação do meu primeiro sistema CRUD">
    <title>Document</title>
    <!-- CSS Principal -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Biblioteca de Icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Solid Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css"
        integrity="sha512-qzgHTQ60z8RJitD5a28/c47in6WlHGuyRvMusdnuWWBB6fZ0DWG/KyfchGSBlLVeqAz+1LzNq+gGZkCSHnSd3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BootStrap -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>

<body>
    <header>
        <h1>
            <i class="fa-solid fa-font-awesome"> Controle de Usuarios</i>
        </h1>
    </header>

    <menu>
        <section id="drop-menu">
            <div id="area-bt-hamburguer">
                <div id="stack01" class="stack"></div>
                <div id="stack02" class="stack"></div>
                <div id="stack03" class="stack"></div>
            </div>
        </section>
        <nav>
            <ul id="items-menu">
                <li>
                    <abbr title="Cadastrar novo Usuário">
                        <i class="fa-solid fa-user" onclick="showSectionCadastro()"></i>
                    </abbr>
                </li>
                <li>
                    <abbr title="Editar Usuário">
                        <i class="fa-solid fa-pencil" onclick="showSectionEdicao()"></i>
                    </abbr>
                </li>
                <li>
                    <abbr title="Deletar Usuário">
                        <i class="fa-solid fa-file-circle-xmark" onclick="showSectionExclusao()"></i>
                    </abbr>
                </li>
                <li>
                    <abbr title="Listar Usuários">
                        <i class="fa-solid fa-folder-open" onclick="showSectionRead()"></i>
                    </abbr>
                </li>
                <li>
                    <abbr title="Configurações">
                        <i class="fa-solid fa-gear"></i>
                    </abbr>
                </li>
            </ul>
        </nav>
    </menu>

    <main>
        <!-- Section de Cadastro -->
        <section id="sec-forms-cadastro" class="sec-forms">
            <h1 class="title-forms">Cadastro de Usuário</h1>
            <form class="form-usuario" id="cadastro-usuario" action="cadastro.php" method="post">
                <label for="caduser">Nome de Usuário</label>
                <input id="caduser" name="caduser" type="text" required>
                <label for="cadpass">Senha</label>
                <input id="cadpass" name="cadpass" type="password" required>
                <label for="cademail">E-mail</label>
                <input id="cademail" name="cademail" type="email" required>
                <input id="bt-cadastrar" type="submit" value="Cadastrar">
            </form>
        </section>

        <!-- Section de Edição -->
        <section id="sec-forms-edicao" class="sec-forms">
            <h1 class="title-forms">Edição de Usuário</h1>
            <form class="form-usuario" id="edicao-usuario" action="edicao.php" method="post">
                <label for="edituser">Usuário para Edição</label>
                <input id="edituser" name="edituser" type="text" required>
                <label for="editname">Nome</label>
                <input id="editname" name="editname" type="text">
                <label for="editsenha">Senha</label>
                <input id="editsenha" name="editsenha" type="password">
                <label for="editemail">E-mail</label>
                <input id="editemail" name="editemail" type="email">
                <input id="bt-editar" type="submit" value="Editar">
            </form>
        </section>

        <!-- Section de Exclusão -->
        <section id="sec-forms-exclusao" class="sec-forms">
            <h1 class="title-forms">Exclusao de Usuário</h1>
            <form class="form-usuario" id="exclusao-usuario" action="exclusao.php" method="post">
                <label for="deluser">Nome de Usuário</label>
                <input id="deluser" name="deluser" type="text" required>
                <label for="delpass">Senha</label>
                <input id="delpass" name="delpass" type="password" required>
                <input id="bt-excluir" type="submit" value="Excluir">
            </form>
        </section>

        <!-- Section de read -->
        <section id="sec-read" class="">
            <table id="usuarios-cadastrados" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Senha</th>
                        <th scope="col">E-mail</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    foreach ($listaReg as $key => $value) {
                        
                        echo "<tr>";
                        echo '<th scope="row">'.$key.'</th>';

                        echo '<td>';
                        print_r($listaReg[$key]['usernameusuario']);
                        echo '</td>';

                        echo '<td>';
                        print_r($listaReg[$key]['passwordussuario']);
                        echo '</td>';

                        echo '<td>';
                        print_r($listaReg[$key]['emailusuario']);
                        echo '</td>';

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <!-- <span>Redes Sociais</span> -->
        <ul id="rede-sociais">
            <li>
                <abbr title="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </abbr>
            </li>
            <li>
                <abbr title="Discord">
                    <i class="fa-brands fa-discord"></i>
                </abbr>
            </li>
            <li>
                <abbr title="Telegram">
                    <i class="fa-brands fa-telegram"></i>
                </abbr>
            </li>
            <li>
                <abbr title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </abbr>
            </li>
            <li>
                <abbr title="Linked In">
                    <i class="fa-brands fa-linkedin-in"></i>
                </abbr>
            </li>
            <li>
                <abbr title="GitHub">
                    <i class="fa-brands fa-github"></i>
                </abbr>
            </li>
        </ul>
        <!-- <span id="nome-dev">Developer by Gabriel Oliveira</span> -->
    </footer>

    <script src="./js/javascript.js"></script>
</body>

</html>
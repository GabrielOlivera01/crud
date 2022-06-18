<?php

class Sql extends PDO {

    private $conn;

    function __construct(){

        $this->conn = new PDO("mysql:dbname=CRUD;host=127.0.0.1", "root", "");
    }

    public function cadastraUsuario($username, $password, $email){

        $res = $this->validaUsername($username);

        if ($res !== true) {

            $stmt = $this->conn->prepare('INSERT INTO tb_usuarios (usernameusuario, passwordussuario, emailusuario) VALUES (:username, :passuser, :email);');
        
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':passuser', $password);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
        } else {
            echo "<script>alert('Nome de usuário não disponivel')</script>";
        }
        
        echo "<script>location.href = 'index.php'</script>";
    }

    public function listaUsuariosCadastrados(){

        $stmt = $this->conn->prepare("SELECT * FROM tb_usuarios;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizaDados($usuarioEdicao, $nomeEdicao = "", $senhaEdicao = "", $emailEdicao = ""){

        $stmt = $this->conn->prepare("SELECT * FROM tb_usuarios WHERE usernameusuario = :usuarioEdicao;");
        $stmt->bindValue(':usuarioEdicao', $usuarioEdicao);
        $stmt->execute();

        $dataUserUpdate = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $idUserUpdate = $dataUserUpdate[0]['idusuario'];

        // Atualiza Nome
        $stmt = $this->conn->prepare("UPDATE tb_usuarios SET usernameusuario = :nomeEdicao WHERE idusuario = :idUserUpdate;");
        $stmt->bindValue(':nomeEdicao', $nomeEdicao);
        $stmt->bindValue(':idUserUpdate', $idUserUpdate);
        $stmt->execute();
        
        // Atualiza Senha
        $stmt = $this->conn->prepare("UPDATE tb_usuarios SET passwordussuario = :senhaEdicao WHERE idusuario = :idUserUpdate;");
        $stmt->bindValue(':senhaEdicao', $senhaEdicao);
        $stmt->bindValue(':idUserUpdate', $idUserUpdate);
        $stmt->execute();

        // Atualiza E-mail
        $stmt = $this->conn->prepare("UPDATE tb_usuarios SET emailusuario = :emailEdicao WHERE idusuario = :idUserUpdate;");
        $stmt->bindValue(':emailEdicao', $emailEdicao);
        $stmt->bindValue(':idUserUpdate', $idUserUpdate);
        $stmt->execute();

        $alert = "Atualização concluida com sucesso!";
        return $alert;

    }

    public function deletaUsuario($username, $password){

        $res = $this->validaUsername($username);

        if ($res !== true) {
            $alert = "Nome de usuário incorreto ou inexistente";   
        }else{

            $stmt = $this->conn->prepare("SELECT * FROM tb_usuarios WHERE usernameusuario = :username;");
            $stmt->bindValue(':username', $username);
            $stmt->execute();

            $dataUserDelet = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $idUserDelet = $dataUserDelet[0]['idusuario'];
            $nameUsuario = $dataUserDelet[0]["usernameusuario"];
            $passUserDelet = $dataUserDelet[0]['passwordussuario'];

            if (strcasecmp($username, $nameUsuario) == 0 && strcasecmp($password, $passUserDelet) == 0){
                $stmt = $this->conn->prepare("DELETE FROM tb_usuarios WHERE idusuario = :id;");
                $stmt->bindValue(':id', $idUserDelet);
                $stmt->execute();
                $alert = "Usuário excluido com sucesso!";
            }else{
                $alert = "Senha incorreta!";
            }
        }

        return $alert;
    }

    public function validaUsername($username) {
        
        $listUsersCad = $this->listaUsuariosCadastrados();
        
        $res = false;

        foreach ($listUsersCad as $key => $value) {

            // echo json_encode($listUsersCad);
            
            if (strcasecmp($listUsersCad[$key]['usernameusuario'], $username) == 0) {
                $res = true;
            }
        }
        
        return $res;
    }

    public function selectDataUser($usuario){

        $retorno = false;
        $res = $this->validaUsername($usuario);

        if ($res == true) {
            $stmt = $this->conn->prepare("SELECT * FROM tb_usuarios WHERE usernameusuario = :usuario");
            $stmt->bindValue(':usuario', $usuario);
            $stmt->execute();
            $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $retorno;
    }

    public function validaLogin($usuario, $senha){
        
        $resLogin = false;
        $dataUser = $this->selectDataUser($usuario);
        
        if (strcasecmp($dataUser[0]['usernameusuario'], $usuario) == 0 && strcasecmp($dataUser[0]['passwordussuario'], $senha) == 0) {
            $resLogin = true;    
        }
        
        return $resLogin;
    }

    public function verificaPrivilegio($usuario){

        $dataUsuario = $this->selectDataUser($usuario);
        $privilegio = $dataUsuario[0]['privilegio']; 
        
        return $privilegio;

    }
    
}

?>
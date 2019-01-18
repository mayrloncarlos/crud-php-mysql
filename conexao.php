<?php

// Verifica se o POST existe antes de inserir uma nova pessoa
if(isset($_POST["acao"])){
    if ($_POST["acao"]=="inserir"){
        inserirPessoa();
    }
    if ($_POST["acao"]=="alterar"){
        alterarPessoa();
    }
    if($_POST["acao"]=="excluir"){
        excluirPessoa();
    }
}

// Responsável por criar uma conexão com meu banco
function abrirBanco() {
    $conexao = new mysqli("localhost", "root", "", "agenda");
    return $conexao;
}

// Função responsável inseir uma pessoa no meu banco de dados
    function inserirPessoa() {
        $banco = abrirBanco();
        $sql = "INSERT INTO pessoa(nome, nascimento, endereco, telefone) 
        VALUES ('{$_POST["nome"]}','{$_POST["nascimento"]}','{$_POST["endereco"]}','{$_POST["telefone"]}')";
        $banco->query($sql);
        $banco->close();
        voltarIndex();
    }

// Função responsável editar uma pessoa no meu banco de dados
    function alterarPessoa() {
        $banco = abrirBanco();
        $sql = "UPDATE pessoa SET nome='{$_POST["nome"]}',nascimento='{$_POST["nascimento"]}',endereco='{$_POST["endereco"]}',telefone='{$_POST["telefone"]}' WHERE id='{$_POST["id"]}'";
        $banco->query($sql);
        $banco->close();
        voltarIndex();
    }

// Função responsável excluir uma pessoa no meu banco de dados
    function excluirPessoa() {
        $banco = abrirBanco();
        $sql = "DELETE FROM pessoa WHERE id='{$_POST["id"]}'";
        $banco->query($sql);
        $banco->close();
        voltarIndex();
    }

    function selectAllPessoa() {
        $banco = abrirBanco();
        $sql = "SELECT * FROM pessoa ORDER BY nome";
        $resultado = $banco->query($sql);
        $banco->close();
        // Laço que pega as informações do meu banco, organiza linha a linha e armazena na var $grupo
        while($row = mysqli_fetch_array($resultado)) {
            $grupo[] = $row;
        }
        return $grupo;
    }

    function selectIdPessoa($id) {
        $banco = abrirBanco();
        $sql = "SELECT * FROM pessoa WHERE id=".$id;
        $resultado = $banco->query($sql);
        $banco->close();
        // Laço que pega as informações do meu banco, organiza linha a linha e armazena na var $grupo
        $pessoa = mysqli_fetch_assoc($resultado);
        return $pessoa;
    }

// Após inserir uma nova pessoa, retorna para a página principal
    function voltarIndex(){
        header("Location:index.php");
    }

?>
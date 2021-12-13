<?php

//Função de listagem de clientes pelo id
class UsuarioCliente{
        function listarUsuariosCliente($pdo){
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//Função de listagem de itens por pedido
class ItensCliente{
    public function listarItensCliente($pdo){
        $sql = "SELECT * FROM produtos as pd join pedidos_itens as p on pd.id_produto = p.id_produto";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//Função de listagem de usuários pelo administrador
class ListaUsuarioADM{
    function listarUsuariosADM($pdo){
    $sql = "SELECT * FROM users WHERE id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//Função de pesquisa de usuário (search users)
class PesquisaUsuario{
    function ListaPesquisaUsuario($pdo){
    $pesquisarUsuario = $_POST['search-users'];
    $query = $pdo->prepare("SELECT * FROM users WHERE username LIKE '%$pesquisarUsuario%' LIMIT 5");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}






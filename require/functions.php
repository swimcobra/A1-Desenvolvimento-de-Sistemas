<?php
    function incluir_form_login() {
        if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
            require_once 'form_login.php';
        } else {
            echo "<h2>Olá " . $_SESSION['nome'] . ", você está logado!</h2>";
        }
    }

function verificar_codigo() {
        if(!isset($_GET['codigo'])) {
            return;
        }

        $codigo = (int)$_GET['codigo'];

        switch($codigo) {
            case 0:
                $msg = "<h3>Você não tem permissão para acessar a página requisitada</h3>";
                break;
            case 1:
                $msg = "<h3>Usuário ou Senha inválidos. Por favor, tente novamente</h3>";
                break;
            case 2:
                $msg = "<h3>Por favor, preencha todos os campos do form de login</h3>";
                break;
            case 3:
                $msg = "<h3>Erro na estrutura da consulta SQL. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 4:
                $msg = "<h3>Erro ao excluir a tarefa selecionada. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 5:
                $msg = "<h3>Erro ao cadastar reserva. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 6:
                $msg = "<h3>Hospede Cadastrado com sucesso!</h3>";
                break;
            case 7:
                $msg = "<h3>CPF ou E-mail já cadastrado</h3>";
                break;
            default:
                $msg = "";
                break;
        }

        echo $msg;
    }

    function form_nao_enviado() {
        return $_SERVER['REQUEST_METHOD'] !== 'POST';
    }

    function campos_em_branco_login() {
        return empty($_POST['email']) || empty($_POST['senha']);
    }

    function campos_em_branco_cadastro() {
        return empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['email']) || empty($_POST['senha']);
    }
?>
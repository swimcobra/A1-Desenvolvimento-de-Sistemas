<?php
    //Função para incluir o formulário de login se o usuário não estiver autenticado
    function incluir_form_login() {
        if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
            //Se o usuário não estiver logado, exibe o formulário de login
            require_once 'form_login.php';
        } else {
            //Se estiver logado, mostra uma saudação com o nome do usuário
            echo "<h2>Olá " . $_SESSION['nome'] . ", você está logado!</h2>";
        }
    }
//Função que interpreta um código passado por GET e exibe uma mensagem para cada erro
function verificar_codigo() {
        if(!isset($_GET['codigo'])) {
            return;
        }

        $codigo = (int)$_GET['codigo'];//Garante que o código seja tratado como inteiro
        
        switch($codigo) {
            case 0:
                $msg = "<h3>Você não tem permissão para acessar a página requisitada</h3>";
                break;
            case 1:
                $msg = "<h3>Usuário ou Senha inválidos. Por favor, tente novamente</h3>";
                break;
            case 2:
                $msg = "<h3>Por favor, preencha todos os campos do formulário</h3>";
                break;
            case 3:
                $msg = "<h3>Erro na estrutura da consulta SQL. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 4:
                $msg = "<h3>Erro ao excluir a reserva selecionada. Verifique com o suporte ou tente novamente mais tarde</h3>";
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
            case 8:
                $msg = "<h3>Quarto está ocupado no período informado</h3>";
                break;
            case 9:
                $msg = "<h3>Erro ao realizar Cadastro. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 10:
                $msg = "<h3>Reserva Cadastrada com sucesso!</h3>";
                break;
            case 11:
                $msg = "<h3>Você não possui permissão para excluir a reserva informada</h3>";
                break;
            case 12:
                $msg = "<h3>Você não possui permissão para editar a reserva informada</h3>";
                break;
            case 13:
                $msg = "<h3>Reserva não encontrada. Verifique com o suporte ou tente novamente mais tarde</h3>";
                break;
            case 14:
                $msg = "<h3>Erro ao editar informações da reserva. Verifique com o suporte ou tente mais tarde</h3>";
                break;
            case 15:
                $msg = "<h3>Reserva Editada com sucesso!</h3>";
                break;
            case 16:
                $msg = "<h3>Erro! Quarto informado inexistente</h3>";
                break;
            default:
                $msg = "";
                break;
        }

        echo $msg;
    }
    //Verifica se o formulário não foi enviado via POST
    function form_nao_enviado() {
        return $_SERVER['REQUEST_METHOD'] !== 'POST';
    }
    //Verifica se os campos de login estão em branco
    function campos_em_branco_login() {
        return empty($_POST['email']) || empty($_POST['senha']);
    }
    //Verifica se os campos de cadastro estão em branco
    function campos_em_branco_cadastro() {
        return empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['email']) || empty($_POST['senha']);
    }
    //Verifica se os campos de reserva estão em branco
    function campos_em_branco_reserva() {
        return empty($_POST['checkIn']) || empty($_POST['checkOut']) || empty($_POST['quarto_id']);
    }
?>

# Feito por Lucca Anderle e Matheus Machado 
# Sistema de Gestão de Reservas e Hóspedes
Este é um sistema web básico desenvolvido em PHP, MySQL e HTML/CSS para gerenciar reservas de hotel e cadastros de hóspedes.

## Descrição
O sistema permite que usuários autenticados (hóspedes) façam e gerenciem suas próprias reservas. Ele inclui funcionalidades essenciais para verificar a disponibilidade de quartos, cadastrar novos hóspedes e reservas, e editar ou excluir reservas existentes. O foco principal é a demonstração de interações entre frontend (HTML/CSS/PHP) e backend (PHP com MySQLi).

## Funcionalidades
Autenticação de Hóspedes: Login e logout de usuários (hóspedes) com base em credenciais armazenadas.

Cadastro de Hóspedes: Registro de novos usuários (hóspedes) no sistema.

Gestão de Reservas:

Criação: Permite fazer novas reservas, atribuidas ao id do hospede logado, verificando a disponibilidade do quarto para as datas e o ID do quarto especificados.

Consulta: Exibe a lista de reservas do hóspede logado.

Edição: Permite atualizar os detalhes de uma reserva existente (datas, quarto), com validação de conflito de datas e de existência do quarto.

Exclusão: Possibilita excluir reservas.

## Validações:

Validação de campos obrigatórios.

Verificação de ID de quarto existente.

Verificação de conflito de datas para novas reservas e edições.

Controle de acesso para que hóspedes editem/excluam apenas suas próprias reservas.

Comunicação com Banco de Dados: Utiliza mysqli com Prepared Statements para todas as operações de banco de dados, garantindo segurança contra Injeção SQL.


### Passos para Configuração
### Clone o Repositório:

No terminal:

cd \xampp\htdocs
git clone https://github.com/swimcobra/A1-Desenvolvimento-de-Sistemas


### Configurar o Banco de Dados:

Inicie o servidor web (Apache) e o MySQL através do XAMPP control panel.

Abra o phpMyAdmin: http://localhost/phpmyadmin/ ou se preferir, pode abrir clicando em "admin" na linha do MySql no XAMPP control panel

A partir da página incial do phpMyAdmin, clique no botão "novo", localizado no lado esquerdo da tela, digite o nome desejado (de preferência "hotelconsagrado_bd"), depois disso clique no campo ao lado, deça até o final da lista e selecione "utf8mb4_unicode_ci". Após isso, clique no botão "criar".

Isso deve ter te direcionado para uma página que te permite criar uma tabela, mas ao invés disso, você irá clicar no botão "importar" no topo da tela, que te levará para uma página onde você irá clicar em "Choose File" e selecionar o arquivo "hotelconsagradi_bd.sql". Após selecionado, é só descer a página e clicar no botão "importar".

Se deu tudo certo, agora o banco de dados deve estar com a estrutura criada já com hospedes e reservas cadastradas.

### Configurar Conexão com o Banco de Dados:

Abra o arquivo /require/conexao.php, ele estará com o seguinte código:
```
<?php 
function conectar_banco() {

    $servidor   = 'localhost:3306'; --> Conferir qual porta está sendo utilizada pelo MySql no XAMPP control panel e trocar caso necessário
    $usuario    = 'root';
    $senha      = '';
    $banco      = 'hotelconsagrado_bd'; --> Caso você tenha escolhido criar o banco com um nome diferente do sugerido, altere o nome aqui
    
    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conn) {
        exit("Erro na conexão: " . mysqli_connect_error());
    }

    return $conn;
}

?>
```

## Acessar o Sistema:

Abra seu navegador e navegue até a pasta do projeto http://localhost/A1-Desenvolvimento-de-Sistemas

Como Usar
Cadastro: Acesse cadastro.php para criar uma nova conta de hóspede.

Login: Após o cadastro, faça login utilizando o email e senha fornecidos para acessar as funcionalidades referentes a reserva.

Hospede para teste(caso não queira criar um novo hospede): 
E-mail: teste@gmail.com
Senha: teste123

### Reservas:

Acesse a página de reservas para visualizar suas reservas existentes.

Crie novas reservas preenchendo as datas e o ID do quarto.

Edite reservas existentes clicando no botão "Editar" (requer que a reserva pertença ao hóspede logado).

Exclua reservas clicando no botão "Excluir".

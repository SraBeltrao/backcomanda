# Commanda Digital - Backend em PHP 8 com MySQL

### Projeto de Extensão

Este é um backend simples desenvolvido em **PHP 8** e utiliza o **MySQL** como banco de dados. O projeto oferece uma API RESTful com autenticação e CRUD para os recursos `cardapios`, `comandas`, `mesas`, `pedidos` e `usuarios`.

## Requisitos

- PHP 8 ou superior
- MySQL

## Instalação

### Importar o banco de dados

O arquivo `dump.sql` contém a estrutura inicial do banco de dados. Para importá-lo, execute o seguinte comando:

```bash
mysql -u <usuario> -p <nome-do-banco> < dump.sql
```

Substitua `<usuario>` e `<nome-do-banco>` pelos valores apropriados para o seu ambiente.

### 3. Configuração

No arquivo `config.php`, insira as informações de conexão do seu banco de dados MySQL:

```php
<?php
define("DB_HOST", "localhost");
define("DB_USER", "seu_usuario");
define("DB_PASS", "sua_senha");
define("DB_NAME", "nome_do_banco");
?>
```

Certifique-se de que as credenciais de banco de dados estejam corretamente configuradas para seu ambiente.

## Autenticação

A autenticação é realizada por **sessão** e deve ser feita através do endpoint `/auth`. Envie um **POST** com as credenciais de login e senha.

Exemplo de requisição para autenticação:

```bash
POST /api/v1/auth
Content-Type: application/json

{
  "login": "usuario_exemplo",
  "senha": "senha_exemplo"
}
```

Após autenticação, a sessão será estabelecida e deverá ser mantida nas requisições subsequentes.

## Endpoints

Os endpoints da API estão localizados na pasta `api/v1/` e são responsáveis pelos seguintes recursos:

- **auth**: Autenticação de usuários (requisição POST com login e senha)
- **cardapios**: Manipulação de cardápios (GET, POST, PUT, DELETE)
- **comandas**: Manipulação de comandas (GET, POST, PUT, DELETE)
- **mesas**: Manipulação de mesas (GET, POST, PUT, DELETE)
- **pedidos**: Manipulação de pedidos (GET, POST, PUT, DELETE)
- **usuarios**: Manipulação de usuários (GET, POST, PUT, DELETE)

### **1. Auth**

- **POST** /api/v1/auth
  - Realiza a autenticação com o envio de login e senha.
  - Requer: `login` e `senha` no corpo da requisição.

### **2. Cardápios**

- **GET** /api/v1/cardapios
  - Retorna todos os cardápios.
- **POST** /api/v1/cardapios
  - Cria um novo cardápio.
  - Requer: Dados do cardápio no corpo da requisição.
- **PUT** /api/v1/cardapios/{id}
  - Atualiza um cardápio existente.
  - Requer: Dados do cardápio no corpo da requisição.
- **DELETE** /api/v1/cardapios/{id}
  - Deleta um cardápio.

### **3. Comandas**

- **GET** /api/v1/comandas
  - Retorna todas as comandas.
- **POST** /api/v1/comandas
  - Cria uma nova comanda.
- **PUT** /api/v1/comandas/{id}
  - Atualiza uma comanda existente.
- **DELETE** /api/v1/comandas/{id}
  - Deleta uma comanda.

### **4. Mesas**

- **GET** /api/v1/mesas
  - Retorna todas as mesas.
- **POST** /api/v1/mesas
  - Cria uma nova mesa.
- **PUT** /api/v1/mesas/{id}
  - Atualiza uma mesa existente.
- **DELETE** /api/v1/mesas/{id}
  - Deleta uma mesa.

### **5. Pedidos**

- **GET** /api/v1/pedidos
  - Retorna todos os pedidos.
- **POST** /api/v1/pedidos
  - Cria um novo pedido.
- **PUT** /api/v1/pedidos/{id}
  - Atualiza um pedido existente.
- **DELETE** /api/v1/pedidos/{id}
  - Deleta um pedido.

### **6. Usuários**

- **GET** /api/v1/usuarios
  - Retorna todos os usuários.
- **POST** /api/v1/usuarios
  - Cria um novo usuário.
- **PUT** /api/v1/usuarios/{id}
  - Atualiza um usuário existente.
- **DELETE** /api/v1/usuarios/{id}
  - Deleta um usuário.

## Testando a API

Você pode testar os endpoints utilizando ferramentas como [Postman](https://www.postman.com/) ou [Insomnia](https://insomnia.rest/), ou ainda via linha de comando utilizando o `curl`.

## Licença

Este projeto está sob a licença MIT - consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

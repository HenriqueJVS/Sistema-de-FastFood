# 🍔 Sistema de Fast Food

Este é um sistema de atendimento para um restaurante do tipo fast-food, desenvolvido como parte de um projeto acadêmico da disciplina de Programação Web. O sistema simula o atendimento ao cliente em três modalidades: Totem (cliente), Balcão (atendente) e Gerente Administrativo. Foi implementado com **PHP**, **MySQL**, **HTML**, **CSS (Bootstrap)** e segue o padrão **MVC (Model-View-Controller)**.

## 📌 Funcionalidades Principais

- 👤 **Login e Cadastro**
  - Sistema de login com autenticação via sessão
  - Recuperação de senha com CPF e data de nascimento

- 🍟 **Tela do Cliente (Totem)**
  - Visualiza produtos disponíveis
  - Adiciona itens ao carrinho
  - Escolhe forma de pagamento
  - Finaliza pedido e acompanha status

- 🤝 **Tela do Atendente**
  - Lista de pedidos recebidos
  - Atualiza status: recebido → preparo → pronto → entregue

- 🧑‍💼 **Tela do Gerente**
  - Gerencia atendentes (adicionar, editar, excluir)
  - Acessa histórico de pedidos entregues

- 🧾 **CRUDs Implementados**
  - Produtos
  - Usuários (clientes, atendentes, gerente)
  - Pedidos
  - Itens do pedido

## 🛠️ Tecnologias Utilizadas

- **PHP** (com POO)
- **MySQL** (via `mysqli`)
- **HTML5 & CSS3**
- **Bootstrap 5** (estilização e responsividade)
- **JavaScript** (interações simples)
- **Sessões e Cookies**
- **Proteção CSRF**
- **Padrão MVC**

## 🗂️ Estrutura de Pastas

```
📁 Sistema-de-FastFood/
├── controllers/         # Controladores da aplicação
├── models/              # Classes com lógica de negócio e acesso ao banco
├── views/               # Páginas exibidas ao usuário
│   ├── cliente/
│   ├── atendente/
│   ├── gerente/
│   └── layout/
├── css/                 # Estilos personalizados
├── js/                  # Scripts JS
├── banco.sql            # Script para criar e popular o banco de dados
└── index.php            # Ponto de entrada do sistema
```

## 🚀 Como Executar Localmente

1. **Clonar o repositório**

```bash
git clone https://github.com/biavoitechen/Sistema-de-FastFood.git
```

2. **Mover o projeto para o diretório do XAMPP**

```bash
C:\xampp\htdocs\Sistema-de-FastFood
```

3. **Importar o banco de dados**

- Acesse o `phpMyAdmin`
- Crie um banco com o nome: `fastfood`
- Importe o arquivo `banco.sql` disponível na raiz do projeto

4. **Iniciar o servidor**

- Inicie o **Apache** e o **MySQL** pelo XAMPP
- Acesse no navegador:

```
http://localhost/Sistema-de-FastFood
```

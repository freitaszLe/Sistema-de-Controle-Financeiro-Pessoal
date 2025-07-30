# FinTrack - Sistema de Controle Financeiro Pessoal

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css)
![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)

Um sistema web moderno, construído com o framework Laravel, projetado para ajudar usuários a gerenciar suas finanças pessoais de forma simples, visual e automatizada, substituindo o uso complexo e descentralizado de planilhas.

## 🎯 Sobre o Projeto

Este projeto nasceu da necessidade de uma ferramenta intuitiva para responder à pergunta fundamental: "Para onde foi o meu dinheiro?". Enquanto planilhas de Excel são poderosas, elas podem se tornar complexas, propensas a erros e difíceis de gerenciar em movimento.

O FinTrack resolve isso centralizando todas as informações financeiras em um único lugar, com uma interface limpa e gráficos que facilitam a visualização dos seus hábitos de consumo e fontes de receita.

### ✨ Funcionalidades Principais

* **Dashboard Visual:** Resumo mensal com saldo total, receitas vs. despesas e um gráfico de pizza mostrando a distribuição dos gastos por categoria.
* **Gerenciamento de Contas:** Cadastre todas as suas contas (Carteira, Conta Corrente, Cartão de Crédito) e acompanhe o saldo de cada uma.
* **Lançamento Rápido de Transações:** Adicione receitas e despesas de forma rápida, associando-as a uma conta e uma categoria.
* **Categorização Flexível:** Utilize as categorias padrão do sistema ou crie e gerencie suas próprias categorias de gastos e receitas.
* **Extrato Detalhado:** Visualize e filtre todas as suas transações por data, conta ou categoria.
* **Autenticação Segura:** Cada usuário tem acesso apenas às suas próprias informações financeiras.

## 💾 Modelo do Banco de Dados (DER)

A estrutura do banco de dados foi projetada para separar claramente os dados de autenticação, dados de perfil pessoal e dados financeiros.

### Tabela `users`
Armazena as informações essenciais de login e autenticação.

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | BIGINT (PK) | Identificador único do usuário. |
| `name` | VARCHAR | Nome de exibição ou primeiro nome do usuário. |
| `email`| VARCHAR | E-mail de login, único. |
| `password`| VARCHAR | Senha criptografada. |
| `...` | ... | Outras colunas do Laravel. |

### Tabela `user_profiles`
Armazena os dados pessoais detalhados de cada usuário.

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | BIGINT (PK) | Identificador único do perfil. |
| `user_id`| BIGINT (FK) | Vincula o perfil a um `users.id` (relação 1-para-1). |
| `full_name` | VARCHAR | Nome completo do usuário. |
| `birth_date`| DATE | Data de nascimento. |
| `cpf` | VARCHAR | CPF do usuário, único. |
| `nationality`| VARCHAR | Nacionalidade. |
| `postal_code`| VARCHAR | CEP (Código de Endereçamento Postal). |
| `gender` | VARCHAR | Sexo (ex: 'Masculino', 'Feminino', 'Outro'). |
| `marital_status`| VARCHAR | Estado civil (ex: 'Solteiro(a)', 'Casado(a)'). |

### Tabela `accounts`
Representa os locais onde o dinheiro do usuário está (ex: carteira, conta corrente).

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | BIGINT (PK) | Identificador único da conta. |
| `user_id`| BIGINT (FK) | Vincula a conta a um `users.id`. |
| `name` | VARCHAR | Nome da conta (ex: "Conta Corrente BB"). |
| `type` | VARCHAR | Tipo de conta (ex: 'conta_corrente', 'carteira', 'cartao_credito'). |
| `initial_balance`| DECIMAL | Saldo inicial no momento do cadastro da conta. |

### Tabela `categories`
Armazena as categorias de despesas e receitas do usuário.

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | BIGINT (PK) | Identificador único da categoria. |
| `user_id`| BIGINT (FK) | Vincula a categoria a um `users.id` (para categorias personalizadas). |
| `name` | VARCHAR | Nome da categoria (ex: "Alimentação"). |
| `type` | ENUM('receita', 'despesa') | Define se é uma categoria de entrada ou saída. |

### Tabela `transactions`
O coração do sistema, onde cada receita e despesa é registrada.

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `id` | BIGINT (PK) | Identificador único da transação. |
| `user_id` | BIGINT (FK) | Vincula a transação a um `users.id`. |
| `account_id`| BIGINT (FK) | Vincula a transação a uma `accounts.id`. |
| `category_id`| BIGINT (FK) | Vincula a transação a uma `categories.id`. |
| `description`| VARCHAR | Descrição do lançamento (ex: "Salário de Julho"). |
| `amount`| DECIMAL | Valor da transação. |
| `type` | ENUM('receita', 'despesa') | Tipo de transação. |
| `date` | DATE | Data em que a transação ocorreu. |

### Relacionamentos

* **User ↔ UserProfile (Um-para-Um)**
    * Um `User` tem um `UserProfile`.
    * Um `UserProfile` pertence a apenas um `User`.

* **User ↔ Accounts (Um-para-Muitos)**
    * Um `User` pode ter várias `Accounts`.
    * Uma `Account` pertence a apenas um `User`.

* **User ↔ Categories (Um-para-Muitos)**
    * Um `User` pode ter várias `Categories` personalizadas.
    * Uma `Category` pertence a apenas um `User`.

* **User ↔ Transactions (Um-para-Muitos)**
    * Um `User` pode ter várias `Transactions`.
    * Uma `Transaction` pertence a apenas um `User`.

* **Account ↔ Transactions (Um-para-Muitos)**
    * Uma `Account` pode ter várias `Transactions`.
    * Uma `Transaction` pertence a apenas uma `Account`.

* **Category ↔ Transactions (Um-para-Muitos)**
    * Uma `Category` pode ter várias `Transactions`.
    * Uma `Transaction` pertence a apenas uma `Category`.

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído com as seguintes tecnologias:

* **Backend:**
    * [Laravel 11](https://laravel.com/)
    * [PHP 8.2+](https://www.php.net/)
    * [MySQL](https://www.mysql.com/)
* **Frontend:**
    * [Tailwind CSS](https://tailwindcss.com/)
    * [Alpine.js](https://alpinejs.dev/)
    * [Vite](https://vitejs.dev/)
* **Gráficos:**
    * [Chart.js](https://www.chartjs.org/) (a ser implementado)

## 🚀 Como Começar

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento local.

### Pré-requisitos

* PHP >= 8.2
* Composer
* Node.js e NPM
* Um servidor de banco de dados (ex: MySQL)

### Instalação

1.  **Clone o repositório:**
    ```sh
    git clone [https://github.com/freitaszLe/fintrack.git](https://github.com/freitaszLe/fintrack.git)
    ```

2.  **Navegue até o diretório do projeto:**
    ```sh
    cd fintrack
    ```

3.  **Instale as dependências do PHP:**
    ```sh
    composer install
    ```

4.  **Instale as dependências do JavaScript:**
    ```sh
    npm install
    ```

5.  **Configure o arquivo de ambiente:**
    * Copie o arquivo de exemplo `.env.example` para `.env`.
        ```sh
        cp .env.example .env
        ```
    * Abra o arquivo `.env` e configure as credenciais do seu banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

6.  **Gere a chave da aplicação:**
    ```sh
    php artisan key:generate
    ```

7.  **Execute as migrações do banco de dados:**
    ```sh
    php artisan migrate
    ```

8.  **(Opcional) Popule o banco com dados iniciais:**
    ```sh
    php artisan db:seed
    ```

9.  **Compile os assets de front-end:**
    ```sh
    npm run dev
    ```

10. **Inicie o servidor de desenvolvimento:**
    * Em um novo terminal, execute:
        ```sh
        php artisan serve
        ```
    * Acesse `http://localhost:8000` no seu navegador.

## 🗺️ Roadmap (Próximos Passos)

* [ ] Implementar transferências entre contas.
* [ ] Adicionar funcionalidade de importação e exportação de transações (CSV).
* [ ] Gerar relatórios mensais em PDF.
* [ ] Criar um sistema de metas de orçamento por categoria.
* [ ] Implementar notificações para contas a pagar/receber.

## 📄 Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.

## 📬 Contato

Seu Nome - [@seu_linkedin](https://www.linkedin.com/in/freitaszLe/) - seu.email@exemplo.com

(Link do Projeto: [[https://github.com/freitaszLe/fintrack](https://github.com/freitaszLe/Sistema-de-Controle-Financeiro-Pessoal)]([https://github.com/freitaszLe/fintrack](https://github.com/freitaszLe/Sistema-de-Controle-Financeiro-Pessoal)))

# Sistema de Simulação de Pagamento - Grupo Macro

## 📋 Descrição do Projeto

Este sistema foi desenvolvido como parte do exercício solicitado pelo **Grupo Macro** durante o processo de recrutamento para a vaga de **Engenheiro Informático **.

O objetivo do sistema é simular um fluxo de pagamento online via **M-Pesa**, **E-Mola** ou **Cartão de Crédito**, permitindo:

- ✅ Simulação da confirmação do pagamento
- ✅ Registo automático da transação na base de dados
- ✅ Visualização das transações realizadas


---

## 🚀 Instalação e Configuração

### 1. Clonar o Repositório
```bash
git clone https://github.com/Onesimo23/simulacao_pagamento_GM.git
cd simulacao_pagamento_GM
```

### 2. Instalar Dependências do PHP (Composer)

Certifique-se de ter o [Composer](https://getcomposer.org/) instalado.
```bash
composer install
```

### 3. Instalar Dependências do Frontend (NPM)

Certifique-se de ter o [Node.js](https://nodejs.org/) e o NPM instalados.
```bash
npm install
```

### 4. Configuração do Ambiente

Duplique o arquivo `.env.example`:
```bash
cp .env.example .env
```

Gere a chave da aplicação:
```bash
php artisan key:generate
```

Configure o banco de dados no arquivo `.env`:
```env
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### 5. Executar Migrações e Seeders

O projeto já inclui dois seeders importantes:

- **AdminUserSeeder** – cria automaticamente um utilizador administrador
- **ProductSeeder** – cria produtos para simulação de pagamentos

Execute:
```bash
php artisan migrate --seed
```

Após este comando, o sistema terá automaticamente:

#### 👤 Usuário Administrador

Login disponível:
- **Email:** `onesimonuvunga@gmail.com`
- **Password:** `12345678`

#### 📦 Produtos Pré-Cadastrados

Criados pelo seeder `ProductSeeder`, prontos para uso no checkout.

### 6. Inicializar o Servidor Laravel
```bash
php artisan serve
```

A aplicação ficará disponível em:

🌐 **http://127.0.0.1:8000**

### 7. Compilar os Assets do Frontend

Para desenvolvimento:
```bash
npm run dev
```

---

## 🛠️ Tecnologias Utilizadas

- **Laravel** - Framework PHP
- **MySQL** - Banco de Dados
- **Node.js & NPM** - Gestão de dependências frontend
- **Composer** - Gestão de dependências PHP



---

##  Autor

**Onesimo Nuvunga**

📧 onesimonuvunga@gmail.com

🔗 [GitHub](https://github.com/Onesimo23)

---

## 📄 Licença

Este projeto foi desenvolvido para fins de avaliação técnica do Grupo Macro.

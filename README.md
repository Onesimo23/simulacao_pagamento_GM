Descrição do Projeto

Este sistema foi desenvolvido como parte do exercício solicitado pelo Grupo Macro durante o processo de recrutamento para a vaga de Engenheiro Informático / Programador.

O objetivo do sistema é simular um fluxo de pagamento online via M-Pesa, E-Mola ou Cartão de Crédito, permitindo:

Simulação da confirmação do pagamento

Registo automático da transação na base de dados

Visualização das transações realizadas

O foco foi mantido na implementação da página de checkout e da página de listagem das transações, conforme solicitado.

1. Clonar o Repositório
git clone https://github.com/Onesimo23/simulacao_pagamento_GM.git
cd simulacao_pagamento_GM

2. Instalar Dependências do PHP (Composer)

Certifique-se de ter o Composer instalado.

composer install

3. Instalar Dependências do Frontend (NPM)

Certifique-se de ter o Node.js e o NPM instalados.

npm install

4. Configuração do Ambiente

Duplique o arquivo .env.example:

cp .env.example .env


Gere a chave da aplicação:

php artisan key:generate


Configure o banco de dados no arquivo .env:

DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

5. Executar Migrações e Seeders

O projeto já inclui dois seeders importantes:

AdminUserSeeder – cria automaticamente um utilizador administrador

ProductSeeder – cria produtos para simulação de pagamentos

Execute:

php artisan migrate --seed


Após este comando, o sistema terá automaticamente:

Usuário Administrador

Login disponível:

Email: onesimonuvunga@gmail.com

Password: 12345678

Produtos Pré-Cadastrados

Criados pelo seeder ProductSeeder, prontos para uso no checkout.

6. Inicializar o Servidor Laravel
php artisan serve


A aplicação ficará disponível em:

http://127.0.0.1:8000

7. Compilar os Assets do Frontend

Para desenvolvimento:

npm run dev




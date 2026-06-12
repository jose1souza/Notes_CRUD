Notes CRUD — Laravel

📌 Sobre o Projeto

O Notes CRUD é um sistema académico desenvolvido em Laravel, com foco na organização de disciplinas, cadernos e tarefas.

Permite que o utilizador registe disciplinas, crie cadernos e associe tarefas, funcionando como uma agenda digital para os estudos.

🚀 Tecnologias Utilizadas

Laravel 10+ (PHP Framework)

PHP 8.1 ou superior

Composer (gestor de dependências PHP)

MySQL (base de dados relacional)

Node.js + NPM (para recursos e Vite)

Tailwind CSS (estilização responsiva)

⚙️ Como Executar o Projeto

1. Clonar o repositório

git clone [https://github.com/jose1souza/Notes_CRUD.git](https://github.com/jose1souza/Notes_CRUD.git)
cd Notes_CRUD/laravel_crud


2. Instalar as dependências do PHP

composer install


3. Instalar as dependências do frontend

npm install


4. Configurar o ficheiro .env

Copie o ficheiro de exemplo:

cp .env.example .env


Abra o ficheiro .env e configure as credenciais da sua base de dados local. Exemplo de configuração padrão:

APP_NAME="Notes CRUD"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=


5. Gerar a chave da aplicação

php artisan key_generate


6. Executar as migrações e seeders

Este comando cria as tabelas necessárias e popula a base de dados com dados de teste:

php artisan migrate --seed


7. Iniciar o servidor local

php artisan serve


Aceda à aplicação através do endereço: http://127.0.0.1:8000

8. Compilar os recursos com o Vite

Para o ambiente de desenvolvimento (com Live Reload):

npm run dev


Para gerar o build de produção:

npm run build


📱 Funcionalidades Implementadas

[x] Registo de novo utilizador

[x] Autenticação segura (Login/Logout)

[x] CRUD completo de disciplinas

[x] CRUD completo de cadernos

[x] CRUD completo de tarefas

[x] Navegação responsiva adaptada a dispositivos móveis

[x] Dados simulados via seeders prontos para teste (utilizador padrão: jose@gmail.com)
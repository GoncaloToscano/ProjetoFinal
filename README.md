# ProjetoFinal

git clone 'url' or manually download zip project
ligar xampp (apache + mysql)
criar base de dados (nome: projetofinal)
composer install
npm install
npm run dev (segundo plano)
To make duplicate of .env.example: cp .env.example .env (configurar base de dados) (projetofinal), ficheiro database.php e .env. 
configurar o mail no .env
php artisan queue:work (segundo plano para correr as queues de 10seg em 10seg, para envio de emails)
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan db:seed --class=EmployeeSeeder
php artisan storage:link
php artisan serve


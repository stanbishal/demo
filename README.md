## Installation

Follow the steps

```bash
  git clone https://github.com/stanbishal/demo.git
  cd demo
  composer install
  npm install
  npm run dev
  cp .env.example .env
  php artisan key:generate
```

Now create database 
Open .env file and fill all credentials

After that run following code
```bash
php artisan migrate --db:seed
```
The default email and password will be

email: admin@gmail.com
password: password

```bash
php artisan serve
```

No go to browser and type http://localhost:8000 to serve. 
https://documenter.getpostman.com/view/15709846/2s8YeuKAVf Link for API Documentation.


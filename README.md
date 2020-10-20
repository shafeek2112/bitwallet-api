## Laravel API 

(Assuming you've installed Laravel & composer)

## Installation


## Installation

Clone this project using below command or download as zip and install in your 
system.
```bash
git clone https://mohammedshafeek2112@bitbucket.org/mohammedshafeek2112/mini-aspire-app.git
```

After download the project, run composer install to install necessary packages.
```bash
composer install
```

Create the database and configure the DB connection in .env file. Open .env file to modify the DB credentials to suit your needs. Make sure correctly add your DB credentials below

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:S9Pgbu3/0ukDtLmrHiNyoSYaFIBv3MxE5MsW8L3esj8=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=ADD_YOUR_LOCAL_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DB_USER_NAME
DB_PASSWORD=YOUR_DB_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

```bash
php artisan migrate
```

Now you can start the server by run 
```bash
php artisan serve
```

You can see the "Welcome to Aspire Mini" welcome message in your local server running on your system.

If you see "Your app key is missing", then run the below command
```bash
php artisan key:generate
```
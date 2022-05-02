
# LaravelChat

## 1 - Configuration du projet
Bienvenue sur le projet LaravalChat, voici les étapes à faire pour pouvoir démarrer le projet : 

Pour commencer, exécuter cette commande : 
`composer install`

Ensuite, exécuter cette commande : 
`npm install`

Il faut ensuite avoir un WAMP / XAMPP / MAMP d'installer et créer une BDD avec comme nom : `dbprojetdevlog`

Il faut maintenant créer un fichier `.env` et copier-coller les informations en changeant `DB_USERNAME` et `DB_PASSWORD` par vos informations : 

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:wY0p5CRem3MEoLvKAB8GmndHiCWQHTThNRcbETxmBNg=
    APP_DEBUG=true
    APP_URL=http://laravel-chat.test
    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dbprojetdevlog
    DB_USERNAME=root
    DB_PASSWORD=
    BROADCAST_DRIVER=pusher
    CACHE_DRIVER=file
    FILESYSTEM_DRIVER=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    MEMCACHED_HOST=127.0.0.1
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=null
    MAIL_FROM_NAME="${APP_NAME}"
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false
    PUSHER_APP_ID=anyId
    PUSHER_APP_KEY=anyKey
    PUSHER_APP_SECRET=anySecret
    PUSHER_APP_CLUSTER=mt1
    
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    
    GOOGLE_CLIENT_ID=622112923531-h789pgn03gclu0dhuh0n946r9j8p9jmk.apps.googleusercontent.com
    GOOGLE_CLIENT_SECRET=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
    GOOGLE_CLIENT_REDIERECT=http://127.0.0.1:8000/auth/google/callback
    
    TWITTER_CLIENT_ID=BPsdeBP4aULyqopYJojVJtjKv
    TWITTER_CLIENT_SECRET=zwvxyPI2XBJ9VpQqfaD1vwQhcxeOxSBiYr7lj4IjRic8rDodeW
    TWITTER_CLIENT_REDIERECT=http://127.0.0.1:8000/auth/callback/twitter



Il faut ensuite lancer cette commande `php artisan migrate:fresh`

## 2 - Lancer le projet

Voici maintenant les 3 commandes à exécuter pour que le projet démarre et fonctionne : 

`php artisan serve`

`php artisan websockets:serve`

`npm run watch` 

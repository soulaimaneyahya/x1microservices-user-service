# User service / API Gateway

Generate key
```sh
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

Permissions
```sh
sudo chmod -R 775 storage
```

Running
```sh
php -S localhost:8000 -t public
```

Refresh Tokens
```sh
php artisan db:seed --class=TruncateOAuthTablesSeeder
```

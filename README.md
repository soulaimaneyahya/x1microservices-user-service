# User service / API Gateway

Generate key
```sh
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

Set Permissions
```sh
sudo chmod -R 775 storage
```

Run Service
```sh
php -S localhost:8000 -t public
```

DB Seed
```sh
php artisan db:seed --class=TruncateOAuthTablesSeeder
```


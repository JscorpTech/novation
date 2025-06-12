

generate:
	php artisan auto-crud:generate --swagger-api --type=api --repository --curl --postman

seed:
	php artisan db:seed

fresh:
	php artisan migrate:fresh

res: fresh seed

deploy:
	php artisan serve
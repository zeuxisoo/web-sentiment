all:
	@echo "make server"
	@echo "make database"
	@echo "make migrate"

server:
	@php artisan serve

database:
	touch app/database/production.sqlite

migrate:
	@php artisan migrate

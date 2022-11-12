# Laravel-Mongo Rest API
Aplikasi ini akan *running-well* pada environment seperti di bawah ini:
- PHP 8
- Laravel v8.75
- MongoDb 4.2
- Nginx Stable Alpine

# Instalasi Project
Untuk menjalankan aplikasi ini, ada 2 cara yang bisa dipilih:

- Menggunakan Docker (Recommended)
- Artisan serve
## Menggunakan Docker
### Prasyarat
Sebelum instalasi project menggunakan docker, pastikan Docker & Docker Compose sudah terinstasl di komputer anda. Jika belum, bisa melihat link referensi di bawah ini:
- [Install Docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)
- [Install Docker Compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)

### Instalasi Project
1. Masuk ke root folder project
	```bash
	$ cd inosoft_test
	```
2. Build docker image untuk PHP
	```bash
	$ docker build -f Dockerfile . -t php-fpm8.0:1.0
	```
3. Duplikat file .env.example yang ada di root folder, dilokasi yang sama dan rename menjadi .env.
	```bash
	$ cp -r .env.example .env
	```
	Jika dibutuhkan, silahkan edit value yang ada .env dan sesuaikan dengan sistem komputer anda, misalnya port pada WEB_PORT dan MONGO_EXPRESS_PORT. Jika port tersebut sudah digunakan, silahkan ganti ke port lain yang masih tersedia.
4. Build the container.
	```bash
	$ docker compose up -d
	```
	**Mohon pastikan container inosoft_express running, jika tidak silahkan restart container tersebut*
5. Buat database menggunakan mongo express yang bisa diakses lewat browser, silahkan ke http://localhost:8081 (Ganti port-nya jika anda menggunakan port yang berbeda, sesuai yag anda set di file .env) kemudian create database dengan nama **inosoft**.
6. Generap app-key
	```bash 
	$ docker exec -it inosoft_app php artisan key:generate 
	```
7. Generate table dan data (seed)
	```bash
	$ docker exec -it inosoft_app php artisan migrate --seed
	```
8. Generate encryption key and client access
	```bash
	$ docker exec -it inosoft_app php artisan passport:install
	```
9. Duplikat file .env.example yang ada di /src
	```bash
	$ cp -r ./src/.env.example ./src/.env
	```
## Artisan Serve
1. Masuk ke folder /src
	```bash 
	$ cd inosoft_test/src
	```
2. Duplikat file .env.example yang ada di /src
	```bash
	$ cp -r ./src/.env.example ./src/.env
	```
3. Generap app-key
	```bash 
	$ php artisan key:generate 
	```
4. Generate table dan data (seed)
	```bash
	$ php artisan migrate --seed
	```
5. Generate encryption key and client access
	```bash
	$ php artisan passport:install
	```
6. Run application
	```bash
	$ php artisan serve
	```
# Test
Run command di bawah ini:
Menggunakan docker 
```bash
$ docker exec -it inosoft_app php artisan test
```
Tanpa docker
```bash
$ php artisan test
```

# API
## Postman Collection
Anda bisa mendapatkan API postman collection di link di bawah ini
[https://www.postman.com/collections/78ed9cc58ad7ecad2592](https://www.postman.com/collections/78ed9cc58ad7ecad2592)
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
	cd inosoft_test
	```
2. Build docker image untuk PHP
	```bash
	docker build -f Dockerfile . -t php-fpm8.0:1.0
	```
3. Duplikat file .env.example yang ada di root folder, dilokasi yang sama dan rename menjadi .env.
	```bash
	cp -r .env.example .env
	```
	Jika dibutuhkan, silahkan edit value yang ada .env dan sesuaikan dengan sistem komputer anda, misalnya port pada WEB_PORT dan MONGO_EXPRESS_PORT. Jika port tersebut sudah digunakan, silahkan ganti ke port lain yang masih tersedia.
4. Build the container.
	```bash
	docker compose up -d
	```
	**Mohon pastikan container inosoft_express running, jika tidak silahkan restart container tersebut*
5. Buat database menggunakan mongo express yang bisa diakses lewat browser, silahkan ke http://localhost:8081 (Ganti port-nya jika anda menggunakan port yang berbeda, sesuai yag anda set di file .env). Jika muncul prompt, masukkan:
    - username: inosoft
    - password: inosoft

    Kemudian create database dengan nama **inosoft**.
6. Composer install
	```bash 
	docker exec -it inosoft_app composer install 
	```
7. Duplikat file .env.example yang ada di /src
	```bash
	cp -r ./src/.env.example ./src/.env
	```
8. Generap app-key
	```bash 
	docker exec -it inosoft_app php artisan key:generate 
	```
9. Generate table dan data (seed)
	```bash
	docker exec -it inosoft_app php artisan migrate --seed
	```
10. Execute command berikut ini
	```bash
	docker exec -it inosoft_app php artisan fix:passport
	```
11. Generate encryption key and client access
	```bash
	docker exec -it inosoft_app php artisan passport:install
	```

## Artisan Serve
Langkah instalasi berikut tidak saya sarankan, karena saya belum mencobanya langsung sehingga saya lebih menyarankan menggunakan docker. Jika saat mencoba langkah-langkah instalasi di bawah ini ada kendala, silahkan hubungi saya di tommypriambodo@gmail.com .

1. Buat database di mongodb dengan nama **inosoft**
2. Masuk ke folder /src
	```bash 
	cd inosoft_test/src
	```
3. Duplikat file .env.example yang ada di /src
	```bash
	cp -r ./src/.env.example ./src/.env
	```
    Sesuaikan value didalamnya untuk bisa tekoneksi dengan mongodb 
4. Composer install
	```bash 
	composer install 
	```
5. Generap app-key
	```bash 
	php artisan key:generate 
	```
6. Generate table dan data (seed)
	```bash
	php artisan migrate --seed
	```
7. Execute command berikut ini
	```bash
	php artisan fix:passport
	```
8. Generate encryption key and client access
	```bash
	php artisan passport:install
	```
9. Run application
	```bash
	php artisan serve
	```
# Test
Run command di bawah ini:
Menggunakan docker 
```bash
$ docker exec -it inosoft_app php artisan test
```
Tanpa docker
```bash
php artisan test
```

# API
## Postman Collection
Anda bisa mendapatkan API postman collection di link di bawah ini
[https://www.postman.com/collections/78ed9cc58ad7ecad2592](https://www.postman.com/collections/78ed9cc58ad7ecad2592)
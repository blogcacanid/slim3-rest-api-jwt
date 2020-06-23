# slim3-rest-api-jwt
Rest API Dengan JSON Web Token Slim 3

> https://blog.cacan.id/rest-api-dengan-json-web-token-slim-3

![000](https://user-images.githubusercontent.com/51890752/85407126-ffce9900-b58c-11ea-9fa7-9bc307eab1c9.jpg)

# Cara Penggunaan:

## Clone dari GitHub:
    git clone https://github.com/blogcacanid/slim3-rest-api-jwt.git

## Lalu masuk ke direktori project:
    cd slim3-rest-api-jwt
    composer install

# Testing
Dari direktori project jalankan Slim 3 menggunakan perintah berikut:

    cd slim3-rest-api-jwt
    php -S localhost:8000 -t public

Untuk menjalankan Slim 3 pada port tertentu, misalnya port 9090 anda bisa menjalankannya dengan mengetikkan perintah berikut:
    
    php -S localhost:9090 -t public

## Testing via Postman
Untuk testing kita akan menggunakan Postman.


### Register
Pertama-tama kita daftarkan user baru terlebih dahulu agar kita bisa melakukan login.
- Buka postman lalu pilih method POST kemudian ketikkkan URL http://localhost:8000/api/register
- Kemudian pilih tab Body. Lalu pada radiobox pilih x-www-form-urlencoded. 
- Selanjutnya inputkan data registrasinya seperti berikut:
- name: Rony
- email: rony@rony.com
- password: rahasia
Selanjutnya klik tombol Send

![001](https://user-images.githubusercontent.com/51890752/85407188-18d74a00-b58d-11ea-822d-8a320efe61ed.jpg)


### Login
Setelah registrasi berhasil selanjutnya kita coba untuk login dengan user yang sudah kita registrasikan tersebut.
- Buka postman lalu pilih method POST kemudian ketikkkan URL http://localhost:8000/api/login
- Kemudian pilih tab Body. Lalu pada radiobox pilih x-www-form-urlencoded. 
- Selanjutnya inputkan data email dan password untuk login:
- email: rony@rony.com
- password: rahasia
Selanjutnya klik tombol Send

![002](https://user-images.githubusercontent.com/51890752/85407282-39070900-b58d-11ea-9b05-a588eeb4a820.jpg)



Jika login berhasil, maka kita akan mendapatkan access token. Access Token tersebut nanti akan kita gunakan untuk proses selanjutnya. Simpan token tersebut.

    {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiUm9ueSIsImVtYWlsIjoicm9ueUByb255LmNvbSIsImVtYWlsX3ZlcmlmaWVkX2F0IjpudWxsLCJjcmVhdGVkX2F0IjoiMjAyMC0wNi0yMyAxMDo0NTozMCIsInVwZGF0ZWRfYXQiOiIyMDIwLTA2LTIzIDEwOjQ1OjMwIn0.khZRpx4VbIhdQfPiL0HUvvX3rlkLy_wDwQRuIp6gmWI" 
    }


### Profile
Selanjutnya kita akan mencoba mengakses link Profile.
Link profile ini hanya bisa diakses dengan menggunakan token.
- Buka postman lalu pilih method GET kemudian ketikkkan URL http://localhost:8000/api/profile
- Kemudian pilih tab Authorization. Lalu pada combo TYPE pilih Bearear Token. 
- Selanjutnya pada textbox Token isi dengan data access token yang didapat pada saat login sebelumnya.
Selanjutnya klik tombol Send

![003](https://user-images.githubusercontent.com/51890752/85407315-42907100-b58d-11ea-8c41-d24158fb1bbb.jpg)


# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can run these commands 

	cd [my-app-name]
	php composer.phar start
	
Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:

         cd [my-app-name]
	 docker-compose up -d
After that, open `http://0.0.0.0:8080` in your browser.

Run this command in the application directory to run the test suite

	php composer.phar test

That's it! Now go build something cool.

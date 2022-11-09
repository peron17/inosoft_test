# Prerequisite

Make sure you already install Docker and Docker Compose. If not, please refer to links below.

-   [Install Docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)
-   [Install Docker Compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)

# Setup

1. After clone this project, go to inside this project.

    ```bash
    $ cd inosoft_test
    ```

2. Build docker image for PHP
    ```bash
    $ docker build  -f Dockerfile . -t php-fpm8.0:1.0
    ```
3. Copy **.env.example** file to **.env**. If needed, please adjust .env file to your system environment, like WEB_PORT and MONGO_EXPRESS_PORT. Please check port 80 and 8081. If its used, then you need to change to other available port.
4. Build the container.

    ```bash
    $ docker compose up -d
    ```

5. Create Database. You can access mongo express in browser, please go to http://localhost:[MONGO_EXPRESS_PORT] (the MONGO_EXPRESS_PORT refer to .env file in root project). Then create database **inosoft**.
6.

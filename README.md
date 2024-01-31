# Apocomply Project Setup with Docker

This repository provides a Dockerized setup for Laravel projects, making it easy to set up and run your Laravel applications in a containerized environment.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

1. Clone the repository:

    ```bash
    git clone <repository-url.git>
    cd <project-directory>
    ```

2. Create a copy of the `.env.example` file and name it `.env`:

    ```bash
    cp .env.example .env
    ```

3. Open the `.env` file and configure your Laravel application settings.
   Database credentials must match that in the docker-compose.yml file
    - DB_CONNECTION=mysql
    - DB_HOST=mysql
    - DB_PORT=3306
    - DB_DATABASE=pharmproject
    - DB_USERNAME=root
    - DB_PASSWORD=test
   // --------------------- //
    Also you need to configure your app details such as APP_URL,APP_NAME, APP_ENV=local, APP_KEY, APP_DEBUG=true etc.
    - APP_NAME=Apo-Comply-Reminder-App
    - APP_ENV=local
    - APP_KEY=
    - APP_DEBUG=true
    - APP_URL=http://localhost


5. Build the Docker containers:

    ```bash
    docker-compose build
    ```

6. Start the Docker containers:

    ```bash
    docker-compose up -d
    ```

7. Install Laravel dependencies:

    ```bash
    docker-compose exec laravel-docker composer install
    ```

8. Generate the application key:

    ```bash
    docker-compose exec laravel-docker php artisan key:generate
    ```

9. Run the database migrations:

    ```bash
    docker-compose exec laravel-docker php artisan migrate
    ```
10. Run the database seeder:

    ```bash
    docker-compose exec laravel-docker php artisan db:seed

10. Check your ports menu beside the terminal menu. Your laravel project will be run on the port 9005 as configured in your docker-compose.yml file. Click on the link attached to the port 9005 in your web browser, and you should see your Laravel application.

## Running Commands

To run Artisan commands or any other commands in the app container, you can use `docker-compose exec app <command>`:

```bash
docker-compose exec laravel-docker php artisan migrate

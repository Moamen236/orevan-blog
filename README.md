# Simple Blog Management System API (Laravel)

This project provides a secure and RESTful backend API for a simple blog management system, built with Laravel. It focuses on user authentication using JSON Web Tokens (JWT) and offers CRUD operations for blog posts, enforcing user-specific authorization.

## Features

- User registration and login with JWT authentication:
    - Secure password storage using Laravel's hashing functions
- CRUD operations for blog posts:
    - Create new posts
    - View all posts or a single post by ID
    - Edit existing posts (user can only edit their own posts)
    - Delete posts (user can only delete their own posts)
- User-specific authorization: Ensures users can only manage their own posts

## Prerequisites

* PHP (version 8.0 or later recommended) - https://www.php.net/downloads.php
* Composer (dependency manager) - https://getcomposer.org/download/
* Database (MySQL)

## Installation

1. **Clone the Repository**

   Open your terminal or command prompt and navigate to the desired directory. Clone the project using the following command:

   ```bash
   git clone https://github.com/Moamen236/orevan-blog.git
   ```
2. **Install Dependencies**
    Navigate into the cloned project directory:

    ```bash
    cd orevan-blog
    ```
    Run Composer to install dependencies:

    ```bash
    composer install
    ```

3. **Configure Environment**
    Copy the .env.example file:
    
    ```bash
    cp .env.example .env
    ```
    Edit the .env file:
    Open the .env file in a text editor and update the following placeholders with your actual values:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

4. **Generate Application Key**
    Run the following command to generate a random application key for security:

    ```bash
    php artisan key:generate
    ```

5. **Generate a New JWT Secret Key**
    Important: It's recommended to keep your JWT secret key secure and regenerate it periodically, especially in production environments. You can use the following command to generate a new JWT secret key:

    ```bash
    php artisan jwt:secret
    ```

6. **Create Database**
    Create a database using your preferred method (e.g., MySQL command line, phpMyAdmin). Update the DB_DATABASE value in the .env file with the name of your created database.

7. **Migrate Database Schema**
    Run the following command to create the necessary database tables based on your Laravel models:

    ```bash
    php artisan migrate
    ```


## Running the API

1. **Start Development Server**

   Run the following command to start a development server on port 8000 by default:

   ```bash
   php artisan serve
   ```

   You can access your API in a web browser at http://localhost:8000/api

2. **Testing with Postman**

   If you have Postman installed, import the provided Postman collection for easy testing of API endpoints. Set the base URL to http://localhost:8000/api/ or your API's URL. Remember to include any necessary JWT tokens for authorized requests in the environment.


## Setup With Docker

- Make sure you have Docker installed and running.
- Open your terminal in the project directory.
- Run ```docker-compose ``` build to build the Docker images for your application, Nginx, and phpMyAdmin.
-   Run ```docker-compose up -d ``` to start all the services in detached mode (background).

    **Accessing your application**
    - You can now access your Laravel application through the Nginx reverse proxy at http://localhost:51153.
    - Access phpMyAdmin at http://localhost:8081 using the database credentials you provided in the environment variables.

    **Configure Environment**
    Edit the .env file:
    Open the .env file in a text editor and update the following placeholders with your actual values:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=orevan-blog
    DB_USERNAME=root
    DB_PASSWORD=secret
    ```
	 **Access The Project**
	 This step allows you to access the project directory within the container for running `composer` and `artisan` commands. However, it's generally recommended to use the ```docker-compose``` command for most tasks. If you still need to access the project directory:
	 1. Run the following command to open a shell session inside the `php` container:
		 ```bash
		 docker-compose exec php \bin\sh
		 ```
	 This will place you within the ```/var/www/html``` directory of the container.
	 2. Once finished, you can exit the container session by typing ```exit```.
	
	**Tips:**
	-   Use `docker-compose ps` to view the status of your running containers.
	-   Use `docker-compose stop` to stop the containers and `docker-compose start` to resume them.
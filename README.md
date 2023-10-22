# Project Name: E-Commerce Microservices

## Introduction

This project is a demonstration of an e-commerce system implemented using microservices architecture. It consists of three main services:

1. **Catalog Service**: Manages product listings and details.
2. **Checkout Service**: Handles order placements.
3. **Email Service**: Sends order summaries via email.

Each service is containerized using Docker, ensuring a consistent and isolated environment for development, testing, and production.

## Pre-requisites

Before you begin, ensure you have met the following requirements:

- Docker and Docker Compose installed on your machine.
- Basic knowledge of Laravel, Docker, and microservices architecture.

## Installation & Setup

Follow these steps to get your development environment set up:

### 1. Clone the Repository

```sh
git https://github.com/rafaelogic/ecommerce-microservice.git
cd ecommerce-microservice
```

### 2. Set Up Environment Variables

Copy the example environment variable file for each service:

```sh
cp catalog/.env.example catalog/.env
cp checkout/.env.example checkout/.env
cp email/.env.example email/.env
```

Then, modify the `.env` files according to your local setup and preferences.

### 3. Setup database forward port to avoid port collision
Add this into your `.env` file
```
FORWARD_DB_PORT=3306 #catalog
FORWARD_DB_PORT=3307 #checkout
FORWARD_DB_PORT=3308 #email
```

### 4. Build and Start the Containers
Build each service to its own containers
```sh
cd catalog
sail build
sail up
```
or
```sh
docker-compose up -d --build
```

Add `-d` option to run the containers in detached mode.

### 5. Run Migrations
```sh
docker-compose exec catalog php artisan migrate
docker-compose exec checkout php artisan migrate
docker-compose exec email php artisan migrate
```

### 6. Seed Data for Database (If Necessary)
```sh
docker-compose exec catalog php artisan db:seed
docker-compose exec checkout php artisan db:seed
```

### 7. Access the Services

The services will be available at the following URLs:

- Catalog Service: [http://localhost:8081](http://localhost:8081)
- Checkout Service: [http://localhost:8082](http://localhost:8082)
- Email Service: [http://localhost:8083](http://localhost:8083)

You can modify the port numbers in the `docker-compose.yml` file if these ports are already in use on your system.

## Usage

Describe how to use your application, including examples of API requests, if applicable.

## Running Tests

To run tests, execute the following commands for each service:

```sh
docker-compose exec catalog php artisan test
docker-compose exec checkout php artisan test
docker-compose exec email php artisan test
```
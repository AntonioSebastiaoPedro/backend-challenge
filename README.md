<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# CRUD Places API

This is a Laravel-based REST API for managing places. The application allows you to create, read, update, and delete place records.

## Table of Contents

- [Requirements](#requirements)
- [Setup and Installation](#setup-and-installation)
- [Running the Application](#running-the-application)
- [API Endpoints](#api-endpoints)
- [Data Structure](#data-structure)

## Requirements

- Docker and Docker Compose
- Git

## Setup and Installation

1. Clone the repository:
   ```
   git clone <https://github.com/AntonioSebastiaoPedro/backend-challenge.git>
   cd backend-challenge
   ```

2. Build and start the Docker containers:
   ```
   docker-compose up -d
   ```

3. Enter the application container:
   ```
   docker exec -it laravel-app bash
   ```

4. Install PHP dependencies:
   ```
   composer install
   ```

5. Set up the environment:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

6. Run database migrations and seeders:
   ```
   php artisan migrate
   php artisan db:seed
   ```

## Running the Application

The application runs on port 6060 by default. You can access the API at:

```
http://localhost:6060/api/places
```

## API Endpoints

| Method | Endpoint         | Description                             | Parameters                          |
|--------|------------------|-----------------------------------------|-------------------------------------|
| GET    | /api/places      | List all places (paginated)             | ?page=1&perPage=10&filter=keyword   |
| GET    | /api/places/{id} | Get details of a specific place         |                                     |
| POST   | /api/places      | Create a new place                      | name, city, state                   |
| PUT    | /api/places/{id} | Update an existing place                | name, city, state                   |
| DELETE | /api/places/{id} | Delete a place                          |                                     |

## Data Structure

A place record has the following structure:

```json
{
  "id": 1,
  "name": "Beach Park",
  "slug": "beach-park",
  "city": "Fortaleza",
  "state": "Ceará",
  "created_at": "2025-05-14T15:31:44.000000Z",
  "updated_at": "2025-05-14T15:31:44.000000Z"
}
```

### Request Examples

#### Creating a place

```http
POST /api/places
Content-Type: application/json

{
  "name": "Beach Park",
  "city": "Fortaleza",
  "state": "Ceará"
}
```

#### Updating a place

```http
PUT /api/places/1
Content-Type: application/json

{
  "name": "Beach Park Resort",
  "city": "Aquiraz",
  "state": "Ceará"
}
```

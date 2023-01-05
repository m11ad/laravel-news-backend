
# Laravel News Dashboard

This is the backend for the Laravel News Dashboard application. It is a RESTful API built using the Laravel framework that provides CRUD functionality for news items, categories, and tags.

## Features

-   Users can create, read, update, and delete news items, categories, and tags.
-   News items are associated with a category and can have multiple tags.
-   Validation is implemented for all fields, including external URLs that must follow certain rules (e.g. contain "/article/", not come after "/nl/", etc.).
-   A JSON API is exposed to allow the front-end to retrieve lists and details of news items.
-   Some routes have a header parameter called "X-Active-Custom-Cache" with a value of "1" that can be easily changed in the code.

## Requirements

-   PHP 7.4+
-   Laravel 8+

## Installation

1.  Clone the repository and navigate to the project directory:

`git clone https://github.com/m11ad/grutto-news.git`
`cd grutto-news`

2.  Install dependencies:

`composer install` 

3.  Create a copy of the `.env.example` file and rename it to `.env`:

`cp .env.example .env` 

4.  Generate an app key:

`php artisan key:generate` 

5.  Set up your database connection in the `.env` file.
    
6.  Migrate the database:
    

`php artisan migrate` 

7.  Seed the database with sample data (optional):

`php artisan db:seed` 

8.  Start the development server:

`php artisan serve` 

The API will be available at `http://localhost:8000`.


## Endpoints

### News

-   `GET /api/news`: Returns a list of all news items.
-   `GET /api/news/{id}`: Returns the details of a specific news item.
-   `POST /api/news`: Creates a new news item.
-   `PATCH /api/news/{id}`: Updates an existing news item.
-   `DELETE /api/news/{id}`: Deletes an existing news item.

### Categories

-   `GET /api/categories`: Returns a list of all categories.
-   `GET /api/categories/{id}`: Returns the details of a specific category.
-   `POST /api/categories`: Creates a new category.
-   `PATCH /api/categories/{id}`: Updates an existing category.
-  `DELETE /api/categories/{id}`: Deletes an existing category.
### Tags

-   `GET /api/tags`: Returns a list of all tags.
-   `GET /api/tags/{id}`: Returns the details of a specific tag.
-   `POST /api/tags`: Creates a new tag.
-   `PATCH /api/tags/{id}`: Updates an existing tag.
-   `DELETE /api/tags/{id}`: Deletes an existing tag.


## Author

-   **Milad Yekleh** - _Full Stack Developer_ - [milad.space](https://milad.space) 

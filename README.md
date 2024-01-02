## Queto Test Challenge
This is a simple app developed using PHP Laravel for the Queto full-stack developer position, this app is aimed to manage products, products stock and recipes.
## App Features
This app has many functionalities:
 - Listing of products by filters and pagination
 - Creation of a product with validation
 - Update of a product with validation
 - List of recipes by filters and pagination
 - Creation of a recipe with validation
 - Validation of a recipe and updating products stock
 - Indicating which recipe's product is out of stock

## Installation
- Clone the repository and navigate to the project folder
- Run in your terminal : `composer install `
- Copy .env.example to .env and change your database credentials, i will be sending a database dump by email that you can import and link in the .env file.
- Run migrations : `php  artisan migrate`
- Optional : There is also a bd seeder for populating products with fake data, you can simply run `php artisan db:seed --class=ProductSeeder`
- If all the steps above are done run `php artisan serve` and visit the link displayed in the console, usually http://localhost:8000

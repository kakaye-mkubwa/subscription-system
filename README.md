## Subscription System
System to send subscription to users on addition of post

### Setup
1. Clone the repository and cd into it
2. Run `composer install`
3. Run `cp .env.example .env` to create your own .env file
4. Update the .env file with your database credentials
5. Ensure you have set up your mailgun credentials 
6. . Run `php artisan migrate`
7. Ensure you have defined the `QUEUE_CONNECTION` in your .env file
8. Run `php artisan queue:table` to generate the migration for the queue jobs
9. Run `php artisan migrate` to create the queue jobs table
10. Run `php artisan serve` to start the application

Use the attached postman collection to test the endpoints
Not all endpoints are in the collection, you can use the collection as a guide to test the other endpoints
The endpoints collection is located in the root directory of the project titled `Subscription System.postman_collection.json`



## Subscription System
The Subscription System is a Laravel application that allows users to subscribe to websites and receive notifications when a post is added to the website.
The entities in the system are 
1. Users
2. Websites
3. Posts 
4. Subscriptions.

A user can subscribe to multiple  website and receive notifications when a post is added to the website.
Once a post is added, the system sends an email to all users 
who have subscribed to the website on which the post was added.

### Built With
- [Laravel](https://laravel.com)
- [MySQL](https://mysql.com)

### Prerequisites
- PHP 7.4
- Composer
- MySQL
- Mail client

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

### Contributing
1. Fork the repository
2. Clone the repository
3. Create your feature branch `git checkout -b feature/AmazingFeature`
4. Commit your changes `git commit -m 'Add some AmazingFeature'`
5. Push to the branch `git push origin feature/AmazingFeature`
6. Open a pull request
7. Ensure your pull request description clearly describes the problem and solution. It should include:
    - The operating system used for development
    - Any relevant dependencies required for development
    - A clear description of the solution
    - A clear description of any alternative solutions or features you've considered
    - Any known issues or bugs introduced by the pull request
    - Relevant issue numbers
    - A link to the issue solved by the pull request (if any)

### License
Distributed under the MIT License. See `LICENSE` for more information.

### Contact
If you have any questions, please send an email to `iankay777@gmail.com`




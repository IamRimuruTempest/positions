Prerequisites
Before you begin, ensure you have met the following requirements:

PHP: Version 8 or higher
Composer: Dependency Manager for PHP
Node.js: Version 14 or higher
NPM/Yarn: Package Manager for JavaScript
MySQL: Database Server (or another supported database)


Installation - Backend (Laravel)

1. Clone the repository
git clone <repository-url>
cd <repository-name>


2. Install PHP dependencies
composer install

3. Set up your environment file
Copy the example environment file and set up your .env file:
cp .env.example .env

Edit the .env file to configure your database and other environment settings.


4. Generate an application key
php artisan key:generate


5. Run migrations
php artisan migrate


6. Start the Laravel development server
php artisan serve
The server will start at http://localhost:8000.


Installation - Frontend (Vuejs)

1. Navigate to the frontend directory
cd <frontend-directory>

2. Install JavaScript dependencies
npm install
# or
yarn install

3. Run the development server
npm run dev
# or
yarn dev

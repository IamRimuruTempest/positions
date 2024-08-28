# Prerequisites
Before you begin, ensure you have met the following requirements: <br />

PHP: Version 8 or higher <br />
Composer: Dependency Manager for PHP <br />
Node.js: Version 14 or higher <br />
NPM/Yarn: Package Manager for JavaScript <br />
MySQL: Database Server (or another supported database) <br />




Installation - Backend (Laravel) <br />
<br />
1. Clone the repository <br />
git clone <repository-url> <br />
cd <repository-name> <br />


2. Install PHP dependencies <br />
composer install <br />

3. Set up your environment file <br />
Copy the example environment file and set up your .env file: <br />
cp .env.example .env <br />

Edit the .env file to configure your database and other environment settings. <br />
<br />
<br />
4. Generate an application key <br />
php artisan key:generate <br />
<br />
<br />
5. Run migrations <br />
php artisan migrate <br />
<br />
<br />
6. Start the Laravel development server <br />
php artisan serve <br />
The server will start at http://localhost:8000. <br />
<br />
<br />
Installation - Frontend (Vuejs) <br />
<br />
1. Navigate to the frontend directory <br />
cd <frontend-directory> <br />
<br />
2. Install JavaScript dependencies <br />
npm install <br />
or <br />
yarn install <br />
<br />
3. Run the development server <br />
npm run dev <br />
or <br />
yarn dev <br />

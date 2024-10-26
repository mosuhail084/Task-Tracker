# Task Tracker Application

## Project Overview
This is a Laravel-based Task Tracker Application that allows users to create, assign, and manage tasks across different projects. It includes features for role-based access control and email notifications.

## Requirements
- PHP >= 8.0
- Composer
- Laravel >= 8.x
- MySQL or any supported database
- Node.js (for front-end assets)

## Installation Steps

### 1. Clone the Repository
Clone the project repository to your local machine using the following command:
```bash
git clone <repository-url>
```

### 2. Navigate to the Project Directory
Change into the project directory:
```bash
cd task-tracker
```

### 3. Install Dependencies
Run Composer to install PHP dependencies:
```bash
composer install
```

### 4. Configure Environment File
Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```

### 5. Update Environment Variables
Edit the `.env` file to configure your database and other settings:
```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 6. Generate Application Key
Generate the application key:
```bash
php artisan key:generate
```

### 7. Run Database Migrations
Run the migrations to set up the database:
```bash
php artisan migrate
```

### 8. Seed Database (Optional)
If you have seeders set up, you can seed the database with initial data:
```bash
php artisan db:seed
```

### 9. Install Frontend Dependencies
If your project includes a front-end, install the required Node.js packages:
```bash
npm install
```

### 10. Compile Frontend Assets
Compile the front-end assets using:
```bash
npm run dev
```

### 11. Start the Development Server
Start the Laravel development server:
```bash
php artisan serve
```
You can access the application at `http://localhost:8000`.

## Features
- Role-based access control (Admin, Manager, User)
- Task assignment and management
- Email notifications when tasks are assigned
- Soft delete functionality for tasks

## Contributing
Contributions are welcome! Please create an issue or submit a pull request for any enhancements or bug fixes.

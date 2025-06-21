# BigRewa

A modern email management and quote generation system built with Laravel. BigRewa allows users to create professional quotes, manage email communications through Gmail integration, and track customer interactions with a beautiful, responsive interface.

## 🚀 Features

- **Quote Generation**: Create professional moving quotes with customizable fields
- **Gmail Integration**: Send and receive emails directly through Gmail API
- **Email Templates**: Customizable email templates for different business needs
- **Customer Management**: Track customer communications and quote statuses
- **Statistics Dashboard**: Monitor business performance and email analytics
- **SMTP Configuration**: Support for custom SMTP settings
- **Responsive Design**: Modern, mobile-friendly interface
- **User Authentication**: Secure login and registration system

## 📋 Prerequisites

Before setting up BigRewa locally, ensure you have the following installed:

### Required Software & Compatible Versions

- **PHP**: >= 8.0 (Recommended: 8.1 or 8.2)
- **Composer**: >= 2.0
- **Node.js**: >= 16.x (Recommended: 18.x or 20.x)
- **NPM**: >= 8.x
- **MySQL**: >= 8.0 or **MariaDB**: >= 10.4
- **Web Server**: Apache >= 2.4 or Nginx >= 1.18

### Laravel Framework

- **Laravel**: 9.x or 10.x

### PHP Extensions Required

- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Fileinfo PHP Extension
- GD PHP Extension

## 🛠️ Local Setup Instructions

### 1. Clone the Repository

```bash
git clone <repository-url>
cd BigRewa2025
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup

#### Create Database

Create a new MySQL/MariaDB database for the project:

```sql
CREATE DATABASE bigrewa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Configure Database Connection

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bigrewa_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### Run Migrations

```bash
php artisan migrate
```

#### Seed Database (Optional)

```bash
php artisan db:seed
```

### 6. Google API Configuration

For Gmail integration, you'll need to set up Google API credentials:

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Gmail API
4. Create OAuth 2.0 credentials
5. Add your credentials to `.env`:

```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 7. File Permissions

Set appropriate permissions for storage and cache directories:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 8. Build Assets

```bash
# Development build
npm run dev

# Or for production
npm run build
```

### 9. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## ⚙️ Configuration

### Email Configuration

#### SMTP Settings

Configure SMTP settings in your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="BigRewa"
```

#### Gmail API (Recommended)

For better integration, use Gmail API instead of SMTP:

1. Complete Google API setup (Step 6 above)
2. Configure OAuth credentials in the application
3. Users can connect their Gmail accounts through the interface

### Storage Configuration

Configure file storage in `.env`:

```env
FILESYSTEM_DISK=local
```

## 🗂️ Project Structure

```
BigRewa2025/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── ...
├── resources/
│   ├── views/               # Blade templates
│   ├── js/                  # JavaScript files
│   └── css/                 # Stylesheets
├── routes/
│   ├── web.php              # Web routes
│   └── settings.php         # Settings routes
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
└── public/                  # Public assets
```

## 📄 License

This project is proprietary software. All rights reserved.

## 📞 Support

For support and questions, please contact the development team.

---

**BigRewa** - Professional Quote Management System

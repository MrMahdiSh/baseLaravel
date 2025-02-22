Base Laravel API with JWT Authentication, Spatie Roles, and Swagger Documentation
🚀 Project Overview
Welcome to the Base Laravel API project! This is a robust foundation designed for developers who want to quickly build secure and scalable APIs. It comes with pre-configured JWT Authentication, Spatie Roles & Permissions, and Swagger API Documentation, so you can focus on building features without spending time on boilerplate setups.

🛠 Features
🔑 JWT Authentication
Secure token-based authentication to protect API endpoints.

📝 User Registration & Login
Allows users to create accounts and log in with JWT-based tokens.

📧 Email Verification
Ensures that users verify their email before accessing the application.

🔒 Spatie Roles & Permissions
Easily manage user roles and permissions, defining who can access what.

📄 Swagger API Documentation
Automatically generated API docs, making it easier for you and your team to understand and integrate with the API.

⚡ Rate Limiting
Built-in rate limiting to prevent abuse and ensure a smooth experience for all users.

🔑 Password Reset
Secure password reset functionality with email-based recovery.

🌱 Fully Scalable
This is a solid base, ready to be extended with new features as your project grows.

📋 Prerequisites
Before getting started, make sure you have the following installed:

PHP 8.0+
Composer
MySQL or PostgreSQL (choose your preferred database)
Laravel 9.x+
Node.js (optional, if you're using front-end integration)
⚙️ Installation Guide
Step 1: Clone the repository
Clone this repository to your local machine:

bash
Copy
Edit
git clone https://github.com/yourusername/laravel-api-base.git
cd laravel-api-base
Step 2: Install dependencies
Run the following command to install all required PHP packages:

bash
Copy
Edit
composer install
Step 3: Configure environment variables
Rename .env.example to .env and fill in the required configuration variables:

bash
Copy
Edit
cp .env.example .env
Update the following in the .env file:

DB_CONNECTION (MySQL or PostgreSQL)
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
JWT-related settings (if needed)
Step 4: Generate the application key
Run the command to generate a secure application key:

bash
Copy
Edit
php artisan key:generate
Step 5: Run database migrations
Apply the migrations to create the necessary tables:

bash
Copy
Edit
php artisan migrate
Step 6: Set up Swagger Documentation
Generate Swagger documentation using the following command:

bash
Copy
Edit
php artisan swagger-lume:generate
You should now be able to access your API docs via /api/documentation.

🚀 Usage
Register a New User
POST /api/register

Body:
json
Copy
Edit
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
Log in and Get JWT Token
POST /api/login

Body:

json
Copy
Edit
{
  "email": "john@example.com",
  "password": "password123"
}
Response:

json
Copy
Edit
{
  "access_token": "your-jwt-token-here",
  "token_type": "bearer"
}
Email Verification
Once users register, they will receive a verification email. Ensure they verify their email before they can access protected routes.

🛡 Security
This base project focuses on providing secure authentication and authorization through:

JWT Authentication: All protected routes require a valid JWT token.
Role-Based Access Control: Using Spatie's roles and permissions package, roles like 'admin', 'user', and custom roles can be easily assigned.
Email Verification: Ensures that users have a valid email before accessing sensitive features.
🧑‍🤝‍🧑 Contributing
We encourage contributions! If you'd like to improve this project, feel free to fork it and submit a pull request.

How to Contribute
Fork the repository
Create a new branch for your feature (git checkout -b feature-name)
Make your changes and commit them (git commit -am 'Add new feature')
Push your branch to your fork (git push origin feature-name)
Open a Pull Request with a description of the changes
🌍 API Documentation
Access live API documentation powered by Swagger:

bash
Copy
Edit
http://localhost:8000/api/documentation
This will give you full access to all available routes, authentication methods, and more!

🛠 Tools and Technologies
Laravel 9.x: PHP framework used for building this API.
JWT: For secure, token-based authentication.
Spatie: For role and permission management.
Swagger: For auto-generating API documentation.
Composer: PHP dependency manager.
MySQL/PostgreSQL: Database options for your project.
Rate Limiting: To protect against excessive API calls.
📢 License
This project is licensed under the MIT License - see the LICENSE file for details.

📝 Acknowledgments
Spatie: For their amazing packages that make Laravel development smoother.
Swagger: For providing a clear and simple way to document APIs.
JWT: For making secure authentication easier.
🤖 Support
If you encounter any issues or have questions, feel free to open an issue or contact me directly.


# MyApp1

## Description
MyApp1 is a web application built using Laravel. It includes features such as user authentication, database seeding, and more.

## Features
- User authentication
- Admin user creation
- Database migrations and seeding
- Tailwind CSS for styling
- Vite for asset bundling

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```bash
   cd myapp1
   ```

3. Install dependencies:
   ```bash
   composer install
   npm install
   ```

4. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Seed the database:
   ```bash
   php artisan db:seed
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage
- Access the application at `http://localhost:8000`.
- Log in using the seeded admin credentials (`admin@example.com` / `password`).

## Contributing
Feel free to submit issues or pull requests for improvements.

## License
This project is open-source and available under the [MIT License](LICENSE).
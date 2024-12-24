# Todo Application with Vue.js and Laravel

This project is a simple Todo application built using Vue.js for the frontend and Laravel for the backend API. It allows users to create, update, and mark todos as completed.

## Project Summary

The application consists of the following main components:

*   **Frontend (Vue.js):** Provides the user interface for interacting with the todos. It handles creating new todos, displaying existing todos, and updating the completion status of todos.
*   **Backend (Laravel API):** Exposes an API for handling data persistence and database interactions. It manages the creation, reading, updating, and deleting of todos.

## Technologies Used

*   **Frontend:**
    *   Vue.js
    *   Axios (for API requests)
*   **Backend:**
    *   Laravel PHP Framework
    *   MySQL (or any other database supported by Laravel)

## Setup Instructions

Follow these instructions to get the project up and running on your local machine.

### Prerequisites

Before you begin, make sure you have the following software installed:

*   **PHP:** Version 8.1 or higher
*   **Composer:**  For managing PHP dependencies.
*   **Node.js and npm (or yarn):** For managing JavaScript dependencies and running the Vue.js application.
*   **MySQL (or other database):** Make sure your database is installed and a new database is created for the project.
*   **Git:** Version Control System

### Steps

1.  **Clone the Repository:**

    ```bash
    git clone <https://github.com/with-zen/todo-app.git>
    cd <todo-app>
    ```

2.  **Backend Setup (Laravel):**
   *  Navigate into `/backend` folder:
    ```bash
      cd backend
    ```
    *   Install PHP Dependencies:
        ```bash
        composer install
        ```
    *   Copy the `.env.example` file to `.env` and configure your database:
        ```bash
         cp .env.example .env
        ```
        Open the `.env` file and set up your database connection details:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=<your_database_name>
        DB_USERNAME=<your_database_username>
        DB_PASSWORD=<your_database_password>
        ```
    * Generate an application key:
        ```bash
        php artisan key:generate
        ```
    *   Run Database Migrations:
        ```bash
        php artisan migrate
        ```
    *   Start Laravel development server:
        ```bash
        php artisan serve
        ```
        The API will be running at `http://127.0.0.1:8000` by default.

3.  **Frontend Setup (Vue.js):**
    *   Navigate into `/frontend` folder:
      ```bash
        cd ../frontend
      ```
    *   Install JavaScript Dependencies:
        ```bash
        npm install
        ```
       or
       ```bash
       yarn install
       ```
    *   Start the Vue.js development server:
        ```bash
        npm run dev
        ```
       or
        ```bash
        yarn dev
       ```
       The frontend will be running at `http://localhost:5173` by default.

4.  **Access the Application**

    Open your web browser and go to  `http://localhost:5173` to use the application.

### API Endpoints (Backend - Laravel)

*   **GET /api/todos:** Get a list of all todos.
*   **POST /api/todos:** Create a new todo (Expects JSON payload with `text` and `completed` fields).
*   **PUT /api/todos/{id}:** Update a specific todo (Expects JSON payload with `text` and `completed` fields).
*   **DELETE /api/todos/{id}:** Delete a specific todo.

### Additional Notes

*   Make sure the Laravel API is running before accessing the Vue.js application.
*   Ensure that your Vue application is pointing to the correct API URL if it is not on `http://127.0.0.1:8000`.
*   Use the command `npm run build` or `yarn build` to build the Vue.js project for production.

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Contributing

Contributions are welcome! If you have suggestions for improvements or bug fixes, please submit a pull request.

## Contact

If you have any questions, contact email at [alichchali811@gmail.com].

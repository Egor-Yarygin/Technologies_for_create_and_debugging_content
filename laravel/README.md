For v1.0:

To start, you need to enter the following commands in the project directory:
  1. composer install
  2. copy .env.example .env
  3. php artisan key:generate
  4. php artisan serve



For v2.0:

To start, you need to enter the following commands in the project directory:
  1. composer install
  2. copy .env.example .env
  3. php artisan key:generate
  4. php artisan migrate
  5. php artisan serve


For interacting with data through the terminal, you can use various curl commands. Below are examples of commands for different actions:

Retrieve information about all users:
curl http://127.0.0.1:8000/api/users

Retrieve information about a specific user:
curl http://127.0.0.1:8000/api/users/{id}

Create a new user:
curl -X POST -H "Content-Type: application/json" -d '{"name": "John Doe", "email": "john@example.com", "password": "secret"}' http://127.0.0.1:8000/api/users

Update user information:
curl -X PUT -H "Content-Type: application/json" -d '{"name": "Updated Name", "email": "updatedemail@example.com"}' http://127.0.0.1:8000/api/users/{id}

Delete a user:
curl -X DELETE http://127.0.0.1:8000/api/users/{id}

Replace {id} with the actual user identifier when performing respective operations. Similar commands can be crafted for other resources like posts, comments, and categories.

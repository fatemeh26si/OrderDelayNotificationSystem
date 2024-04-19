

## Setup Steps

First, Set full permission to the project folder.

Then, go to the main path of the project, where the "docker-compose.yml" file is located.

### Setup Config

Take a copy of the file ".env.example" and save it with the name ".env"

For this project, I use mariadb:10.3. So enter MYSQL database information in the settings section.
Fill in the following values according to the desired database:

- DB_HOST={db_host}
- DB_PORT={db_port}
- DB_DATABASE={db_name}
- DB_USERNAME={db_username}
- DB_PASSWORD={db_password}

Also, change this parameter to set the project port:

- PORT={project_port}

#### *Note:
All times are in UTC timezone

The project framework is Laravel 10
### Run Project

in the main path of project run:

- docker compose up -d

after the containers created and started then execute the following commands in order:

- docker compose exec app composer install
- docker compose exec app php artisan key:generate
- docker compose exec app php artisan optimize
- docker compose exec app php artisan migrate 
- docker compose exec app php artisan db:seed

When the "migrate" command is executed, tables created on database

When the "db:seed" command is executed, a series of mock data is created for the use of APIs in the database

## Using System
open the following address in your browser:

http://localhost:{PORT}

There you can see the swagger of the project to try the desired APIs separated by two tags "Agent" and "User".
 
### Submit Delay Report By User
/api/v1/delay-report

This endpoint should be called and the order_id parameter should be selected from among the id`s of orders in the orders table

### Request Assign Delay Report By Agent
/api/v1/agent/delay-report/request-assign

Because we currently do not have authentication, the Agent who wants to make a request must enter his "agent_number" so that the system can recognize who made the request.

### Get Vendors Delay Report
/api/v1/agent/delay-report/vendor

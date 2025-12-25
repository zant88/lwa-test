# LARAVEL API

This application implements CLEAN architecture with separation of concerns, organizing code into distinct layers for maintainability and scalability. The idea is to make controller "Fat" so when some logic is changed, we only modify the services. Validation rules are defined in Request instead of controller which make controller cleaner without try catch and validation logic. The resources are used to transform raw database into JSON response, so there's no sensitive data is returned from the endpoint.

The application follows a layered architecture where each component has a specific responsibility:

- **Controllers** handle HTTP requests and responses, delegating business logic to services
- **Services** contain business logic and doing operations across multiple models
- **Models** represent database entities and handle data persistence
- **Requests** validate incoming data before processing
- **Resources** transform models into consistent API responses
- **Mails** handle email notifications with separate templates

This approuch ensures the application is easy to test, maintain and scale.

## Setup

1. Install dependencies: `composer install`
2. Configure database in `.env`
3. Run migrations: `php artisan migrate`
4. If you are in feat_login branch, create admin user: `php artisan admin:create`
5. Start server: `php artisan serve`

## Authentication

In this application, there are 2 branches. The main branch is the code to accomplish minimum task without any authentication. The feat_login branch is used to include authentication, so the rules can_edit will be clearer how to use it. To create admin user, just switch branch into feat_login and type `php artisan admin:create`. After that please login by hitting POST  `/api/login` to get token. Use bearer token to create user and get user. All protected routes require this token in the Authorization header


## API Endpoints

For main branch, the endpoints are :
- `POST /api/users` - Create new user
- `GET /api/users` - List users

For feat_login, the endpoints are :
- `POST /api/login` - Authenticate and receive token (PUBLIC)
- `POST /api/logout` - Revoke current token (require Bearer token)
- `POST /api/users` - Create new user (require Bearer token)
- `GET /api/users` - List users (require Bearer token)



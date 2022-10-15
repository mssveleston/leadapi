# leadapi
 
# Install JWT package:<br>

`composer require tymon/jwt-auth`<br>

Add jwt package into a service provider in config/app.php
`'providers' => [
...
'Tymon\JWTAuth\Providers\LaravelServiceProvider',
],
'aliases' => [
...
'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,
'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
],`

Publish jwt configuration<br>
`php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`

Generate JWT Key<br>
`php artisan jwt:secret`

Create the Middleware
`Command: php artisan make:middleware JwtMiddleware`

To use this middleware register this into Kernel. Open app\Http\Kernel.php<br>
...
protected $routeMiddleware = [
`...
'jwt.verify' => \App\Http\Middleware\JwtMiddleware::class,
'jwt.auth' => 'Tymon\JWTAuth\Middleware\GetUserFromToken',
'jwt.refresh' => 'Tymon\JWTAuth\Middleware\RefreshToken',
];
...`

Configure database<br>
`...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leadapi
DB_USERNAME=root
DB_PASSWORD=
...`

# **Token Generation**<br>

Use the end point Api to Register Sellers<br>
`/api/register`
POST the parametrs as follows:<br>
`name,email,password,password_confirmation`

Response example:
`{
"user": {
"name": "yolo",
"email": "yolo@test.com",
"descp": null,
"updated_at": "2022-10-15T07:25:48.000000Z",
"created_at": "2022-10-15T07:25:48.000000Z",
"id": 2
},
"token": "abcdxyz"
}`

## Already Generated Token ?

Login using api endpoint : `api/login `<br>
Parameters : `email , password`<br>
Response example :
`{
"token": "abcxyz"
}`



# leadapi
 
# Install JWT package:<br>

`composer require tymon/jwt-auth`<br>

Add jwt package into a service provider in config/app.php<br>
`'providers' => [
...`<br>
`'Tymon\JWTAuth\Providers\LaravelServiceProvider',
],`<br>
`aliases' => [`<br>
`...`<br>
`'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,`<br>
`'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
],`

Publish jwt configuration<br>
`php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`

Generate JWT Key<br>
`php artisan jwt:secret`

Create the Middleware
`Command: php artisan make:middleware JwtMiddleware`

To use this middleware register this into Kernel. Open app\Http\Kernel.php<br>
`...
protected $routeMiddleware = [`<br>
`...`<br>
`'jwt.verify' => \App\Http\Middleware\JwtMiddleware::class,`<br>
`'jwt.auth' => 'Tymon\JWTAuth\Middleware\GetUserFromToken',`<br>
`'jwt.refresh' => 'Tymon\JWTAuth\Middleware\RefreshToken',`<br>
`];
...`

Configure database<br>
`...`<br>
`DB_CONNECTION=mysql`<br>
`DB_HOST=127.0.0.1`<br>
`DB_PORT=3306`<br>
`DB_DATABASE=leadapi`<br>
`DB_USERNAME=root`<br>
`DB_PASSWORD=`<br>
`...`

# **Token Generation**<br>

Use the end point Api to Register Sellers<br>
`/api/register`
POST the parametrs as follows:<br>
`name,email,password,password_confirmation`

Response example:
`{`<br>
`"user": {`<br>
`"name": "yolo",`<br>
`"email": "yolo@test.com",`<br>
`"descp": null,`<br>
`"updated_at": "2022-10-15T07:25:48.000000Z",`<br>
`"created_at": "2022-10-15T07:25:48.000000Z",`<br>
`"id": 2`<br>
`},`<br>
`"token": "abcdxyz"`<br>
`}`<br>

## Already Registered & Want to Generated Token ?

Login using api endpoint : `api/login `<br>
Parameters : `email , password`<br>
Response example :
`{
"token": "abcxyz"
}`


## API Endpoint for seller to send leads.<br>
`api/lead`<br><br>
**_Parameters_**<br>
`Mandatory: campaign_id,name,email,phone.<br>
Non Mandatory : dob, region.`<br>
`Depending on campaign_id : credi_score,health_conditions,covid19_exposed,existing_insurance.
`
<br><br>
Response example:<br>
`{`<br>
`"success": true`<br>
`}`

Mail Service Provider : `Mailtrap`

`MAIL_MAILER=smtp`<br>
`MAIL_HOST=smtp.mailtrap.io`<br>
`MAIL_PORT=2525`<br>
`MAIL_USERNAME=abcxyz`<br>
`MAIL_PASSWORD=abcxyz`<br>
`MAIL_ENCRYPTION=tls`<br>
`MAIL_FROM_ADDRESS=from@example.com`<br>
`MAIL_FROM_NAME="${APP_NAME}"`<br>

Use Postman To run api endpoint. 

Authentication Type: `Bearer Token`

## Init project
- .env file aanmaken
- APP_URL in de .env file aanpassen naar ´http://127.0.0.1:8000´ voor local dev en naar `https://subscribe.sleepworld.be` voor prod.
- mysql database parameters aanpassen (host, poort en logingegevens)
- Read en write rechten aanpassen voor /storage en /bootstrap `sudo chmod o+w ./storage/ -R` en `sudo chmod o+w ./bootstrap/ -R`
- APP_URL in .env file

`composer install`

`php artisan key:generate`

`php artisan migrate
`

## Domeinnaaminstelling 
Domeinnaam is `subscribe.sleepworld.be` ingesteld op cloudflare bij `sleepworld.be` en het ip-adres verwijst naar de docker-webhosting-server droplet op DigiralOcean.

## Database
De database is sleepyeu > subscribers op DigitalOcean. Dat tabel is subscribers.

## Hosting
De API-service is standalone gehost en niet als een Docker-container. Dir van de API-service bevindt zich op de server onder /var/www/subscribe-api

# About
This project is used to receive payments from Airtel-Tanzania and forwards the received data to [MPManager](https://github.com/Inensus/MPManager).

**Note: You have to setup the tunnel with Airtel-Tanzania before you can use that project in your production environment.**

# Development Guide
## 1. Install dependencies
Get into the slim docker with `docker exec -it airtel /bin/bash` container and run following command  `/var/www/html# php composer.phar install`.

## 2. Configuraiton
Please change following lines in `/src/settings.php`

```php
'airtel' => [
            'ips' => [
                //AIRTEL IPS THAT SEND TRANSACTION DATA
            ],
            'transactionUrl' => 'AIRTEL-TRANSACTION-CANCELATION-URL',
        ],


        'mainAPi' => [
            'sendUrl' => 'https://MPM-PROJECT-URL/api/transactions/airtel',
        ],
```
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About This Project

This project simulates web scraping with puphpeteer a php api built on the nodejs puppeteer.

Note: each scraping job is executed by the ScrapWeb Job, and is dispatched syncchroonously which means we don't have to run php artisan queue:work. If you wish to make it run that way, change the dispatchSync on the scrape method in the modules/Api/Controllers/ScrapeApiController.php.


Note, because of the above, you need to go back to the home page after every scrape then click details on the url and selector combination you used.
To avoid the above, we should just apply the puppeteer code directly in the controller above.

Let me get your feeedbacks

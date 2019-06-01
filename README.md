# Kingdomhire-2.0
This is the repository for the new Kingdomhire-2.0 website re-design.  
I thought it was a good time to re-visit www.kingdomhire.com and improve the site.

I am using [*Laravel 5.6*](https://laravel.com/docs/5.6/installation) to aid in the development process.  
I will be using a *MySQL* database backend for the new website.  
The application needs to be compatible with *MySQL 5.5*, due to the web host only supporting it.

# New Features
### The Administrator Dashboard
  A new admin dashboard, where an admin can access a dashboard that allows them to directly query the database.  
  The purpose of the dashboard is allow an admin to be able to manage __vehicles__, __hires__ and __reservations__, along with smaller features included.
   
### Website Front-end Update 
   More important business info will need to be displayed on the website, along with a more complete list of vehicles

# Setup
It is best to install [*Homestead*](https://laravel.com/docs/5.6/homestead#installation-and-setup) and all of its prerequisites before setting up this website.

### Other prerequisites  
1. `sudo apt install php7.2` or [php7.2](https://www.php.net/downloads.php)  
1. `sudo apt install composer` or [Composer](https://getcomposer.org/)  
2. `sudo apt install npm` or [Npm](https://www.npmjs.com/get-npm)  

### Installation steps  
After installing Homestead, do the following:
  1. run `cd Kingdomhire-2.0`  
  2. run `composer install` to install php dependencies  
  3. run `npm install` to install node dependencies    
  4. run `composer run-script post-root-package-install` to create .env config file
  5. run `php artisan key:generate` to create application key
  6. run `vagrant up` to start your VM if you haven't already    
  7. run `vagrant ssh` into your laravel/homestead VM
  8. run `cd /home/vagrant/Kingdomhire-2.0`
  9. run `php artisan migrate --seed` to create and populate the db with dummy data (exclude `--seed` if you only want to create the db)
  10. run `php artisan storage:link` to create public/storage symlink to storage/app/public  
  11. run `php artisan schedule:run` to convert reservations to active hires, and any active hires to past hires  
  12. run `php artisan user:create` to create a user so you can login to the admin dashboard (you can login to the dashboard at http://homestead.test/login)  
  13. The application should now be viewable at http://homestead.test (or something similar)
  14. Enjoy browsing the application!  

# Other Documentation
### [Database Design](DATABASE.md)  
### [Requirements List](REQUIREMENTS.md)
 
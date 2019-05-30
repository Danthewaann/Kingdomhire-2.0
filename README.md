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
It is best to intall [*Homestead*](https://laravel.com/docs/5.6/homestead) and all of its prerequisites before setting up this website.

After Homestead is setup, do the following:  
  1. `homestead ssh` into your VM
  2. `cd Kingdomhire-2.0`
  3. `php artisan migrate --seed` to create and populate the db (exclude `--seed` if you only want to create the db)
  4. `php artisan schedule:run` to convert reservations to active hires, and any active hires to past hires  
  5. `php artisan user:create` to create a user so you can login to the admin dashboard (provide name + email + password prompt)
  6. Enjoy browsing the application!  

# Other Documentation
### [Database Design](DATABASE.md)  
### [Requirements List](REQUIREMENTS.md)
 
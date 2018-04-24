# Kingdomhire-2.0
This is the repository for the new Kingdomhire-2.0 website  
I thought it was a good time to re-visit www.kingdomhire.co.uk and improve the site

I am using *Laravel 5.5* to aid in the development process  
I will be using a *MySQL* database backend for the new website

# New Features
### The Administrator Dashboard
  A new admin dashboard, where an admin can access a dashboard that allows them to directly query the database.  
  The purpose of the dashboard is allow an admin to be able to manage __vehicles__, __hires__ and __reservations__
  
  __Requirements__   
   1. Allow an admin to login to the __Administrator Dashboard__, where the admin can perform a range of tasks related to managing *vehicles*, *reservations* and *hires*
   2. An admin should be able to __add__, __delete__ and __change vehicles__ in the database.   
      Change operations include: 
      * changing vehicle price rates    
      * changing a vehicle's image  
   3. An admin should be able to __add__, __delete__ and __change reservations__ and __hires__.  
      Some change operations include: 
      * extend a hire 
      * shorten a hire 
      * reschedule a reservation 
      * cancel a reservation
   4. An admin should be able to __generate reports__, such as: 
      * list of hires made within a month/year 
      * list of most popular vehicles hired 
      * total profit made within a month/year 
      * total amount of vehicles hired within a month/year 
   5. An admin should be able to see a __list of all active reservations__, __a list of all active hires__ and __a list of all kingdomhire vehicles__ when they log into the __Administrator Dashboard__
   6. An admin should be __able to log a reservation for a vehicle__, where when the reservation is logged for a date in the future, after some time has passed and the current real world date is equal or earlier than the start date of that reservation, 
   a hire should be automatically logged for that vehicle. After this happens the reservation will be __removed from the reservations table__
   8. An admin should be able to __reset their password__ if they forget it, this will require __an email verification process__
   9. An admin should be able to __change their password__, they will need to know their __current password__ to do able to do this
   10. To allow an admin to login to the __Administrator Dashboard__, they will need to provide an __email address__ and __password__, which will need be already inserted into the database
   
### Website Business Information  
   More important business info will need to be displayed on the website, along with a more complete list of kingdomhire vehicles
   
   __Requirements__
   1. Anyone should be able to see a list of all kingdomhire vehicles on the vehicles page
   2. Anyone should be able to see a vehicle's current status, which can be one of the following: *available*, *unavailable*, or *out for hire*
   3. Anyone should be able to see all __active reservations__ for any vehicle they wish to reserve,
   4. Anyone should be able to search through the list of kingdomhire vehicles by __vehicle type__ or __vehicle rate__
   5. The website should display kingdomhire’s __approximate opening hours__
   6. The website should have an __email form__, for the user to able fill-out and send to kingdomhire, to either directly contact kingdomhire to provide feedback, or to ask about hiring out a vehicle
   
# Database Design  
__vehicles__ (__id__, make, model, fuel_type, gear_type, seats, status, type, image_path, created_at, updated_at, engine_size*)  
__vehicle_rates__ (__engine_size__, weekly_rate_min, weekly_rate_max, created_at, updated_at)  
__reservations__ (__id__, vehicle_id*, start_date, end_date, created_at, updated_at, is_active)  
__hires__ (__id__, vehicle_id*, start_date, end_date, created_at, updated_at, is_active)  
__users__ (__id__, name, email, password, remember_token, created_at, updated_at)    
__password_resets__ (email, token, created_at)

|   vehicles schema             |
|:----------------------------- |
 __id__ NOT NULL INT INCREMENTS 
 __make__ NOT NULL VARCHAR30)    
 __model__ NOT NULL VARCHAR(30) 
 __fuel_type__ NOT NULL VARCHAR(20)  
 __gear_type__ NOT NULL VARCHAR(30)   
 __seats__ NOT NULL TINYINT UNSIGNED  
 __status__ NOT NULL ENUM(‘available’, ‘unavailable’, ‘out_for_hire’)  
 __type__ NOT NULL VARCHAR(30)  
 __image_path__ VARCHAR(50)  
 __engine_size__ NOT NULL VARCHAR(10)  
 __created_at__	NOT NULL TIMESTAMP DEFAULTS NOW()  
 __updated_at__	NOT NULL TIMESTAMP DEFAULTS NOW()      
 PRIMARY KEY (__id__)  
 FOREIGN KEY (__engine_size__) REFERENCES __vehicle_rates__(__engine_size__)  

| vehicle_rates schema          |
|:----------------------------- |
__vehicle_engine_size__ NOT NULL VARCHAR(10)  
__weekly_rate_min__ NOT NULL FLOAT(5,2)  
__weekly_rate_max__ NOT NULL FLOAT(5,2)  
__created_at__	NOT NULL TIMESTAMP DEFAULTS NOW()   
__updated_at__	NOT NULL TIMESTAMP DEFAULTS NOW()     
PRIMARY KEY (__vehicle_type__)  

| reservations schema           |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__vehicle_id__ NOT NULL INT  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE   
__created_at__	NOT NULL TIMESTAMP DEFAULTS NOW()   
__updated_at__	NOT NULL TIMESTAMP DEFAULTS NOW()     
__is_active__ NOT NULL BOOLEAN DEFAULTS TRUE  
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| hires schema                  |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__vehicle_id__ NOT NULL INT  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE    
__created_at__	NOT NULL TIMESTAMP DEFAULTS NOW()   
__updated_at__	NOT NULL TIMESTAMP DEFAULTS NOW()    
__is_active__ NOT NULL BOOLEAN DEFAULTS TRUE    
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| users schema                 |
|:---------------------------- |
__id__ NOT NULL INT INCREMENTS
__name__ NOT NULL VARCHAR(50)
__email__ NOT NULL VARCHAR(50) UNIQUE
__password__ NOT NULL VARCHAR(30)  
__remember_token__ VARCHAR(100)     
__created_at__	NOT NULL TIMESTAMP DEFAULTS NOW()   
__updated_at__	NOT NULL TIMESTAMP DEFAULTS NOW()   
PRIMARY KEY (__id__)

| password_resets schema       |  
|:---------------------------- |  
__email__ NOT NULL VARCHAR(50) INDEX  
__token__ NOT NULL VARCHAR(100)  
__created_at__ NOT NULL TIMESTAMP DEFAULTS NOW()   
 
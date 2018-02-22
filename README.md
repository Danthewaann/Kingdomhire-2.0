# Kingdomhire v2
This is the repository for the new Kingdomhire v2 website  
I thought it was a good time to re-visit www.kingdomhire.co.uk and improve the site

# New Features
__The Administrator Dashboard__  
  A new admin dashbaord, where an admin can access a dashboard that allows them to directly query the database.  
  The pursose of the dashbaord is allow an admin to be able to manage __vehicles__, __hires__ and __reservations__
  
  __Requirements__   
   1. Allow an admin to login to the Administrator Dashboard, where the admin can perform a range of tasks related to managing vehicles, reservations and hires
   2. An admin should be able to add, delete and change vehicles in the database. Change operations include: updating vehicle price rates, updating a vehicles status, updating a vehicles image etc.
   3. An admin should be able to add, delete and change reservations and hires. Some change operations include: extend a hire, shorten a hire, reschedule a reservation, cancel a reservation
   4. An admin should be able to generate reports, such as: list of hires made within a month/year, list of most popular vehicles hired, total profit made within a month/year, total amount of vehicle hired within a month/year etc.
   5. An admin should be able to see a list of all currently active reservations, all curent hires and every vehicle when logged into the dashboard, from here the admin should be able to easily generate reports based on hires
   6. An admin should be able to log a reservation for a vehicle, where when the reservation is logged for a date in the future, after some time has passed and the current real world date equals the start date of that reservation, a hire should be automatically logged for that vehicle
   
__Website Business Information__  
   More important business info will need to be displayed on the website, along with a more complete list of kingdomhire vehicles
   
   __Requirements__
   1. Anyone should be able to see a list of all kingdomhire vehicles on the vehicles page
   2. Anyone should be able to search through the list of kingdomhire vehicles by vehicle type, price rate
   3. The website should display kingdomhire’s approximate opening hours
   4. The website should have an email form, for the user to fill-out and send to kingdomhire
   
---

# Database Design  
__vehicles__ (__id__, fuel_type, gear_type, seats, status, make*, model*)  
__vehicle_types__ (__make__, __model__, type, image,  engine_size*)  
__vehicle_rates__ (__vehicle_engine_size__, weekly_rate_min, weekly_rate_max)  
__reservations__ (__id__, vehicle_id*, start_date, end_date, is_active)  
__hires__ (__id__, vehicle_id*, start_date, end_date, is_active)  

|   vehicles table schema       |   
|:----------------------------- |
 __id__ NOT NULL INT INCREMENTS   
 __fuel_type__ NOT NULL VARCHAR(20)  
 __gear_type__ NOT NULL VARCHAR(30)   
 __seats__ NOT NULL TINYINT UNSIGNED  
 __status__ NOT NULL ENUM(‘available’, ‘unavailable’, ‘out for hire’)  
 __make__ NOT NULL VARCHAR30)  
 __model__ NOT NULL VARCHAR(30)  
 PRIMARY KEY (__id__)  
 FOREIGN KEY (__make__, __model__) REFERENCES __vehicle_types__(__make__, __model__)  

| vehicle_types table schema    |
|:----------------------------- |
__make__ NOT NULL VARCHAR30)    
__model__ NOT NULL VARCHAR(30)  
__type__ NOT NULL VARCHAR(30)  
__image__ VARCHAR(50)  
__engine_size__ NOT NULL VARCHAR(10)  
PRIMARY KEY (__make__, __model__)  
FOREIGN KEY (__engine_size__) REFERENCES __vehicle_rates__(__vehicle_engine_size__)  

| vehicle_rates table schema    |
|:----------------------------- |
__vehicle_engine_size__ NOT NULL VARCHAR(10)  
__weekly_rate_min__ NOT NULL FLOAT(4,2)  
__weekly_rate_max__ NOT NULL FLOAT(4,2)  
PRIMARY KEY (__vehicle_type__)  

| reservations table schema     |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__vehicle_id__ NOT NULL INT  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE   
__is_active__ NOT NULL BOOLEAN DEFAULTS TRUE  
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| hires table schema            |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__vehicle_id__ NOT NULL INT  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE  
__is_active__ NOT NULL BOOLEAN DEFAULTS TRUE  
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  
  
I am using *Laravel 5.5* to aid in the development process  

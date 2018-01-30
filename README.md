# Kingdomhire
This repository will be used to manage the code base for the new Kingdomhire website

Since the hosting service for the Kingdomhire website now allows the use of MySQL databases, I can now
add more useful features into the website

New planned features include:

* __Allow a user to create an account__

   Allow the user to create an account, using their *email*, *firstname*, *lastname*, *phone number* and *password*  
   When logged into their account, the user can automatically **reserve a vehicle** without needing to 
   fill-out their info into the **Vehicle Reservation Form**, 
   this form will be accessible through the **Vehicles Page** when you click on a vehicle to reserve it

* __New admin site__

   A new admin site, where an admin can access a dashboard that allows them to directly query the database.  
   The admin can generate specific reports based on the database, such as *list of vehicles currently out for hire*,  
   or *List of all current reservations* etc.  
   More features will be included, such as a facility to add new vehicles into the database, which will in turn display
   the new vehicle on the website  
   
* __Vehicle reservation process__

   A new process to allow the user to reserve a vehicle. The new **Vehicles Page** will allow the user to click on a vehicle
   to **reserve it**, this will bring you to the new **Vehicle Reservation Page**. Here the user can fill-out their info  
   (to be determined), and then submit the form.  
   When the form is submitted, if the user has an **account**, they can view their reservation on their **Account Page**.  
   The user will also receive an **email receipt** of their reservation if the user doesn't have an account
   
* __More vehicles displayed on website, with search and sort functionality__

   More vehicles will be added to the **Vehicles Page**. The vehicles will be displayed in a catalog-like format,  
   where the user can search and sort through the vehicles, such as sort by vehicle type, number of seats etc.
   
* __More important business info to be included on the website__

   Just some more additional business info, such as opening hours, vehicle price ranges and details about how to reserve a vehicle etc.


I am using *Laravel 5.5* to aid in the development process

# System Requirements

#### Administrator Dashboard Requirements
- [x] An admin should be able to add, update and delete vehicles in the database  
- [x] An admin should be able to add, update and delete reservations in the database  
- [x] An admin should be able to add, update and delete hires in the database  
- [x] An admin should be able to add, update and delete weekly rates in the database  
- [x] An admin should be able to add, update and delete vehicle types in the database 
- [x] An admin should be able to add, update and delete vehicle gear types in the database  
- [x] An admin should be able to add, update and delete vehicle fuel types in the database  
- [x] The system should be able to tell the admin if a newly created reservation/hire conflicts with any other reservation or hire for a specific vehicle  
- [x] The system should automatically convert any reservations in the database into hires if their start date is less than or equal to today's date  
- The system should be able to automatically generate charts based on data in the database;  
   - [x] Number of reservations per vehicle  
   - [x] Number of hires per month per year for a specific vehicle   
   - [x] Number of hires per month per year for all vehicles   
   - [x] Schedule of a specific vehicle (gantt chart showing reservations and active hire)   
   - [x] Active hires for all vehicles (gantt chart)  
- An admin should be able to generate reports/charts;  
   - [ ] List of most popular vehicles hired within a month/year (Not needed)   
   - [ ] List of hires made within a month/year (Not needed)  
   - [x] List of hires made per vehicle  
- [x] An admin should be able to download any generated reports/charts in a pdf file format  
- [x] An admin should be able to reset their password if they forget it, this will require an email verification process  
- [x] An admin should be able to change their password, they will need to know their current password to do able to do this  
- [ ] An admin should be able to export the content of the entire database into a spreadsheet friendly format (Not needed)
- [ ] An admin should be able to import data into the database from data uploaded in a file like format (Not needed)


#### Website Front-end Update Requirements
- [x] Anyone should be able to see a list of all kingdomhire vehicles on the vehicles page  
- [ ] Anyone should be able to see a vehicle's current status, which can be one of the following: *available*, *unavailable*, or *out for hire* (Not needed)
- [x] Anyone should be able to search through the list of kingdomhire vehicles by the properties of each vehicle (fuel/gear type, number of seats etc)
- [x] The website should display kingdomhire’s approximate opening hours, address and contact info
- [x] The website should provide an email form to allow the user to send an email through the website to kingdomhire
- [x] The website should display a interactive map that shows the user how to find their way to kingdomhire's location

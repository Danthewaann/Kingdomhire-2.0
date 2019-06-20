# User Guide

## Table of Contents
1. [Login to admin dashboard](#Login-to-admin-dashboard)
2. [Vehicles](#Vehicle)   
  2.1 [Create a vehicle](#Create-a-vehicle)  
  2.2 [Edit a vehicle](#Edit-a-vehicle)  
  2.3 [Delete a vehicle](#Delete-a-vehicle)   
3. [Vehicle attributes](#Vehicle-attributes)  
  3.1 [Create an attribute](#Create-an-attribute)  
  3.2 [Edit an attribute](#Edit-an-attribute)  
  3.3 [Delete an attribute](#Delete-an-attribute)   
4. [Reservations](#Reservations)  
  4.1 [Create a reservation](#Create-a-reservation)  
  4.2 [Edit a reservation](#Edit-a-reservation)  
  4.3 [Delete a reservation](#Delete-a-reservation)
5. [Hires](#Hires)  
  5.1 [Create a hire](#Create-a-hire)  
  5.2 [Edit a hire](#Edit-a-hire)  
  5.3 [Delete a hire](#Delete-a-hire)     
6. [Users](#Users)  
  6.1 [Update info](#Update-info)  
  6.2 [Update password](#Update-password)  



## Login to admin dashboard
1. After completing the installation steps, navigate to http://homestead.test/login in your browser

![Login screen](login-screen.png)

2. Input your test email and password that you should have created with the `php artisan user:create` command

![](admin-dashboard.png)

After logging in, you should be directed to the **admin dashboard** (http://homestead.test/admin). It should look similar to the above screenshot if you seeded the application with `php artisan migrate --seed` or `php artisan db:seed` command  


## Vehicles

1. Navigate to http://homestead.test/admin/vehicles

![](vehicles-dashboard.png)

### Create a vehicle

1. Click on the `Add Vehicle` button on the vehicles page

<img src="add-vehicle-btn.png" alt="alt text" width="250" height="450">

2. Fill out the form and click the `create` button

![](add-vehicle-form.png)

### Edit a vehicle

1. Click on the `dashboard` button for the vehicle you want to edit on the vehicles page

![](vehicle-dashboard-btn.png)

2. After going to the vehicle's dashboard, Click on the `edit` button

![](vehicle-edit-btn.png)

3. Make the changes you want to the vehicle, then click the `update` button

![](edit-vehicle-form.png)

### Delete a vehicle

1. Click on the `dashboard` button for the vehicle you want to delete on the vehicles page

![](vehicle-dashboard-btn.png)

2. After going to the vehicle's dashboard, Click on the `delete` button to delete the vehicle

![](vehicle-delete-btn.png)

## Vehicle attributes

There are 4 vehicle attributes that are customisable: `weekly rates`, `vehicle types`, `fuel types` and `gear types`.

These attributes are available under the `Other` button in the navigation bar

![](vehicle-attributes-btn.png)

### Create an attribute

1. Go to the page for the attribute you want to create (Pages available under `Other` button in navigation bar)
2. Fill out the vehicle attribute form and click the `create` button

![](add-attribute-form.png)

### Edit an attribute

1. Go to the page for the attribute you want to edit (Pages available under `Other` button in navigation bar)
2. Click the `edit` button for the vehicle attribute you want to edit

![](attribute-edit-btn.png)

3. Fill out the edit form and click the `update` button

![](edit-attribute-form.png)

### Delete an attribute

1. Go to the page for the attribute you want to delete (Pages available under `Other` button in navigation bar)
2. Click the `delete` button for the vehicle attribute you want to delete

![](attribute-delete-btn.png)


## Reservations

### Create a reservation

### Edit a reservation

### Delete a reservation


## Hires

### Create a hire

### Edit a hire

### Delete a hire


## Users

### Update info

### Update password
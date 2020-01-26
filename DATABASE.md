\# Database Design  
__vehicles__ (__id__, name, slug, make, model, seats, status, vehicle_type_id*, vehicle_fuel_type_id*, vehicle_gear_type_id*, weekly_rate_id*, created_at, updated_at, deleted_at)  
__weekly_rates__ (__id__, name, slug, weekly_rate_min, weekly_rate_max, created_at, updated_at)  
__vehicle_types__ (__id__, name, slug, created_at, updated_at)  
__vehicle_fuel_types__ (__id__, name, slug, created_at, updated_at)  
__vehicle_gear_types__ (__id__, name, slug, created_at, updated_at)  
__vehicle_images__ (__id__, image_uri, name, created_at, updated_at, vehicle_id*, order)      
__reservations__ (__id__, name, start_date, end_date, created_at, updated_at, vehicle_id*)  
__hires__ (__id__, name, start_date, end_date, is_active, created_at, updated_at, vehicle_id*)  
__users__ (__id__, name, email, password, remember_token, created_at, updated_at, receives_email)    
__password_resets__ (email, token, created_at)

|   vehicles schema             |
|:----------------------------- |
 __id__ NOT NULL INT INCREMENTS   
 __name__ NOT NULL VARCHAR(191) UNIQUE  
 __slug__ NOT NULL VARCHAR(191)  
 __make__ NOT NULL VARCHAR(191)     
 __model__ NOT NULL VARCHAR(191)    
 __seats__ NOT NULL TINYINT UNSIGNED  
 __status__ NOT NULL ENUM(‘available’, ‘unavailable’, ‘out_for_hire’)   
 __vehicle_type_id__ NOT NULL INT UNSIGNED     
 __vehicle_fuel_type_id__ NOT NULL INT UNSIGNED  
 __vehicle_gear_type_id__ NOT NULL INT UNSIGNED  
 __weekly_rate_id__ NOT NULL INT UNSIGNED  
 __created_at__	NOT NULL TIMESTAMP   
 __updated_at__	NOT NULL TIMESTAMP   
 __deleted_at__	TIMESTAMP    
 PRIMARY KEY (__id__)  
 FOREIGN KEY (__vehicle_type_id__) REFERENCES __vehicle_types__(__id__)  
 FOREIGN KEY (__vehicle_fuel_type_id__) REFERENCES __vehicle_fuel_types__(__id__)  
 FOREIGN KEY (__vehicle_gear_type_id__) REFERENCES __vehicle_gear_types__(__id__)  
 FOREIGN KEY (__weekly_rate_id__) REFERENCES __weekly_rates__(__id__)  

| weekly_rates schema          |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__name__ NOT NULL VARCHAR(191) UNIQUE   
__slug__ NOT NULL VARCHAR(191)  
__weekly_rate_min__ NOT NULL FLOAT(6,2)  
__weekly_rate_max__ NOT NULL FLOAT(6,2)  
__created_at__	NOT NULL TIMESTAMP   
__updated_at__	NOT NULL TIMESTAMP     
PRIMARY KEY (__id__)  

| vehicle_types schema          |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__name__ NOT NULL VARCHAR(191) UNIQUE   
__slug__ NOT NULL VARCHAR(191)  
__created_at__	NOT NULL TIMESTAMP   
__updated_at__	NOT NULL TIMESTAMP     
PRIMARY KEY (__id__)

| vehicle_images schema          |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__name__ NOT NULL VARCHAR(191) UNIQUE   
__image_uri__ NOT NULL VARCHAR(191)  
__created_at__	NOT NULL TIMESTAMP   
__updated_at__	NOT NULL TIMESTAMP  
__vehicle_id__ NOT NULL INT UNSIGNED 
__order__	NOT NULL INT UNSIGNED DEFAULTS 1  
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)

| reservations schema           |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__name__ NOT NULL VARCHAR(191) UNIQUE  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE   
__created_at__	NOT NULL TIMESTAMP  
__updated_at__	NOT NULL TIMESTAMP  
__vehicle_id__ NOT NULL INT UNSIGNED   
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| hires schema                  |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__name__ NOT NULL VARCHAR(191) UNIQUE  
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE    
__is_active__ NOT NULL BOOLEAN DEFAULTS TRUE    
__created_at__	NOT NULL TIMESTAMP  
__updated_at__	NOT NULL TIMESTAMP   
__vehicle_id__ NOT NULL INT UNSIGNED  
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| users schema                 |
|:---------------------------- |
__id__ NOT NULL INT INCREMENTS  
__name__ NOT NULL VARCHAR(191)  
__email__ NOT NULL VARCHAR(191) UNIQUE  
__password__ NOT NULL VARCHAR(191)  
__remember_token__ VARCHAR(100)     
__created_at__	NOT NULL TIMESTAMP   
__updated_at__	NOT NULL TIMESTAMP   
__receives_email__ NOT NULL BOOLEAN DEFAULTS TRUE
PRIMARY KEY (__id__)

| password_resets schema       |  
|:---------------------------- |  
__email__ NOT NULL VARCHAR(191) INDEX    
__token__ NOT NULL VARCHAR(191)  
__created_at__ NOT NULL TIMESTAMP DEFAULTS NOW()   
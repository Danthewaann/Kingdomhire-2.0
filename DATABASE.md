# Database Design  
__vehicles__ (__id__, name, slug, make, model, fuel_type, gear_type, seats, status, type, weekly_rate_id*, created_at, updated_at, deleted_at)  
__weekly_rates__ (__id__, name, weekly_rate_min, weekly_rate_max, created_at, updated_at)  
__reservations__ (__id__, name, vehicle_id*, start_date, end_date, created_at, updated_at)  
__hires__ (__id__, name, vehicle_id*, start_date, end_date, created_at, updated_at, is_active)  
__users__ (__id__, name, email, password, remember_token, created_at, updated_at)    
__password_resets__ (email, token, created_at)

|   vehicles schema             |
|:----------------------------- |
 __id__ NOT NULL INT INCREMENTS 
 __name__ NOT NULL VARCHAR(30) UNIQUE
 __slug__ NOT NULL VARCHAR(90)
 __make__ NOT NULL VARCHAR(30)    
 __model__ NOT NULL VARCHAR(30) 
 __fuel_type__ NOT NULL VARCHAR(20)  
 __gear_type__ NOT NULL VARCHAR(30)   
 __seats__ NOT NULL TINYINT UNSIGNED  
 __status__ NOT NULL ENUM(‘available’, ‘unavailable’, ‘out_for_hire’)  
 __type__ NOT NULL VARCHAR(30)   
 __weekly_rate_id__ NOT NULL INT UNSIGNED
 __created_at__	NOT NULL TIMESTAMP 
 __updated_at__	NOT NULL TIMESTAMP 
 __deleted_at__	TIMESTAMP    
 PRIMARY KEY (__id__)  
 FOREIGN KEY (__weekly_rate_id__) REFERENCES __weekly_rates__(__id__)  

| weekly_rates schema          |
|:----------------------------- |
__id__ NOT NULL INT INCREMENTS  
__weekly_rate_min__ NOT NULL FLOAT(5,2)  
__weekly_rate_max__ NOT NULL FLOAT(5,2)  
__created_at__	NOT NULL TIMESTAMP 
__updated_at__	NOT NULL TIMESTAMP     
PRIMARY KEY (__id__)  

| reservations schema           |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__name__ NOT NULL VARCHAR(30) UNIQUE  
__vehicle_id__ NOT NULL INT UNSIGNED 
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE   
__created_at__	NOT NULL TIMESTAMP  
__updated_at__	NOT NULL TIMESTAMP      
PRIMARY KEY (__id__)  
FOREIGN KEY (__vehicle_id__) REFERENCES __vehicles__(__vehicle_id__)  

| hires schema                  |
|:----------------------------- |
__id__ NOT NULL BIGINT INCREMENTS  
__name__ NOT NULL VARCHAR(30) UNIQUE  
__vehicle_id__ NOT NULL INT UNSIGNED
__start_date__ NOT NULL DATE  
__end_date__ NOT NULL DATE    
__created_at__	NOT NULL TIMESTAMP  
__updated_at__	NOT NULL TIMESTAMP   
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
__created_at__	NOT NULL TIMESTAMP   
__updated_at__	NOT NULL TIMESTAMP   
PRIMARY KEY (__id__)

| password_resets schema       |  
|:---------------------------- |  
__email__ NOT NULL VARCHAR(50) INDEX    
__token__ NOT NULL VARCHAR(100)  
__created_at__ NOT NULL TIMESTAMP DEFAULTS NOW()   
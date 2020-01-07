Short Description:
	-This project is developed with frontend/backend and API, complete solution to shopping cart. 
	-Currently it has only one payment method i.e. Cash on delivery
	-It also has Pricing Rules for multiple item select product wise, say buy 3 items and pay 20 less to total cart amount. If 
	customer purchases 6 or 9, again discount of same is applied as the pricing rules says discount on buy of three.
	-Pricing rules can be defined differently for each product.

1. Change volumes path of source from "C:\Users\checkout\apps" to your local apps path

2. Default enviornment is development if want to change as production add fastcgi_param as production in .conf file of nginx and then change production config and credentials accordingly.

3. Move to root directory where docker-compose.yml is placed, mainly it is in root of the project and run below command

	docker-compose build --force-rm  // docker file changes to be reflected
	docker-compose up -d --force-recreate //build through compose
	
	docker ps // to check list of containers

4. add hosts, below I.P. is the default for all the apps

	192.168.99.100	shopcart.local
	192.168.99.100	shopcart.local.api
	192.168.99.100	shopcart.local.backend
	192.168.99.100  shopcart.local.assets

5. Config changes, if it's different then current one's

 API
	/apps/api/application/config/development/config.php
	
	$config['header_keys'] = ['web' => 'asasg@#$$hsghs', 'ios' => 'ioshghgh@#$gg'];
	
	
	/apps/api/application/config/development/database.php // change for the shards, if it's different from yours
	
	'hostname' => '192.168.99.100',
    'username' => 'root',
    'password' => 'shoopingcart3214',
    'database' => 'checkout',
	
 BACKEND
	/apps/backend/application/config/development/config.php
		
	$config['base_url'] = 'http://shopcart.local.backend:8080';
	$config['API_HOST'] = 'http://192.168.99.100:8080/v1/'; // this must be IP address, if host named given need to do DNS configuration
	
	/apps/backend/application/config/development/constant.php
	
	define("ASSETS_URL" , "http://shopcart.local.assets:8080/");
	
	/apps/backend/application/config/development/database.php // change for the shards, if it's different from yours
	
	'hostname' => '192.168.99.100',
    'username' => 'root',
    'password' => 'shoopingcart3214',
    'database' => 'checkout',
	
6. To clear query data cache follow below steps, currenlty it is being used as file caching. If want to implement memcached or other,
   just load require adaptor and config changes of memcached in /apps/{}/application/memcached.php
		1. Frontend: /apps/frontend/application/cache/ /apps/backend/application/cache/ delete all the cache files in it
		2. Use Backend menu in Account, Clear Cache
		
7. Backend Credentials and url (only userTypeId=1 is allowed to log in, if require add other users to AccessUser array)

	http://shopcart.local.backend:8080/login
        username : amir
        password: amir
		
			
8. Any update/insert in backend, clear the cache from menu to reflect it.
  It can be called internally as we can detect the insert/update/delete actions.
	
9.Technical Doc link: (Request to see)

https://docs.google.com/document/d/1fCcWq065AGmNlUWzc32ALw3iKWZEj4-788yHgBPUurw/edit#


	
	

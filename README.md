1 change volumes path of source from "D:\shoppingcart\apps" to yout local apps path

2 change fastcgi_param as production in .conf file of nginx, default it is given as development

3 move to root directory where docker-compose.yml is placed, mainly it is in root of the project and run below command

	docker-compose up -d

4 add hosts, below I.P. is the default for all the apps
	192.168.99.100	shopcart.local
	192.168.99.100	shopcart.local.api
	192.168.99.100	shopcart.local.backend
	192.168.99.100  shopcart.local.assets
	
5 Doc link:

https://docs.google.com/document/d/1fCcWq065AGmNlUWzc32ALw3iKWZEj4-788yHgBPUurw/edit#

6. Config changes, if it's different 

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
	
	
	
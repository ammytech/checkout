1 change volumes path of source from "D:\shoppingcart\apps" to yout local apps path

2 change fastcgi_param as production in .conf file of nginx, default it is given as development

3 move to root directory where docker-compose.yml is placed, mainly it is in root of the project and run below command

	docker-compose up -d

4 add hosts, below I.P. is the default for all the apps
	192.168.99.100	shopcart.local
	192.168.99.100	shopcart.local.api
	192.168.99.100	shopcart.local.backend
	192.168.99.100  shopcart.local.assets
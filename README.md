#Jexm Framework#
This framework was created as a graduating project for JensenEducation. Jexm is free to use and manipulate and what not. See license.
##Dependencies##
Jexm is very easy to set up. Note though that it is tested more thoroughly 
with use of a virtual host. Although the aim is to have it run flawlessly "as-is" this might not be the case. All methods might not be available without setting up a virtual host.
#####
#####Jexm requires >= PHP 5.4
#####
Namespaces are used for autoloading classes. If you want to use your own classes you can put them in the jexm/classes directory with namespace jexm\classes;

##Configuration##
After downloading you need to configure Jexm slightly. You need to set up your database credentials in jexm/config/database.php (Jexm currently supports a mysql and sqlite connection).
#####
In the same directory theres a config.php file which allows you to alter the urlroot (if not using a virtual host), the timezone and define if in production mode or not.
###Getting started - Routes###
Setting up routes is very simple in Jexm. All you have to do define the url you wish and point it to a controller and method. Note there are two different request methods.
#####$route->get( '/', 'FooBarController@fooMethod' );
#####$route->post( '/', 'FooBarController@fooMethod' );
#####
Jexm allows you to define a param based on the url. Note that the name wrapped in <> will be the key when retreiving the data. 
#####
#####$route->get('/params/\<name\>','test@showParam');
#####
Example above with url /params/foo point to controller Test::showParam(). Calling $this->currentRequest->getArgs() from that scope would return an associative array as such : ["name" => "foo"]
###Controllers###
When you create a controller you extend the Controller in the controllers directory.
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####
The controllers all have access to helpers which will ease the coding and save you time. See the helpers section futher down.
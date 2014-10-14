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
In the same directory theres a config.php file which allows you to alter the timezone and define if in production mode or not.
###Getting started - Routes###
Setting up routes is very simple in Jexm. All you have to do define the url you wish and point it to a controller and method. Note there are two different request methods.
(Note that if NOT using a Vhost, the url should be the same. DONT include the path preceeding the jexm directory).
######$route->get( '/', 'FooBarController@fooMethod' );
######$route->post( '/', 'FooBarController@fooMethod' );
#####
Jexm allows you to define a param based on the url. Note that the name wrapped in <> will be the key when retreiving the data. 
######
######$route->get('/params/\<name\>','test@showParam');
######
Example above with url /params/foo point to controller Test::showParam(). 
Calling $this->currentRequest->getArgs() from that scope would return an associative array as such : ["name" => "foo"]
###Controllers###
When you create a controller you extend the Controller in the controllers directory. (Dont forget the namespace)
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####
To pass data to the view you use the send method. 
The data must be passed as an associative array ['myVar' => $anydata]. 
The data is then retrieved from the defined template as $myVar.
######$this->view->send(['myVar' => $anydata, 'foo' => 'bar']);
######
Defining a template to use is done last and with the render method. This is when you return the view. 
If template recides in a deeper folderstructure (/views/foobar/foo) the folderpath must be appended. 
*nix users also use the windows directory separators. These will be converted inside Jexm.

```php
return $this->view->render('foo');
```
######return $this->view->render('foobar/foo');
######
These methods can be chained aswell as example below.
######return $this->view->send(["myVar" => $anydata])->render('foo');
######
The controllers all have access to helpers which will ease the coding and save you time. See the helpers section further down.
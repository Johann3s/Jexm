#Jexm Framework#
This framework was created as a graduating project for JensenEducation. Jexm is free to use and manipulate and what not. See license.
##Dependencies##
Jexm is very easy to set up. Note though that it is tested more thoroughly 
with use of a virtual host. Although the aim is to have it run flawlessly "as-is" this might not be the case. All methods might not be available without setting up a virtual host.
#####
#####Jexm requires >= PHP 5.4 the rewrite_module enabled and [composer](https://getcomposer.org/)


##Install & Configuration##
After downloading you need to run composer install and configure Jexm slightly. 
Save the database-example.php file in directory /jexm/config/ as database.php and set up your database credentials. 
(Jexm currently supports a mysql and sqlite connection).
#####
In the same directory theres a config.php file which allows you to alter the timezone and define if in production mode or not.
##Getting started - Routes##
Setting up routes is very simple in Jexm. All you have to do define the url you wish and point it to a controller and method. 
Note there are two different request methods.

```php
Routes::get( '/', 'FooBarController@fooMethod' );
Routes::post( '/', 'FooBarController@fooMethod' );
```

Jexm allows you to define a parameter based on the url. 
Note that the string wrapped in <> will be the accessor (propertyname) when retreiving the data. 

```php
Routes::get('/params/<anything>','test@showParam');
```
Consider example above with url /params/foobar point to a controller named 'Test' with method 'showParam()'. 
The variable is available as a method parameter Test::showParam($myvar) as below :

```php 
public function showParam($myvar){
	var_dump($myvar); 
	// object(stdClass)[36] public 'anything' => string 'foobar' (length=6)
}
``` 

##Controllers##
When you create a controller you extend the Controller in the controllers directory. (Dont forget the namespace)
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####
#####Returning views
To pass data to the view you use the send method. 
The data must be passed as an associative array ['myVar' => $anydata]. 
The data is then retrieved from the defined template as $myVar.

```php
View::send(['myVar' => $anydata, 'foo' => 'bar']);
```
This however would not render without chaining the render method.

Defining a template to use is done last and with the render method. This is when you return the view. 
If template recides in a deeper folderstructure (/views/foobar/foo) the folderpath must be appended. 
*nix users also use the windows directory separators. These will be converted inside Jexm.

```php
return View::render('foo');
return View::render('foobar/foo');
```
######
These methods Must be chained though to actually render any data.
```php
return View::send(["myVar" => $anydata])->render('foo');
```
Jexm comes with Twig templating. To render a twig template save the template as foo.tpl.php. 
Then return it from controller as below : 

```php
return View::send(["myVar" => $anydata])->render('foo.tpl');
```
Note that using Twig alters the scope of the helper objects. 
See more in section about View helpers.
#####
#####Redirects
Redirections is straightforward in Jexm. 
You can redirect with a path /path/to/something or with a controller@method request.

```php
Redirect::to('/path/to/something');
Redirect::to('FooController@barMethod');
```

You may pass variables along with the redirection aswell. 
Prepend the to() method with the with() method. The params must be an associative array.

```php
Redirect::with(["id" => 1])->to('FooController@barMethod');
```

#####Collecting GET & POST
Jexm comes with a smooth method for collecting data.
Methods below return null or populated. A null value doesnt throw a warning, Jexm checks for population internally.
```php
$id = Globals::get('id'); //returns $_GET['id']
$all = Globals::getAll(); //returns $_GET
$id = Globals::post('id'); //returns $_POST['id']
$all = Globals::postAll(); //returns $_POST
```


#####
#####Handling users
If you use the jexm user model you may use the jexm Authenticate class.
It comes with easy methods to handle users within the application.
To use the User model you only need to enter the tablename the model is using.

######Authenticating a user
Jexm uses blowfish as hashing algorithm and your users passwords must be hashed with Jexms' hashing method 
for authentication to work. However this is easy in Jexm with hasher class. Simply call the method
below before saving passwords. 
```php
$hash = Hasher::create('somestring'); //Returns hashed and salted string
```
Note that you cannot hash something more than once and expect it to work.
#####
######Login a user
To login a user utilize the Authenticate class and call the method login().
You need to pass an associative array with 2 checkups. No more, no less. The checkups
must contain columnname and corresponding value. (See codeexample below).
Method returns a userid if a succesful login was completed or false on failure
```php
$userid = Authenticate::login(["columnname" => "tester@fakemail.com","columnname" => "secret"); //$userid == int||false 
```
To check if a user is logged use the check method: 
Method returns userid if logged in and false if not.
```php
$id = Authenticate::check(); //$id == int||false 
```
#####
##Models
When you create a Model you extend the Model in the models directory. (Dont forget the namespace)
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####Query the database
When quering the database Jexm comes with 4 methods, create,update,delete and fetch.
The query is parameterized and should look like below:
```php
$result = $this->fetch("SELECT something FROM sometable WHERE somevalue = ?",[$param]);
```
The bindvalues array are optional meaning if your query is not containing any userinput you
do not have to pass the array along.
######Fetching data
When fetching data you use the fetch method like demonstrated above. If you have a parameterized query
pass the params as an array in corresponding order.
```php
$result = $this->fetch("SELECT something FROM sometable WHERE somevalue = ? AND someothervalue = ?",[$param1,$param2]);
```
Jexm comes with an easy way to paginate your query using the paginator class. Simply add how many rows you want
displayed per page after your parameters. Note that if you dont pass any parameters you must pass an empty array
anyway to use the built in pagination.
```php
$result = $this->fetch("SELECT something FROM sometable WHERE somevalue = ?",[$param1],10); //displaying 10 rows per page
```

When paginating a query Jexm returns a complete set of links wrapped in a p tag with css-class 'pagination-links'.
All the links are a tags and the The current page a b tag with css-class 'current'
They come completely unstyled containing pagenumbers corresponding to its position in the paginated query.
If there is a next page there will be a >> anchor and if there is a previous page there will be a << anchor.
The linkset come appended to the resultset as an associative array and are retrieved as below:

```php
$result = $this->fetch("SELECT something FROM sometable WHERE somevalue = ?",[$param1],10); //displaying 10 rows per page
$linkset = $result['paginationLinks'];
```
######Updating data
When updating Jexm returns the number of affected rows. I.e if nothing was updated method returns 0.
```php
$rowcount = $this->update("UPDATE sometable SET somecolumn = 'somevalue' WHERE id = ?",[7]);
```

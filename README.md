#Jexm Framework#
This framework was created as a graduating project for JensenEducation. 
Jexm is a light MVC framework written in PHP. Its released under GNU license.
##CONTENTS
- [Dependencies](#Dependencies)
- [Install & Configuration](#install)
- [Getting started](#start)
- [Controllers](#controller)
- [Responses - Views](#viewresponse)
- [Responses - Json](#jsonresponse)
- [Redirects](#redirects)
- [Session](#session)
- [User handling](#users)
- [Models](#models)
- [Query Builder](#qb)
- [Raw Querying](#regquery)
- [Custom Classes](#custom)
- [Sanitizing & Filtering data](#sanitize)
- [Links and Paths](#links)


##<a name="Dependencies"></a>Dependencies
Jexm is very easy to set up. Note though that it is tested more thoroughly 
with use of a virtual host. Although the aim is to have it run flawlessly "as-is" this might not be the case. All methods might not be available without setting up a virtual host.
#####
#####Jexm requires >= PHP 5.4 the rewrite_module enabled and [composer](https://getcomposer.org/)


##<a name="install"></a>Install & Configuration##
After downloading you need to run [composer install](https://getcomposer.org/doc/03-cli.md#install) and configure Jexm slightly. 
Save the database-example.php file in directory /jexm/config/ as database.php and set up your database credentials. 
(Jexm currently supports a mysql and sqlite connection).
#####
In the same directory theres a config.php file which allows you to alter the timezone and define if in production mode or not.
##<a name="start"></a>Getting started - Routes##
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

##<a name="controller"></a>Controllers##
When you create a controller you extend the Controller in the controllers directory. (Dont forget the namespace)
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####
#####<a name="viewresponse"></a>Returning views from controllers
To pass data to the view you use the send method. 
The data must be passed as an associative array ['myVar' => $anydata]. 
The data is then retrieved from the defined template as $myVar.
To render a view you must chain the render method as below

```php
View::send(['myVar' => $anydata, 'foo' => 'bar'])->render('foo');
```

You can send data as one big array or with multiple send methods chained.
```php
View::send(['myVar' => $anydata])->send(['foo' => $moreData])->render('foo');
```
Jexm comes with Twig templating. To render a twig template save the template as foo.tpl.php. 
Then return it from controller as below : 

```php
return View::send(["myVar" => $anydata])->render('foo.tpl');
```
Note that using Twig alters the scope of the helper objects. 
See more in section about View helpers.
#####
#####<a name="jsonresponse"></a>Returning json from controllers
To return JSON from the controllers use the JSON class. Invoke the respond method
and pass your data. The data must be an associative array or an array of objects with properties.
Like a database fetch. The clas will convert your data into json and send proper headers.
```php
return Json::respond(["name" => $anydata]);
```
#####
#####<a name="redirects"></a>Redirects
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
#####
#####<a name="session"></a>Session
You have access to the session class from controllers and models.
It comes with smooth handling while inserting,retrieving and removing data from 
the superglobal.
######
Adding data is done by the add method. It takes one or more associative arrays as arguments.
The key given here will be the key when retrieving or removing data later on.
```php
Session::add(['userid' => $id,'firstname' => 'foo']);
```

Retrieving and removing data is done by simply calling the get method with a key as an argument.
```php
$name = Session::get('firstname');
Session::remove('firstname');
```
#####
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
#####<a name="users"></a>Handling users
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
Method returns a userid if a succesful login was completed or false on failure.
```php
$userid = Authenticate::login(["columnname" => $username,"columnname" => $password); //$userid == int||false 
```
Note that the login method expects the fetched column from database to be hashed. 
For instance if columnnames are username and password, Jexmwould fetch username and password from tablename 
where username = value. Then tries to hash the given password with the hashed password fetched from database.
Note alse that order matters here. The last checkup item must be the one pointing to a hashed columnvalue in db.
```php
$userid = Authenticate::login(["username" => $username,"password" => $password); 
```
These columnnames can of course be any existing columnnames(email etc...)
##### 
To check if a user is logged use the check method: 
Method returns userid if logged in and false if not.
```php
$id = Authenticate::check(); //$id == int||false 
```
#####
##<a name="models"></a>Models
When you create a Model you extend the Model in the models directory. (Dont forget the namespace)
#####Note that there must be a a constructor calling parent::__construct() before anything else.
#####
###<a name="qb"></a>Query the database with Jexms' querybuilder
Jexm comes with a light and easy to use querybuilder.
To use the querybuilder use the DB class which lets you build
up your query. All values are parameterized.

######SELECT QUERIES
The select method works as example below.
First define which table to use in DB::table().
Then choose which columns to fetch. 
Then define (optional) conditionals.
Declare an sorting (optional). If invoked accepts ASC or DESC as sorting. Defaults to ascending order when invoked.
Then execute query with the get() method.
NOTE that if select method is invoked without arguments SELECT * is assumed
```php
$result = DB::table('books')
		  ->select('id','title','author')
		  ->where('id','=',9)
		  ->orderBy('id','ASC')
		  ->get();
```	
Its possible to add multiple conditionals by chaining more of the where methods together.
The where method assumes an AND relation if multiple conditions are declared.
To use an OR relation use the orWhere() method.
```php
$result = DB::table('books')
		  ->select('id','title','author')
		  ->where('title','=','Foo Title')
		  ->where('author','=','John Foe')
		  ->orWhere('id','=',8)
		  ->orderBy('id','ASC')
		  ->get();
```	
To paginate your query call the paginate() method. It expects an positive integer and will default to 0 if none given. 
Meaning pagination will never be invoked.  
```php
$result = DB::table('books')
		  ->select()
		  ->where('id','<',25)
		  ->orderBy('id','ASC')
		  ->paginate(5)
		  ->get();
```
When paginating Jexm returns a set of unstyled links. 
These will correspond to your declared number of views per page (as stated as an argument in paginate() method).
They come as an associative array appended to your query object. 
Retrieve them as below:
```php
$links = $result['paginationLinks'];
```
Pagination and its links are explained further a few sections down.

######Joins
To join tables call the join method. It takes 2 arguments, the table to join as a string
and conditions as an array.
```php
$result = DB::table('books')
	  ->select('title','author','name','income')
	  ->join('publishers',['publisher_id','=','publishers.id'])
	  ->join('revenue',['book_id','=','books.id'])
	  ->where('author','LIKE','Tolk%')
	  ->orWhere('income','>','8000')
	  ->orderBy('books.id','DESC')
	  ->get();
```
######Count
```php
To get a count simply execute your query with the getCount method instead of get()
$result = DB::table('books')
		  ->select('id','title','author')
		  ->where('id','=',9)
		  ->getCount();
```	
######INSERT QUERIES
Insert queries are straightforward. Define the table name
and use the add() method. Simply declare which columname to give which value.
Execute the query with the execute() method.
```php
$result = DB::table('books')
		  ->add('title','Excellent Title')
		  ->add('author','Superb Authorname')
		  ->add('discount',1)
		  ->execute();
```	
Codeblock will return created id if succesful. 

######UPDATE QUERIES 
Updating columns is similar to insertions. However you are allowed to declare conditionals.
In the change() method declare which column to be updated followed by new value.
State if any conditions and execute the query with the execute() method.
```php 
$result = DB::table('books')
		  ->change('title','New Title')
		  ->change('discount',0)
		  ->where('id','=',9)
		  ->execute();
```		
Codeblock will return number of affected rows.

######DELETE QUERIES 
When deleting rows you as always define which table to delete from.
Then invoke the remove method and any conditions.
You may use the limit method. If given arguments it expects an positive integer and will default to 1 if not met. 
If invoked without arguments it defaults to 1.
```php	
$result = DB::table('books')
		  ->remove()
		  ->where('id','=',9)
		  ->limit()
		  ->execute();
```
Codeblock will return number of affected rows.

#####<a name="regquery"></a>When querybuilder comes in short
There will come times when you need to query database without the support of querybuilder.
Jexm allows you to use the basemodels crudmethods.

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
#####Inserting data
When inserting data Jexm will return the created id if successful. Affected rows
if not successful (meaning 0).
```php
$id = $this->insert("INSERT INTO sometable (somecolumn) VALUES (?)",[$foo]);
```
#####Deleting data
When deleting data Jexm will return the rowcount of rows affected by query.
```php
$rowcount = $this->delete("DELETE FROM sometable WHERE id = ?",[11]);
```
#####
##<a name="custom"></a>Custom classes
Jexm allows you to use your own classes. Put them in the classes directory (jexm\classes)
with the namespace jexm\\classes.
When it comes to actually use and instantiate yout classes jexm comes with a few different choices:
######Normal instantation
Jexm autoloads classes through the namespace. Thus if you want to instantiate a custom class
you must prepend the class with the namespace or alias the namespace through use or class_alias().
```php
$myInstance = new \jexm\classes\MyClass();
```
#####
######DI Instantiation
If your class has dependencies in form of another class you might want to use Jexms dependancy injector.
Its built upon Reflection and loads the dependencies recursively. Meaning if the class your class is loading has its own
dependencies, they will be loaded aswell.
Note that this will only work if dependencies are properly typehinted, are instantiable and NOT singletons.
When instantiated this way class needs full namespace and you do NOT have to inject the dependencies manually.
Consider the example below:
```php
namespace jexm\classes;
class MyClass{
	public function __construct(\jexm\classes\FooBar $foo){
		$this->foo = $foo;
	}
}
$myInstance = DI::get('\jexm\classes\MyClass');
```
$myInstance is now an instance with dependency injected without having to pass the class as an argument to
the constructor.
#####
######Facades
Jexm allows you to use facades. This is a two step process.
First you will have to add your class to the dependancy register. This is done in jexm/core/di/ContainerRegistry.php.
In the container you may call another objects from the container, singletons aswell. Thus removing the need
to keep track of changes in dependencies and calling them when invoking a class. 
The syntax is as below:
```php
$container->register("MySuperClass",function() use ($container) {
	$foo = $container->get("Foo");
	return new \jexm\classes\MyCustomClass($foo);
});
```
You create an alias and a closure to invoked when that alias is called upon. Meaning the function
triggers and returns your class. Note that the alias differs from the actual class and can be anything (not already in the register).

Step 2 is to create a facadeclass for your alias in the container. This is done by extending the facade class in 
jexm/core/facades/ . Your facade however should recide in the custom directory with namsepace accordingly. This allows Jexm to autoalias your facade
for access in controllers and models. 
This class only purpose is to return the alias you created in the registry. 
The classname you give your facade will be the one you call on later on. This means you appear to
invoke the class and method statically but you are actually not.
```php
namespace jexm\core\facades\custom;
class MySuperClass extends \jexm\core\facades\Facades{
	
	public static function resolveClass(){
		return "MySuperClass";
	}
	
}
```
Doing the steps above means you can now call your class MyCustomClass through the facade
and getting the dependency injected as defined in the containerregistry.
Note that you are actually calling the facade from now on thus it will be namespaced accordingly.
However Jexm will alias the classes in the jexm/core/facades/custom directory for you to access in controllers and models.
```php
$someValue = MySuperClass::getSomethingCool($argument);
```
#####
##<a name="sanitize"></a>Sanitize & filter data
To clean and filter your data you may utilize Jexms' Sanitizer class. It can take 1-dimensional arrays and plain strings.
However the class is able to clean an array containing objects, 
such as a db-fetch, as long as it is NOT nested deeper than one dimension, which can come in handy.
Sanitizer takes two arguments, the variable being filtered and an array of methods to invoke on that variable.
The supported methods are tags,trim,upperFirst and lower. 
```php
$filtered = Sanitize::filter($varToClean,['tags','trim']);
```
The Sanitizer will execute all methods defined in the array and return your data as it were. 
Meaning it will not break any properties or keyvalues. 
It is also UTF-8 supportive using the multibyte functions when necessary.
#####
##<a name="links"></a>Links and paths
Jexm supports a convenient way to create link and paths similar to the way you set up routes.
The Link class creates and returns an entire element with an anchor while the Path class simply 
returns a path.
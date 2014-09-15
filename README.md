LWAF
====

Light Weight Application Framework - PHP

There are several example folders and files in the package, thy are not ness. needed but will give you a good idea of the workflows and logic.

The entire framework is self sufficient and is not an end all be all library, however it shows how elegant and simple a framework in php can actually be. I wrote this in about a day and figured I could share it with others that maybe want something to get started with in their overall pursuit and growth.

I think this is a good beginning for any developer out there that might want some insight without a million lines of code to sort through, when said lines may or may not be useful in an everyday type of application.

The LWAF dir should be your sites public dir for your http server (apache is my preferred http server and was used in LWAFs development)






The base break down of the files inside the leaf dir is such:


addins 	    - This is an initializing folder for functions or other assets you want to be included relative to the path executed in the browser. ( I.E. add some_function for the index.php inside the pages folder the folder and files should reflect the same as the pages dir path)

configs 	- place holder for all configs loaded into the app and or your own additionally included configs

functions 	- php functions that will be initiated by the application (please note these must be included through addins  to best utilize the framework)

libs 		- The controller/application class is held. you may also want to include a DBclass, MailClass or other things in this dir.

pages       - holds all of your public rendered assets (this is your "site")

static 		- place holder for generally static files or includes.

style	 	- all css, images, js, etc.




I will most likely add more to this later....
manintec-enfrasys-sensors
=========================

A Symfony project created on December 2, 2015, 10:46 am, by Maxence Bouret, Robin Gélibert and Rémi Santiago.


How to configure the project?
=============================

Software to install
-------------------
If you work on Windows, we suggest to install the full version of Cmder on http://cmder.net/  
It is a very nice console emulators on Windows. Commands that work on Linux/OSX generally works on Cmder.  
It will also install Git.  

You should also install WAMP (for windows) or LAMP (for linux) or any other apache 2 installer  
You can verify that your localhost is launch by reaching the url  [http://localhost/](http://localhost/)  
Normally phpmyadmin is already install with WAMP/LAMP  
You can verify that your localhost is launch by reaching the url  [http://localhost/phpmyadmin](http://localhost/phpmyadmin)


Clone of Git repository
-----------------------
    $ git clone https://github.com/mc100s/manintec-enfrasys-sensors.git



Installation and use of Composer
--------------------------------
To install Composer

    $ php -r "eval('?>'.file_get_contents('http://getcomposer.org/installer'));"

To check that Composer works

    $ php composer.phar --version

To update Composer

    $ php composer.phar self-update

To update the project with Composer

    $ cd path/to/my/folder
    $ php ../composer.phar update


You may have some parameters to fill :

Creating the "app/config/parameters.yml" file  
Some parameters are missing. Please provide them.

    database_host (127.0.0.1):
    database_port (null):
    database_name (symfony):
    database_user (root):
    database_password (null): PUT HERE YOUR PHPMYADMIN PASSWORD
    mailer_transport (smtp):
    mailer_host (127.0.0.1):
    mailer_user (null):
    mailer_password (null):
    secret (ThisTokenIsNotSoSecretChangeIt):


Database configuration
----------------------
First, you have to create a database. You can choose any database name.

Then, you should configure the file app/config/parameters.yml with your configurations.

Then, you can create the database with the following command:

    $ php app/console doctrine:database:create

To update your database like the models suggest:

    $ php app/console doctrine:schema:update --dump-sql
    $ php app/console doctrine:schema:update --force


How to use the projet?
======================

What to do to update the projects? (all the commands)
-----------------------------------------------------
    $ git pull
    $ php ../composer.phar update
    $ php app/console doctrine:schema:update --dump-sql
    $ php app/console doctrine:schema:update --force
    $ php app/console cache:clear
    $ rm -rf app/cache
    $ php app/console doctrine:fixture:load # If you want to load fixtures


Basic git commands
------------------
    $ git status
    $ git diff
    $ git add file1 file2 folder1 folder2
    $ git commit -am "Message of my commit"
    $ git push
    $ git pull


Launch the server and test the project
--------------------------------------
    $ php app/console server:run
Or reach the URL : [http://localhost/manintec-enfrasys-sensors/web/app_dev.php](http://localhost/manintec-enfrasys-sensors/web/app_dev.php)
(don't forget to launch WampServer)


Update composer
---------------
    $ cd path/to/my/folder
    $ php ../composer.phar update


Update the database
-------------------
    $ php app/console doctrine:schema:update --dump-sql
    $ php app/console doctrine:schema:update --force


Clear cache
-----------
The best way:

    $ php app/console cache:clear

If there are some problems:

    $ rm -rf app/cache

If these commands don't work, you should delete it with explorer or Neatbeans.


Some useful Symfony commands
----------------------------
To load all data fixtures

    $ php app/console doctrine:fixture:load

To update the database according to the model

    $ php app/console doctrine:schema:update --dump-sql
    $ php app/console doctrine:schema:update --force

To launch the server

    $ php app/console server:run

To generate a new entity classes and method from the mapping information (example for EnfrasysPlatformBundle:Device)

    $ php app/console doctrine:generate:entity

To generate getters and setts of a current entity class (example for EnfrasysPlatformBundle:Device)

    $ php app/console doctrine:generate:entities EnfrasysPlatformBundle:Device



Others stuffs
=============
How to create a user and give him roles
----------------------
	
	$ php app/console fos:user:create
	$ php app/console fos:user:promote

The diffrents roles are:
 - ROLE_SUPER_ADMIN
 - ROLE_ADMIN
 - ROLE_TECH
 - ROLE_CLIENT
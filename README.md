NAO
===

A Symfony project created on November 9, 2017, 8:39 am.

This project is part of an online course to get a certification as a Web Project Manager.

##Project members :
- Siyuan LEE : graphics and design
- Roland MERAT : marketing
- Vincent BIRBES : development
- Emmanuel PETIT :  development
- Stéphane TORCHY : tutor

##Pre-required :
- A veb server running Apache.
- PHP 5.5.9 at minima (version 7 is recommended).
- A MySQL database server.
- composer should be installed on the machine your going to use for this application (see https://getcomposer.org/).

##Installation :
- Create a folder on your web server to receive the application.
- Download all the files from Github into the folder you created.
- Once the download finished, run `composer install` in the root folder, to get all dependencies of the application. Wait for it to finish.
- Open the file `parameters.yml` and enter your database name, username, password as well as the details for your mailer (see with your host provider).

##Database setup
In your root folder, run the following commands :
- `php bin/console doctrine:database:create` : this creates the database
- `php bin/console doctrine:database:migrate` : answer "y" at the question to create the tables
- `php bin/console app:load-data` : it will load the data in the database 

The web site should now be up and running


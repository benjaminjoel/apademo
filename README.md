# APA Demo

Installation on Xampp (using download)
--------------------------------------
1. Create a folder inside xampp htdocs folder. For e.g (apademo) is the folder created on htdocs
2. Move the downloaded files to the folder that we created.
3. Install composer to your system
4. Open command prompt and go to your project folder we created.
5. Run "composer update" using command prompt
6. Create a database on localhost phpmyadmin (apademo).
7. Update .env file with database name, user and password.
8. Import the sql provided (apademo.sql) to the database.
9. Use browser and go the folder public to see the application. (http://localhost/apademo/public)

------------------------


Installtion on Xampp (using checkout)
--------------------------------------
1. Install git to your system
2. Open command prompt and go to htdocs folder
3. Run this command "git clone https://github.com/benjaminjoel/apademo.git (foldername)"
4. Go inside the project folder and Run "composer update"
5. Create a database on localhost phpmyadmin (apademo).
6. Update .env file with database name, user and password.
7. Import the sql provided (apademo.sql) to the database or run migration using command "php artisan migrate" and it will create the tables in database without sample data.
8. Use browser and go the folder public to see the application. (http://localhost/apademo/public) or you can run using command "php artisan serve"

----------------------------------------
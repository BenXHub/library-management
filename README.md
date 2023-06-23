# library-management

This is a PHP script that generates a web page displaying a table of books from the ACLC Iriga Library. 

---
## Development Setup
Here are the steps to set up the development environment for this project:

1. Download and install
   [XAMPP](https://www.apachefriends.org/download.html) if you haven't already.
   <br><br>
2. Start Apache and MySQL through XAMPP if not already running.
   <br><br>
3. Clone or download this repository to your XAMPP **htdocs** folder.
   The final path should be `path_to/xampp/htdocs/library-management`.
   <br><br>
4. Copy [**`config/conn.example.php`**](config/conn.example.php)
   to **`config/conn.php`**, then modify the database connection settings in the new file.
   <br><br>
5. Inside [phpMyAdmin](http://localhost/phpmyadmin),
   create a MySQL database named `library_management` and import [library_management.sql](library_management.sql) into it.

---
## Production Deployment
Here's how to compile the project for production deployment:

1. Access the application by visiting 
   - <http://localhost/library-management>



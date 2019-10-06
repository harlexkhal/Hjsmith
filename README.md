# Hjsmith
HjSmith Web development

#The Server Signup is fully functional and working...
#HOW TO RUN  Server/STest.html to Test the PhP signup Page

# Step 1- Create a new database in the phpmyadmin manually.Give it any name you like...
# Step 2- Open the Server/Dependencies.php file and change the variables

  $dbhost  = 'localhost';  
  $dbname  = '<Insert The name of The DataBase you created Here>';   
  $dbuser  = 'root';<'leave this as root if you have not set your phpmyadmin/mysql user Admin details>   
  $dbpass  = '';    <also leave this as empty string if you are yet to set a password>

#Step 3- With your localhost Server active, visit Server/SetUp.php in your webpage first to automatically 
         setup all the tables, if you dont do this first you would get series of errors while trying to test
         the signup processing...
#Step 4- Visit the STest.html on your browser and begin testing with the form already provided..



############################################################################################################
IF YOU ARE NOT FARMILIAR WITH HOW AJAX JSON FILE TRANSFER WORK I.E TRANSFER OF DATA BETWEEN CLIENT AND SERVER
LOOK AT THE EXAMPLE CODES IN THE *zExample Codes ajax json* folder to learn and understand how to do it...
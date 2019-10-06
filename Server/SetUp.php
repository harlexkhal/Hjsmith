
<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>
<?php 
  require_once 'Dependencies.php';

  CreateTable( 'UserInfo',
              'Username VARCHAR(16),
               Password VARCHAR(16),
			   Email    VARCHAR(255),
               INDEX(Username(10))');

  CreateTable('AccountDetails', 
               'Username VARCHAR(16),
			    EWallet DECIMAL(10,2),
				Points DECIMAL(2,1),
				INDEX(Username(10))');

  CreateTable('UserActivity',
               'Username VARCHAR(16),
			    CommentCount INT UNSIGNED,
				PostViewCount INT UNSIGNED');

  CreateTable('Posts',
               'Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			    Title VARCHAR(1024),
			    Content VARCHAR(7168),
				ViewsCount INT UNSIGNED,
				Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX(Title(10)),
			    INDEX(Content(50))');
			 
  CreateTable('Comments',
              ' Title VARCHAR(1024),
			    Content VARCHAR(100),
				Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
?>

 <br>...done.
  </body>
</html>

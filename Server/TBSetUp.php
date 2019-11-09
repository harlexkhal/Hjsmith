
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
              'UserId VARCHAR(255),
			   FirstName VARCHAR(255),
			   LastName VARCHAR(255),
			   Email VARCHAR(255),
			   Password VARCHAR(255),
			   Phone  VARCHAR(20)');

  CreateTable( 'EmailConfirmation',
               'RandomKey VARCHAR(512),
			    UserId VARCHAR(255),
				FirstName VARCHAR(255),
				LastName VARCHAR(255),
				Email    VARCHAR(255),
                Password VARCHAR(255),
				Phone    VARCHAR(32)');

  CreateTable( 'AccountDetails', 
               'Username VARCHAR(16),
			    EWallet DECIMAL(10,2),
				Points DECIMAL(2,1)');

  CreateTable( 'UserActivity',
               'Username VARCHAR(16),
			    CommentCount INT UNSIGNED,
				PostViewCount INT UNSIGNED');

  CreateTable( 'Posts',
               'Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			    Title VARCHAR(1024),
			    Content VARCHAR(7168),
				ViewsCount INT UNSIGNED,
				Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX(Title(100)),
			    INDEX(Content(500))');
			 
  CreateTable( 'Comments',
               'PostTitle VARCHAR(1024),
			    Content VARCHAR(100),
				Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				INDEX(PostTitle(100))');
?>

 <br>...done.
  </body>
</html>

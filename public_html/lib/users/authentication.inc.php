<?php 
	// This if statement checks to determine whether the login form has been submitted 
	// If it has, then the login code is run, otherwise the form is displayed 
	if(!empty($_POST)) { 
		if($_POST['login']) {
			// This variable will be used to re-display the user's username to them in the 
			// login form if they fail to enter the correct password.It is initialized here 
			// to an empty value, which will be shown if the user has not submitted the form. 
			$submitted_username = ''; 
			// This query retreives the user's information from the database using 
			// their username. 
			$query = " 
			SELECT 
				* 
			FROM users 
			WHERE 
				username = :username 
			"; 
			 
			// The parameter values 
			$query_params = array( 
				'username' => $_POST['username'] 
			); 
			 
			// This variable tells us whether the user has successfully logged in or not. 
			// We initialize it to false, assuming they have not. 
			// If we determine that they have entered the right details, then we switch it to true. 
			$login_ok = false; 
			 
			// Retrieve the user data from the database.If $row is false, then the username 
			// they entered is not registered. 
			$row = $db->row($query, $query_params);
			if($row) { 
				// Using the password submitted by the user and the salt stored in the database, 
				// we now check to see whether the passwords match by hashing the submitted password 
				// and comparing it to the hashed version already stored in the database. 
				$check_password = hash('sha256', $_POST['password'] . $row['salt']); 
				for($round = 0; $round < 65536; $round++) { 
					$check_password = hash('sha256', $check_password . $row['salt']); 
				} 
				 
				if($check_password === $row['password']) { 
					// If they do, then we flip this to true 
					$login_ok = true; 
				} 
			} 
		 
			// If the user logged in successfully, then we send them to the private members-only page 
			// Otherwise, we display a login failed message and show the login form again 
			if($login_ok) { 
				// Here I am preparing to store the $row array into the $_SESSION by 
				// removing the salt and password values from it.Although $_SESSION is 
				// stored on the server-side, there is no reason to store sensitive values 
				// in it unless you have to.Thus, it is best practice to remove these 
				// sensitive values first. 
				unset($row['salt']); 
				unset($row['password']); 
				 
				// This stores the user's data into the session at the index 'user'. 
				// We will check this index on the private members-only page to determine whether 
				// or not the user is logged in.We can also use it to retrieve 
				// the user's details. 
				$_SESSION['user'] = $row; 
				
				require($html_root."lib/users/secure.inc.php"); 
				// Redirect the user to the private members-only page. 
			//	header("Location: private.php"); 
			} else { 
				// Tell the user they failed 
				$error = "Login Failed."; 
				 
				// Show them their username again so all they have to do is enter a new 
				// password.The use of htmlentities prevents XSS attacks.You should 
				// always use htmlentities on user submitted values before displaying them 
				// to any users (including the user that submitted them).For more information: 
				// http://en.wikipedia.org/wiki/XSS_attack 
				$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
			} 
		}elseif($_POST['register']) {
			// Ensure that the user has entered a non-empty username 
			if(empty($_POST['username'])) { 
				// Note that die() is generally a terrible way of handling user errors 
				// like this.It is much better to display the error with the form 
				// and allow the user to correct their mistake.However, that is an 
				// exercise for you to implement yourself. 
				$error = "Please enter a username."; 
			} 
			 
			// Ensure that the user has entered a non-empty password 
			if(empty($_POST['password'])) { 
				$error = "Please enter a password."; 
			} 
			 
			// We will use this SQL query to see whether the username entered by the 
			// user is already in use.A SELECT query is used to retrieve data from the database. 
			// :username is a special token, we will substitute a real value in its place when 
			// we execute the query. 
			$query = " 
			SELECT 
				1 
			FROM users 
			WHERE 
				username = :username 
			"; 
			 
			// This contains the definitions for any special tokens that we place in 
			// our SQL query.In this case, we are defining a value for the token 
			// :username.It is possible to insert $_POST['username'] directly into 
			// your $query string; however doing so is very insecure and opens your 
			// code up to SQL injection exploits.Using tokens prevents this. 
			// For more information on SQL injections, see Wikipedia: 
			// http://en.wikipedia.org/wiki/SQL_Injection 
			$query_params = array( 
				'username' => $_POST['username'] 
			); 
			 
			// The fetch() method returns an array representing the "next" row from 
			// the selected results, or false if there are no more rows to fetch. 
			$row = $db->row($query, $query_params);
			 
			// If a row was returned, then we know a matching username was found in 
			// the database already and we should not allow the user to continue. 
			if($row) { 
				$error = "This username is already in use"; 
			} 
			 
			// An INSERT query is used to add new rows to a database table. 
			// Again, we are using special tokens (technically called parameters) to 
			// protect against SQL injection attacks. 
			$query = " 
			INSERT INTO users ( 
				username, 
				password, 
				salt
			) VALUES ( 
				:username, 
				:password, 
				:salt
			) 
			"; 
			 
			// A salt is randomly generated here to protect again brute force attacks 
			// and rainbow table attacks.The following statement generates a hex 
			// representation of an 8 byte salt.Representing this in hex provides 
			// no additional security, but makes it easier for humans to read. 
			// For more information: 
			// http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
			// http://en.wikipedia.org/wiki/Brute-force_attack 
			// http://en.wikipedia.org/wiki/Rainbow_table 
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
			 
			// This hashes the password with the salt so that it can be stored securely 
			// in your database.The output of this next statement is a 64 byte hex 
			// string representing the 32 byte sha256 hash of the password.The original 
			// password cannot be recovered from the hash.For more information: 
			// http://en.wikipedia.org/wiki/Cryptographic_hash_function 
			$password = hash('sha256', $_POST['password'] . $salt); 
			 
			// Next we hash the hash value 65536 more times.The purpose of this is to 
			// protect against brute force attacks.Now an attacker must compute the hash 65537 
			// times for each guess they make against a password, whereas if the password 
			// were hashed only once the attacker would have been able to make 65537 different
			// guesses in the same amount of time instead of only one. 
			for($round = 0; $round < 65536; $round++) { 
				$password = hash('sha256', $password . $salt); 
			} 
			 
			// Here we prepare our tokens for insertion into the SQL query.We do not 
			// store the original password; only the hashed version of it.We do store 
			// the salt (in its plaintext form; this is not a security risk). 
			$query_params = array( 
				'username' => $_POST['username'], 
				'password' => $password, 
				'salt' => $salt
			); 
			 
			// Execute the query to create the user 
			$result = $db->query($query, $query_params);
			if(!$result){
				$error = "Failed to register user.";
			}
		} 
	}

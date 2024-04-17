<?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	// Retrieve the value of the 'toynum' parameter from the URL query string
	//		i.e., ../toy.php?toynum=0001
	$book_id = $_GET['bookID'];


	/*
	 * TO-DO: Define a function that retrieves ALL toy and manufacturer info from the database based on the toynum parameter from the URL query string.
	 		  - Write SQL query to retrieve ALL toy and manufacturer info based on toynum
	 		  - Execute the SQL query using the pdo function and fetch the result
	 		  - Return the toy info

	 		  Retrieve info about toy from the db using provided PDO connection
	 */

	 function get_book_info(PDO $pdo, string $book_id) {

		// SQL query to retrieve book information based on book ID
		$sql = "SELECT * 
			FROM books
			WHERE bookID= :id;";	// :id is a placeholder for value provided later 
		                               // It's a parameterized query that helps prevent SQL injection attacks and ensures safer interaction with the database.


		// Execute the SQL query using the pdo function and fetch the result
		$book = pdo($pdo, $sql, ['id' => $book_id])->fetch();		// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in  SQL query.

		// Return the toy information (associative array)
		return $book;
	}

    function get_book_reviews(PDO $pdo, string $book_id){
        // SQL query to retrieve review info based on bookID
        $sql = "SELECT *
            FROM reviews
            WHERE bookID = :id;";
        
        $reviews = pdo($pdo, $sql, ['id' => $book_id])->fetch();

        return $reviews;
    }

	$book = get_book_info($pdo, $book_id);
// Closing PHP tag  ?> 

<!DOCTYPE>
<html>

	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<title>Toys R URI</title>
  		<link rel="stylesheet" href="css/style.css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
	</head>

	<body>

		<header>
			<div class="header-left">
				<div class="logo">
					<img src="imgs/logo.png" alt="Toy R URI Logo">
      			</div>

	      		<nav>
	      			<ul>
	      				<li><a href="index.php">Toy Catalog</a></li>
	      				<li><a href="about.php">About</a></li>
			        </ul>
			    </nav>
		   	</div>

		    <div class="header-right">
		    	<ul>
		    		<li><a href="order.php">Check Order</a></li>
		    	</ul>
		    </div>
		</header>

		<main>
			<!-- 
			  -- TO DO: Fill in ALL the placeholders for this toy from the db
  			  -->
			
			<div class="book-details-container">
				<div class="book-details">

					<!-- Display name of toy -->
			        <h1><?= $book['title'] ?></h1>

			        <hr />

			        <h3>Book Information</h3>

			        <!-- Display price of toy -->
			        <p><strong>Authors:</strong> $ <?= $book['authors'] ?></p>

			        <!-- Display age range of toy -->
			        <p><strong>Rating:</strong> <?= $book['ave_rating'] ?></p>

			        <!-- Display stock of toy -->
			        <p><strong>Page Count:</strong> <?= $book['page_count'] ?></p>

			        <br />

			        <h3>Reviews</h3>

			        <!-- Display name of manufacturer -->
			        <p><strong>Review:</strong> <?= $book['review_text'] ?> </p>

			        <!-- Display address of manufacturer -->
			        <p><strong>Review date:</strong> <?= $book['date_modified'] ?></p>

			    </div>
			</div>
		</main>

	</body>
</html>

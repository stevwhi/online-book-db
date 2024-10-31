<html>
<head>
	<meta charset = "utf-8">
  <link rel="stylesheet" type="text/css" href="add_row.css">
</head>


<body>

<?php // connect.php allows connection to the database

  require_once 'connect.php'; //using require will include the connect.php file each time it is called.

    if (isset($_POST['id'])   &&
        isset($_POST['title']) &&
        isset($_POST['author'])
		)
  {
    $validated = validate();
    if($validated)
    {
      $id     = assign_data($conn, 'id');
      $title  = assign_data($conn, 'title');
      $author = assign_data($conn, 'author');
      
      // No validation is performed so far
      $query    = "INSERT INTO table1 VALUES ('$id', '$title', '$author')";
      $result   = $conn->query($query);
      


      if (!$result) echo "<br><br>INSERT failed: $query<br>" .
    
        $conn->error . "<br><br>";
    }
    echo"$error";
  }

  function validate()
  {
    global $error;
    global $conn;
    $error = "Book sucessfully added.";
    // book id check
    /* Presence checks.*/
    if(empty($_POST['id']))
    {
      $error = "Please enter the Book id...";
      return false;
    }

    /* Type checks on ID */
    if(!is_numeric($_POS['id']))
    {
      $error = "Please only enter an integer value";
    }
    /* Length checks */
    if(strlen($_POS['id'])>=10)
    {
      $error = "id is exceeded too long";
    }

    /* Unique Id check */

    $id = $_POST['id'];
    $query = "SELECT id from table1 WHERE id = "."'$id'";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) > 0)
    {
      $error ="Error: id already found in database.";
      return false;
    }

    /*Validation check for title */
    if(empty($_POST['title']))
    {
      $error = "Please enter your book title...";
      return false;
    }
    else if(strlen($_POST['title'])>60)
    {
      $error = "title name too long";
      return false;
    }

    /*Validation check for author*/
    if(empty($_POST['author']))
    {
      $error = "Please enter your author name...";
      return false;
    }
    else if(strlen($_POST['title'])> 20)
    {
      $error = "author name too long";
      return false;
    }
    
    return true;
  }


print<<<_HTML
   <form action=" " method="post">
  
    Book id:     <input type="text" name="id" value = ""> <br><br>
    Book title:  <input type="text" name="title" value = ""> <br><br>
    Author name: <input type="text" name="author" value = ""> <br><br>
      
    <input type="submit" value="add record">
	
   </form>
_HTML;
  
  
  function assign_data($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
  
  
  $query  = "SELECT * FROM table1";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;


print<<<_HTML
   <p>Here is your Books list</p>
	
	<table id = "book_table">
		  <tr>
			<th>Book id</th>
			<th>Title</th>
			<th>Author</th>
		  </tr>
_HTML;

 
 	if ($result->num_rows >0)
			{
			echo "The books list:<br><br>";
			while($row = $result->fetch_assoc()) 
				{
						echo "<tr>";
						echo "<td>".$row["id"]."</td>";
						echo "<td>".$row["title"]."</td>";
						echo "<td>".$row["author"]."</td>";
						echo "</tr>";
				}
			} 
			else 
			{
				echo "0 results";
			}


print<<<_HTML
 </table>
 <br>
 <a href="index.php" target="_self"> <p>Home</p></a> 
_HTML;
				
$result->close();
$conn->close(); 
?>
 
</body>	
</html>



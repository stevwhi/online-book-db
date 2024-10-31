<html>
<head>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="Hnav.css">
</head>

<body>

<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="http://scc-student-web.lancs.ac.uk/wafi/week22/add_row.php">Add data</a></li>
  <li><a href="http://scc-student-web.lancs.ac.uk/wafi/week22/delete_row.php">Delete data</a></li>
  <li><a href="http://scc-student-web.lancs.ac.uk/wafi/week22/update.php">Edit & Update </a></li>
  
</ul>



 <?php // connect.php allows connection to the database

  require 'connect.php'; //using require will include the connect.php file each time it is called.

 // SELECT DAYA FROM BOOK TABLE IN DATBASE  
  
  $query  = "SELECT * FROM table1";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;

print<<<_HTML
  
  <p> Here is your Books list </p>
	
	<table id = "book_table">
		  <tr>
			<th>Book id</th>
			<th>Title</th>
			<th>Author</th>
		  </tr>
_HTML;
 
 if ($result->num_rows >0)
			{
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
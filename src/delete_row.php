<html>
<head>
	<meta charset = "utf-8">
  <link rel="stylesheet" type="text/css" href="add_row.css">
</head>

<body>

<?php
    require_once 'connect.php';


    if (isset($_POST['id']))   
    {
      $validated = validate();
      if($validated)
      {

        $id = assign_data($conn, 'id');
        
        $query = "DELETE FROM table1 WHERE id = ('$id')";
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
      }
      echo "$error";
    }

    function validate()
    {
      global $error;
      global $conn;
      $error = "Book successfully deleted";

      if(empty($_POST['id']))
      {
        $error = "Plese enter the Book id...";
        return false;
      }
      $query  = "SELECT * FROM table1 WHERE id = ". $_POST['id'] .";";
      $result = $conn->query($query);
      if(mysqli_num_rows($result) == 0)
      {
        $error = "Book id not found";
        return false;
      }
      return true;
    }

print<<<_HTML
        <form action=" " method="post">
        <p><b>DELETE A BOOK FROM DATABASE</b></p><br><br>
        Book ID <input type="text" name="id" value =""> <br><br>
        <input type="submit" value="Delete">
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
     <p><b>Here is your Books list</b></p>
      
      <table id ="book_table">
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
  <a href="index.php" target="_self"> <p>Home</p></a> 
_HTML;
                  
  $result->close();
  $conn->close(); 
    

    

?>

</body>
</html>
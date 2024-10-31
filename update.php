<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" type="text/css" href="add_row.css">
</head>
<body>
<?php
    require_once 'connect.php';

    $query  = "SELECT * FROM table1";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
  
    $rows = $result->num_rows;
    
    if (isset($_POST['id']))
    {
      $validated = validate();
      if($validated)
      {
        if(strlen($_POST['new_title']) > 0)
        {
          var_dump($POST);
          echo "<br>";
          $id     = assign_data($conn, 'id');
          $new_title = assign_data($conn, 'new_title');

          $query = "UPDATE table1 SET title = '$new_title' WHERE id = '$id'"; //query for UPDATE
          $result = $conn->query($query);
          if (!$result) die ("Database access failed: " . $conn->error);
        }
        if (strlen($_POST['new_author']) > 0)
        {
          $id = assign_data($conn, 'id');
          $new_author = assign_data($conn, 'new_author');
      
          $query = "UPDATE table1 SET author = '$new_author' WHERE id = '$id'";
          $result = $conn->query($query);
          if(!$result) die ("Database access failed: " . $conn->error);
        }
      }
      echo "$error";
    }


    
    function assign_data($conn, $var)
    {
      return $conn->real_escape_string($_POST[$var]);
    }

    function validate()
    {
      global $error;
      global $conn;
      $error = "Book succesfully added.";
      // book id check
      
      // Presence checks.
      if(empty($POST['id']))
      {
        $error = "Plese enter the Book id...";
        return false;
      }

      if(empty($POST['new_title']) && empty($POST['new_author']))
      {
        $error = "Please enter one of the two field (New Title, New Author)";
        return false;
      }

      // Lengths checks
      if(strlen($POST['new_title'])>50)
      {
        $error = "new title is too long";
        return false;
      }
      
      if(strlen($POST['new_author']))
      {
        $error = "new author is too long";
        return false;
      }
      
    }
print<<<_HTML
    <form action=" " method="post">
    <b>Book you would like to update</b> <br>
    <input type ="text" name="id" value="Book ID"> <br><br>
    <b>New Title<b> <br> <input type ="text" name="new_title" value=""> <br>
    <b>New Author<b> <br> <input type = "text" name = "new_author" value =""<br>
    <input type = "submit" value= "update">
_HTML;

    $query  = "SELECT * FROM table1";
    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    print<<<_HTML
     <p><b>Here is your Books list</b></p>
      
      <table id = "book_table">
            <tr>
              <th>Book ID</th>
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

?>
</body>
</html>
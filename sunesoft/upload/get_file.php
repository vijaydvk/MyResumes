

    <?php
    // Make sure an ID was passed
    if(isset($_GET['id'])) {
    // Get the ID
        $id = intval($_GET['id']);
     
        // Make sure the ID is in fact a valid ID
        if($id <= 0) {
            die('The ID is invalid!');
        }
        else {
            // Connect to the database
            $dbLink = new mysqli('148.72.232.177:3306', 'vijay', 'vijay011988', 'sunesoft41_');
            if(mysqli_connect_errno()) {
                die("MySQL connection failed: ". mysqli_connect_error());
            }
     
            // Fetch the file information
            $query = "
                SELECT `mime`, `name`, `size`, `data`
                FROM `file`
                WHERE `id` = {$id}";
            $result = $dbLink->query($query);
     
            if($result) {
                // Make sure the result is valid
                if($result->num_rows == 1) {
                // Get the row
                    $row = mysqli_fetch_assoc($result);
     
                    // Print headers
                  header("Content-Type: ". $row['mime']);
                  header("Content-Length: ". $row['size']);
                  header("Content-Disposition: attachment; filename=". $row['name']);
     
                    // Print data
                   echo "<dt><strong>Technician Image:</strong></dt><dd>" . 
     '<img src="data:image/jpeg;base64,'.
      base64_encode($row['data']).
      '" width="290" height="290">' . "</dd>";


                }
                else {
                    echo 'Error! No image exists with that ID.';
                }
     
                // Free the mysqli resources
                @mysqli_free_result($result);
            }
            else {
                echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
            }
            @mysqli_close($dbLink);
        }
    }
    else {
        echo 'Error! No ID was passed.';
    }
    ?>



 <?php
// Check if a file has been uploaded
if(isset($_FILES['upload'])) {

echo "hi";
    // Make sure the file was sent without errors
    if($_FILES['upload']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('148.72.232.177:3306', 'vijay', 'vijay011988', 'sunesoft41_');

        echo "hi";
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = $dbLink->real_escape_string($_FILES['upload']['name']);
        $mime = $dbLink->real_escape_string($_FILES['upload']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['upload']['tmp_name']));
        $size = intval($_FILES['upload']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
      /*  if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }*/
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['upload']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="index.html">here</a> to go back</p>';
?>

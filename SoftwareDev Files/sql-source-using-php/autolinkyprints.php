<!--
This PHP script renders summary prints, allows users to input new prints, and
get print details.
Originally created By Ron Coleman.
Revision history:
Who Date        Comment
RC  30-Oct-13   Extended as a modificaiton of iprints.php.
RC  07-Nov-13   Changed name to linkyprints.php.
RC  02-Dec-13   Copied from linkyprints.php, replaced connect_db.php includes.
-->
<!DOCTYPE html>
<html>
<?php
# NOT USED -- Connect to MySQL server and the database
#require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/autohelpers.php' ) ;

# Initialize the database
$dbc = init();

# If POST, the user submitted the form
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $name = $_POST['name'] ;

    $price = $_POST['price'] ;

    if(!empty($name) && !empty($price)) {
      $result = insert_record($dbc, $name, $price) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    }
    else
      echo '<p style="color:red">Please input a name and a price!</p>' ;
}
# If GET user either a) opened the page **or** b) clicked link
else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
    if(isset($_GET['id']))
      show_record($dbc, $_GET['id']) ;
}

# Show the records
show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="autolinkyprints.php" method="POST">
<table>
<tr>
<td>Name:</td><td><input type="text" name="name"></td>
</tr>
<tr>
<td>Price:</td><td><input type="text" name="price"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
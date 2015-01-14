s<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By GERARD TALIERCIO
-->
<!DOCTYPE html>
<html>
<?php
###########################################
# Connect to MySQL server and the database#
###########################################
require( 'includes/connect_db.php' ) ;





##################################
# Includes these helper functions#
##################################
require( 'includes/helpers.php' ) ;

IF ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
     $number = "" ;
     $fname = "" ;
     $lname = "" ;
}

IF ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$number = $_POST['number'] ;
    $fname = $_POST['fname'] ;
	$lname = $_POST['lname'] ;
	
	  IF(!valid_number($number))
      echo '<p>Please give a valid number.</p>' ;

	  ELSE IF (!valid_fname($fname))
      echo '<p>Please complete the first name.</p>' ;

	  ELSE IF (!valid_lname($lname))
      echo '<p>Please complete the last name.</p>' ;

	  IF(!empty($number) && !empty($fname) && !empty($lname)) {
      $result = insert_record($dbc, $number, $fname, $lname) ;
     }	
	  ELSE
	  echo '<p style="color:red">Something was not filled out!</p>' ;
}
# If GET user either a) opened the page **or** b) clicked link
else if($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	if(isset($_GET['id']))
	  show_record($dbc, $_GET['id']) ;
}	 

########################
# Show the link records#
########################
show_link_records($dbc);

#######################
# Close the connection#
#######################
mysqli_close( $dbc ) ;

################
# Website Form #
################

show_form($number, $fname, $lname ) ;
function show_form($number, $fname, $lname ) {
echo '<form action="linkypresidents.php" method="POST">' ;
echo '<table>';
echo '<tr>';
echo '<p>Number: <input type="text" name="number" value="' . $number . '"> </p> ' ;
echo '</tr>';
echo '<tr>';
echo '<p>First Name: <input type="text" name="fname" value="' . $fname . '"> </p> ' ;
echo '</tr>';
echo '<tr>';
echo '<p>Last Name: <input type="text" name="lname" value="' . $lname . '"> </p> ' ;
echo '</tr>';
echo '</table>';
echo '<p><input type="submit" ></p> ';
echo '</form>';

}
echo '<A HREF="javascript:history.go(0)">Click to refresh the page</A></p>' ;

?>
</html>
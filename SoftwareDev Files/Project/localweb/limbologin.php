<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/limbo_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$pass = $_POST['pass'] ;

    $id = validate($pass) ;

    if($id == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;

    else
      load('adminlimbo.php', $pid);
}
?>
<!-- Get inputs from the user. -->
<h1>Presidents login</h1>
<form action="limbologin.php" method="POST">
<table>
<tr>
<td>Password:</td><td><input type="text" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
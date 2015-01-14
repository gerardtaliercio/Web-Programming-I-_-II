<!--
Gerard Taliercio & Noca Kocovic
-->

<!DOCTYPE html>
<html>
<?php
###########################################
# Connect to MySQL server and the database#
###########################################
require( 'includes/connect_db.php' ) ;

##########################
# Display header section.#
##########################
include ( 'includes/adminheader.html' ) ;

##################################
# Includes these helper functions#
##################################
require( 'includes/adminhelpers.php' ) ;

IF ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
		 $stuffID    = "" ;
		 $usertype    = "" ;
		 $usersID    = "" ;
		 $contact     = "" ;
		 $location    = "" ;
		 $description = "" ;
		 $limbodate    = "" ;
		 $status      = "" ;
}

IF ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
		$stuffID = $_POST['stuffID'] ;
		$usertype = $_POST['usertype'] ;
		$usersID = $_POST['usersID'] ;
		$contact = $_POST['contact'] ;
		$location = $_POST['location'] ;
		$description = $_POST['description'] ;
		$limbodate = $_POST['limbodate'] ;
		$status = $_POST['status'] ;

	
	  #Check to see if the usertype field is empty
	  IF(!valid_usertype($usertype))
      echo '<p style="color:red">Please let us know if you are the Owner/Finder.</p>' ;
	   	  
      #Check to see if the location field is empty
	  ELSE IF (!valid_location($location))
      echo '<p style="color:red">Please give the location ID.</p>' ;

	  #Check to see if the description field is empty
	  ELSE IF (!valid_description($description))
      echo '<p style="color:red">Please describe the stuff you lost/found.</p>' ;

      #Check to see if the date field is empty
	  ELSE IF (!valid_limbodate($limbodate))
      echo '<p style="color:red">When did you Find/Lose the item ?</p>';

		
	  #Check to see if the status is empty
	  ELSE IF (!valid_status($status))
      echo '<p style="color:red">Please give the location ID.</p>' ;
##################################################################
#If none of the required forms are empty then insert the records #
##################################################################
	  IF(!empty($usertype) && !empty($location) 
         && !empty($description) && !empty($status)) {
      $result = insert_record($dbc, $usertype, $contact, $location, $description, $limbodate, $status) ;
 



 }
}


################################################################
# If GET user either a) opened the page **or** b) clicked link #
################################################################
ELSE IF($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	IF(isset($_GET['id']))
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
show_form($usertype, $contact, $location, $description, $limbodate, $status ) ;

function show_form($usertype, $contact, $location, $description, $limbodate, $status ){

echo '<div><h1>Report A Lost or Found Item</h1></div>';
echo '<form action="linkylimbo.php" method="POST">' ;
echo '<table>';

###########################################
# Radio Buttons to Select Owner or Finder #
###########################################
echo '<p><u><b>Did you lose or find an item ?</u></b></P>';
echo '<tr>';
echo '<p>Select if you are the owner of the lost item: <input type="radio" name="usertype" value="Owner"> </p> ' ;
echo '<p>Select if you found an item that was lost: <input type="radio" name="usertype" value="Finder"> </p> ' ;
echo '</tr>';

#######################
#Contact Info TextBox #
#######################
echo '<p><u><b>How can you be contacted?</u></b></P>';
echo '<tr>';
echo '<p>Enter your email or phone number: <input type="text" name="contact" value="' . $contact . '"> </p> ' ;
echo '</tr>';

######################################
# drop down list for locations entry #
######################################
echo '<p><b><u>Location Selection:</u></b></p>' ;

echo '<select name="location" value="' . $location . '"> ';
echo '<option></option> ' ;

echo '<option  name="location" value="Byrne House">Byrne House</option> ' ;
echo '<option  name="location" value="Champagnat Hall">Champagnat Hall</option>' ;
echo '<option  name="location" value="Cornell Boathouse">Cornell Boathouse</option>' ;
echo '<option  name="location" value="Donnely Hall">Donnely Hall</option>' ;
echo '<option  name="location" value="Fern Tor">Fern Tor</option>' ;
echo '<option  name="location" value="Fontaine Annex">Fontaine Annex</option>' ;
echo '<option  name="location" value="Fontaine Hall">Fontaine Hall</option>' ;
echo '<option  name="location" value="Foy Townhouses">Foy Townhouses</option>' ;
echo '<option  name="location" value="Fulton Street Townhouses">Fulton Street Townhouses</option>' ;
echo '<option  name="location" value="Gartland Commons">Gartland Commons</option>' ;
echo '<option  name="location" value="Greystone Hall">Greystone Hall</option>' ;
echo '<option  name="location" value="Hancock Center">Hancock Center</option>' ;
echo '<option  name="location" value="Kiernan Gatehouse">Kiernan Gatehouse</option>' ;
echo '<option  name="location" value="Leo Hall">Leo Hall</option>' ;
echo '<option  name="location" value="James A. Cannavino Library">James A. Cannavino Library</option>' ;
echo '<option  name="location" value="James J. McCann Recreational Center">James J. McCann Recreational Center</option>' ;
echo '<option  name="location" value="Longview Park">Longview Park</option>' ;
echo '<option  name="location" value="Lower West Cedar Townhouses">Lower West Cedar Townhouses</option>' ;
echo '<option  name="location" value="Lowell Thomas Communications Center">Lowell Thomas Communications Center</option>' ;
echo '<option  name="location" value="Margaret M. and Charles H. Dyson Center">Margaret M. and Charles H. Dyson Center</option>' ;
echo '<option  name="location" value="Marian Hall">Marian Hall</option>' ;
echo '<option  name="location" value="Marist Boathouse">Marist Boathouse</option>' ;
echo '<option  name="location" value="Midrise Hall">Midrise Hall</option>' ;
echo '<option  name="location" value="New Fulton Townhouses">New Fulton Townhouses</option>' ;
echo '<option  name="location" value="New Townhouses">New Townhouses</option>' ;
echo '<option  name="location" value="Our Lady Seat of Wisdom Chapel">Our Lady Seat of Wisdom Chapel</option>' ;
echo '<option  name="location" value="St. Anns Hermitage">St. Anns Hermitage</option>' ;
echo '<option  name="location" value="St. Peters">St. Peters</option>' ;
echo '<option  name="location" value="Sheahan Hall">Sheahan Hall</option>' ;
echo '<option  name="location" value="Steel Plant Art Studios">Steel Plant Art Studios</option>' ;
echo '<option  name="location" value="Student Center/Rotunda">Student Center/Rotunda</option>' ;
echo '<option  name="location" value="Tenney Stadium">Tenney Stadium</option>' ;
echo '<option  name="location" value="Tennis Pavillion">Tennis Pavillion</option>' ;
echo '<option  name="location" value="Upper West Cedar Townhouses">Upper West Cedar Townhouses</option>' ;

echo '</select>';


#######################
# Description TextBox #
#######################
echo '<p><u><b>Description of Stuff:</u></b></P>';
echo '<tr>';
echo '<p>Description: <input type="text" name="description" value="' . $description . '"> </p> ' ;
echo '</tr>';

###########
#date lost#
###########
echo '<p><u><b>When was the item Lost or Found?</u></b></p>';
echo '<p><input type="date" name="limbodate" value="' . $limbodate . '"></p>';


##################################
# Radio Buttons to Select Status #
##################################

echo '<p>What is the status of the item?<br> ';
echo '<input type="checkbox" name="status" value="Lost">Lost<br> ';
echo '<input type="checkbox" name="status" value="Found">Found<br>';
echo '<input type="checkbox" name="status" value="Claimed">Claimed<br>';
echo '</p>';

#################
# Submit Button #
#################
echo '</table>';
echo '<p><input type="submit" ></p> ';
echo '</form>';

}
#######################
# Refreshes the page. #
#######################
echo '<br><A HREF="javascript:history.go(0)">Click to refresh the page</A></p>' ;

?>
</html>
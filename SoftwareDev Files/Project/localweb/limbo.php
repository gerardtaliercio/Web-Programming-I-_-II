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
include ( 'includes/header.html' ) ;
##################
# Create a query #
##################
$query = 'SELECT * 
          FROM limbostuff 
		  ORDER BY stuffID ASC' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  echo '<H1>All things that are in Limbo</H1>' ;
  echo '<TABLE border="1">';
  echo '<TR>';
  echo '<TH>Stuff ID</TH>';
  echo '<TH>Posted By</TH>';
  echo '<TH>Contact Info</TH>';
  echo '<TH>Location Name</TH>';
  echo '<TH>Description of Stuff</TH>';  
  echo '<TH>Date Lost or Found</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['stuffID'] . '</TD>' ;
    echo '<TD>' . $row['usertype'] . '</TD>' ;
	echo '<TD>' . $row['contact'] . '</TD>' ;
	echo '<TD>' . $row['location'] . '</TD>' ;
    echo '<TD>' . $row['description'] . '</TD>' ;
	echo '<TD>' . $row['limbodate'] . '</TD>' ;
	echo '<TD>' . $row['status'] . '</TD>' ;
    echo '</TR>' ;
  }

  # End the table
  echo '</TABLE>';

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# Close the connection
mysqli_close( $dbc ) ;

#Refreshes the page
echo '<br><A HREF="javascript:history.go(0)">Click to refresh the page</A></p>' ;
?>
</html>
<!--
Gerard Taliercio & Noca Kocovic
-->

<?php
$debug = true;

# CHECKS IF THERE IS A VALID NUMBER
#function valid_number($number) {

#		IF(empty($number) || !is_numeric($number))
#		return false ;

#		ELSE {
#		$number = intval($number) ;

#		IF($number <= 0)
#		return false ;
#		}
#	return true ;
#}


#######################################
# CHECKS IF THERE IS A VALID USERTYPE #
#######################################
function valid_usertype($usertype) {
    return !empty($usertype) ;
	}
######################################
# CHECKS IF THERE IS VALID LOCATION  #
######################################
function valid_location($location) {
    return !empty($location) ;
	}
	
#########################################
# CHECKS IF THERE IS VALID description  #
#########################################
function valid_description($description) {
    return !empty($description) ;
	}	
	
#########################################
# CHECKS IF THERE IS VALID description  #
#########################################
function valid_limbodate($limbodate) {
    return !empty($limbodate) ;
	}	
	
######################################
# CHECKS IF THERE IS VALID STATUS    #
######################################
function valid_status($status) {
    return !empty($status) ;
	}
	
########################
# SHOW RECORD FUNCTION #
########################

function show_record($dbc, $stuffID) {
    
    $query = 'SELECT * 
	          FROM limbostuff
			  WHERE stuffID = ' . $stuffID;

    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

	IF( $results )
    {
        echo '<H1>Stuff Details</H1>' ;
        echo '<TABLE border="1">';
        echo '<TR>';
        echo '<TH>Stuff ID</TH>';
        echo '<TH>Posted By</TH>';
        echo '<TH>Contact Info</TH>';
        echo '<TH>Location Name</TH>';
        echo '<TH>Description of Stuff</TH>';  
        echo '<TH>Date Lost or Found</TH>';
		echo '<TH>Status</TH>';
        echo '</TR>';

        IF ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
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
		echo '<HR>' ;

        # Free up the results in memory
        mysqli_free_result( $results ) ;
    }
}

##############################
# SHOW LINK RECORDS FUNCTION #
##############################

function show_link_records($dbc) {
    # Create a query to get just about everything from limbostuff
    $query = 'SELECT stuffID, usertype, contact, location, description, limbodate, status
	          FROM limbostuff
			  ORDER BY stuffID ASC';

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

    # Show results
    IF( $results )
    {
		echo 'Click on the ID link for more detail.<BR>' ;
 
        echo '<H1>Stuff In Limbo</H1>' ;
        echo '<TABLE border="1">';
        echo '<TR>';
        echo '<TH>Stuff ID</TH>';
        echo '<TH>Posted By</TH>';
        echo '<TH>Contact Info</TH>';
        echo '<TH>Location Name</TH>';
        echo '<TH>Description of Stuff</TH>';  
        echo '<TH>Date Lost or Found</TH>';
		echo '<TH>Status</TH>';
        echo '</TR>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
			$alink = '<A HREF=linkylimbo.php?id=' . $row['stuffID'] . '>' . $row['stuffID'] . '</A>' ;
            
            echo '<TR>' ;
            echo '<TD>' . $alink . '</TD>' ;
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
}

#########################
# SHOW RECORDS FUNCTION #
#########################	
	
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT stuffID, usertype, contact, location, description, limbodate, status
	          FROM limbostuff
			  ORDER BY stuffID ASC';

			# Execute the query
			$results = mysqli_query( $dbc , $query ) ;
			check_results($results) ;

					# Show results
					IF( $results )
					{
					  # But...wait until we know the query succeeded before
					  # starting the table.
		             echo 'Click on id for more detail.<BR>' ;
                     echo '<H1>Stuff In Limbo</H1>' ;
                     echo '<TABLE border="1">';
                     echo '<TR>';
                     echo '<TH>Stuff ID</TH>';
                     echo '<TH>Posted By</TH>';
                     echo '<TH>Contact Info</TH>';
                     echo '<TH>Location Name</TH>';
                     echo '<TH>Description of Stuff</TH>';  
                     echo '<TH>Date Lost or Found</TH>';
					 echo '<TH>Status</TH>';
                     echo '</TR>';

					  # For each row result, generate a table row
					  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
					  {
                       echo '<TR>' ;
                       echo '<TD>' . $row['stuffID'] . '</TD>' ;
                       echo '<TD>' . $row['usertype'] . '</TD>' ;
	                   echo '<TD>' . $row['contact'] . '</TD>' ;
	                   echo '<TD>' . $row['locationsID'] . '</TD>' ;
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
}
	


##############################################
# Inserts a record into the limbostuff table #
##############################################

function insert_record($dbc, $usertype, $contact, $location,
                       $description, $limbodate, $status) {
  $query = 'INSERT INTO limbostuff(usertype, contact, location, 
                                   description, limbodate, status) 
			VALUES ("' . $usertype .    '" , 
			        "' . $contact .      '", 
			        "' . $location .    '" ,
                    "' . $description . '" ,
                    "' . $limbodate .   '" , 					
					"' . $status .      '" )' ;
  
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
	}

######################################
# Shows the query as a debugging aid #
######################################

function show_query($query) {
  global $debug;

  IF($debug)
    echo "<p>Query = $query</p>" ;
}

###############################################
# Checks the query results as a debugging aid #
###############################################

function check_results($results) {
  global $dbc;

  IF($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;

}
?>
<?php
$debug = true;

# CHECKS IF THERE IS A VALID NUMBER
function valid_number($number) {

		IF(empty($number) || !is_numeric($number))
		return false ;

		ELSE {
		$number = intval($number) ;

		IF($number <= 0)
		return false ;
		}
	return true ;
}

# CHECKS IF THERE IS A VALID FIRST NAME
function valid_fname($fname) {
    return !empty($fname) ;
	}

# CHECKS IF THERE IS VALID LAST NAME
function valid_lname($lname) {
    return !empty($lname) ;
	}
	
########################
# SHOW RECORD FUNCTION #
########################

function show_record($dbc, $id) {
    
    $query = 'SELECT id, lname, fname 
	          FROM presidents
			  WHERE id = ' . $id;

    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

	IF( $results )
    {
        echo '<H1>Dead Presidents</H1>' ;
        echo '<TABLE border="1">';
        echo '<TR>';
        echo '<TH ALIGN=right>ID</TH>';
        echo '<TH ALIGN=left>First Name</TH>';
        echo '<TH ALIGN=right>Last Name</TH>';
        echo '</TR>';

        IF ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
            echo '<TR>' ;
            echo '<TD ALIGN=right>' . $row['id'] . '</TD>' ;
            echo '<TD ALIGN=left>' . $row['fname'] . '</TD>' ;
            echo '<TD ALIGN=right>' . $row['lname'] . '</TD>' ;
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
    # Create a query to get the id and lname from presidents
    $query = 'SELECT id, lname 
	          FROM presidents
			  ORDER BY lname DESC';

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

    # Show results
    IF( $results )
    {
        echo '<H1>Dead Presidents</H1>' ;
		echo 'Click on id for more detail.<BR>' ;
        echo '<TABLE border="1">';
        echo '<TR>';
        echo '<TH>ID</TH>';
       # echo '<TH>First Name</TH>';
        echo '<TH>Last Name</TH>';
        echo '</TR>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
			$alink = '<A HREF=linkypresidents.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;

			echo '<TR>' ;
			echo '<TD ALIGN=right>' . $alink . '</TD>' ;
#           echo '<TD ALIGN=right>' . $row['number'] . '</TD>' ;
#           echo '<TD ALIGN=left>' . $row['fname'] . '</TD>' ;
            echo '<TD ALIGN=left>' . $row['lname'] . '</TD>' ;
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
	$query = 'SELECT id, fname, lname 
			  FROM presidents 
			  ORDER BY lname ASC' ;

			# Execute the query
			$results = mysqli_query( $dbc , $query ) ;
			check_results($results) ;

					# Show results
					IF( $results )
					{
					  # But...wait until we know the query succeeded before
					  # starting the table.
					  echo '<H1>Dead Presidents</H1>' ;
					  echo '<TABLE border="1">';
					  echo '<TR>';
					  echo '<TH>ID</TH>';
					  echo '<TH>First Name</TH>';
					  echo '<TH>Last Name</TH>';
					  echo '</TR>';

					  # For each row result, generate a table row
					  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
					  {
						echo '<TR>' ;
						echo '<TD ALIGN=right>' . $alink . '</TD>' ;
						echo '<TD>' . $row['fname'] . '</TD>' ;
						echo '<TD>' . $row['lname'] . '</TD>' ;
						echo '</TR>' ;
					  }

			  # End the table
			  echo '</TABLE>';

			  # Free up the results in memory
			  mysqli_free_result( $results ) ;
}
}
	


##############################################
# Inserts a record into the presidents table #
##############################################

function insert_record($dbc, $number, $fname, $lname) {
  $query = 'INSERT INTO presidents(number, fname, lname) 
			VALUES ("' . $number . '" , 
			        "' . $fname . '" , 
					"' . $lname . '" )' ;
  
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
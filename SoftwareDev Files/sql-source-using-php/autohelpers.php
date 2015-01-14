<?php
/*
This file contains PHP helper functions.
Orginally created by Ron Coleman.
History:
Who    Date        Comment
RC     3-Oct-13    Created.
RC    30-Oct-13    Added show_record and show_link_records.
RC    02-Dec-13    Added function to initialize the database.
RC    29-Apr-13    Copied from improved init function Stanley Yang (2013F).
*/

# Set this flag to false to disable debug diagnostics.
$debug = true;

# Initializes a database
function init($dbname){
    # Connect to the database, if we fail assume the DB doesnt exist
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname );

    if($dbc) {
        mysqli_set_charset( $dbc, 'utf8' ) ;

        return $dbc;
    }

    $dbc = @mysqli_connect ( 'localhost', 'root', '', '' );

    $query = 'CREATE DATABASE ' . $dbname;

    $results = mysqli_query($dbc, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbc );

    # Connect to the (newly created) database
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbc, 'utf8' ) ;

    $sql= file_get_contents('insert_data.sql');
    $results = mysqli_multi_query($dbc, $sql);
    mysqli_close( $dbc );

    # Ggives mysql some time to run through all the queries
    # If the database needs more time to load, then there are probably other problems with the computer
    sleep(1);

    # Recursive so I can guarantee a working connection
    return init($dbname);
}

# Shows exactly one record in prints.
function show_record($dbc,$id) {
    # Create a query to get the name and price sorted by price
    $query = 'SELECT id, name, price FROM prints WHERE id = ' . $id ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

    # Show results
    if( $results )
    {
          # But...wait until we know the query succeeded before
          # rendering the table start.
          echo '<H1>Prints detail</H1>' ;
          echo '<TABLE>';
          echo '<TR>';
          echo '<TH ALIGN=right>Id</TH>';
          echo '<TH ALIGN=left>Name</TH>';
          echo '<TH ALIGN=right>Price</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          # Output exactly one row
          if ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
          {
            echo '<TR BGCOLOR=#E0E0E0>' ;
            echo '<TD ALIGN=right>' . $row['id'] . '</TD>' ;
            echo '<TD ALIGN=left>' . $row['name'] . '</TD>' ;
            echo '<TD ALIGN=right>' . $row['price'] . '</TD>' ;
            echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';
          echo '<HR>' ;

          # Free up the results in memory
          mysqli_free_result( $results ) ;
    }
}

# Shows only the id and name in prints
function show_link_records($dbc) {
    # Create a query to get the name and price sorted by price
    $query = 'SELECT id, name FROM prints ORDER BY id DESC' ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

    # Show results
    if( $results )
    {
          # But...wait until we know the query succeeded before
          # rendering the table start.
          echo '<H1>Prints summary</H1>' ;
          echo 'Click an id for more detail.<BR>' ;
          echo '<TABLE>';
          echo '<TR>';
          echo '<TH ALIGN=right>Id</TH>';
          echo '<TH ALIGN=left>Name</TH>';
          echo '</TR>';

          # For each row result, generate a table row with a hyperlink for more detail
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
          {
              # Build the hyperlink
              $alink = '<A HREF=linkprints.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;

            # Put the hypelink in the table
            echo '<TR>' ;
            echo '<TD ALIGN=right>' . $alink . '</TD>' ;
            #echo '<TD>' . $row['id'] . '</TD>' ;
            echo '<TD>' . $row['name'] . '</TD>' ;
            echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
    }
}

# Shows the records in prints
function show_records($dbc) {
    # Create a query to get the name and price sorted by price
    $query = 'SELECT name, price FROM prints ORDER BY price ASC' ;

    # Execute the query
    $results = mysqli_query( $dbc , $query ) ;
    check_results($results) ;

    # Show results
    if( $results )
    {
          # But...wait until we know the query succeeded before
          # rendering the table start.
          echo '<H1>Prints</H1>' ;
          echo '<TABLE>';
          echo '<TR>';
          echo '<TH>Name</TH>';
          echo '<TH>Price</TH>';
          echo '</TR>';

          # For each row result, generate a table row
          while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
          {
            echo '<TR>' ;
            echo '<TD>' . $row['name'] . '</TD>' ;
            echo '<TD>' . $row['price'] . '</TD>' ;
            echo '</TR>' ;
          }

          # End the table
          echo '</TABLE>';

          # Free up the results in memory
          mysqli_free_result( $results ) ;
    }
}

# Inserts a record into the prints table
function insert_record($dbc, $name, $price) {
  $query = 'INSERT INTO prints(name, price) VALUES ("' . $name . '" , ' . $price . ' )' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}
?>
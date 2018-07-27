<?php
 header("Access-Control-Allow-Origin: *");
//include database connection
include 'dbconfig.php';
//$mysqli->real_escape_string() function helps us prevent attacks such as SQL injection
$query = "SELECT * FROM movie
        WHERE title LIKE '%".$mysqli->real_escape_string($_GET['query'])."%'";
        //echo $_GET['budget'];
        if(isset($_GET['summary']))
        {
            $query .= "AND summary LIKE '%".$mysqli->real_escape_string($_GET['query'])."%'";
        }
        if(isset($_GET['budget']))
        {
            $query .= "AND budget <= '".$mysqli->real_escape_string($_GET['budget'])."'";
        }
        if(isset($_GET['rating']))
        {
            $query .= "AND rating LIKE '%".$mysqli->real_escape_string($_GET['rating'])."%'";
        }
//echo $query;
//execute the query
if( $mysqli->query($query) ) {
 $result = $mysqli->query( $query );
//get number of rows returned
$num_results = $result->num_rows;
if( $num_results > 0){ //it means there's already at least one database record

    //loop to show each records
    $numLeft = $num_results;
    $myJson = '{"Movies": [';
    while( $row = $result->fetch_assoc() ){

        //this will make $row['firstname'] to
        //just $firstname only
        extract($row);
        
        //creating new table row per record
        $myJson .= '{';
            $myJson .= '"Title":'.'"'.$title.'"'.',';
            $myJson .= '"Release":'.'"'.$release_date.'"'.',';
            $myJson .= '"Rating":'.'"'.$rating.'"'.',';
            $myJson .= '"Length":'.'"'.$LENGTH.'"'.',';
            $myJson .= '"Tagline":'.'"'.$tagline.'"'.',';
            $myJson .= '"Summary":'.'"'.$summary.'"'.',';
            $myJson .= '"Budget":'.'"'.$budget.'"';
            $myJson .= '}';
            if($numLeft > 1)
            {
                $myJson .= ',';
            }
            else
            {
                $myJson .= ']}';
            }
            $numLeft = $numLeft - 1;
    }
    echo $myJson;
}else{
    $myJson = '{"info": "No results found"}';
        echo $myJson;
}
//disconnect from database
$result->free();
$mysqli->close();
    exit();
}else{
    //if unable to create new record
    echo $query;
    echo "Database Error: Unable to retrieve records.";
}
//close database connection
$mysqli->close();
?>

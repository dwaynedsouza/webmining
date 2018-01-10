<?php session_start();


if( !empty($_POST["id"])) {
require_once("dbcontroller.php");
$db_handle = new DBController();


$j_id=$_POST['id'];
$ee_id=$_SESSION['eeid'];
$rating=$_POST['rating'];



$result = mysql_query("SELECT * FROM rating WHERE j_id ='$j_id' AND  ee_id ='$ee_id' ");

if( mysql_num_rows($result) > 0) {
    mysql_query("UPDATE rating SET rating = '$rating' WHERE j_id ='$j_id' AND  ee_id ='$ee_id' ");
}
else
{
    mysql_query("INSERT INTO rating (ee_id,j_id,rating) VALUES ('$ee_id','$j_id','$rating') ");
}
}




$link=mysql_connect("localhost","jobscope","riddhi") or die("cant connect");
	mysql_select_db("jobscope",$link) or die("cant select db");

	$itemID=$_POST['id'];
$userID=$_SESSION['eeid'];

// Get all of the user's rating pairs
$sql = "SELECT DISTINCT r.j_id, r2.rating - r.rating 
            as rating_difference
            FROM rating r, rating r2
            WHERE r.ee_id=$userID AND 
                    r2.j_id=$itemID AND 
                    r2.ee_id=$userID;";
$db_result = mysql_query($sql, $link);
$num_rows = mysql_num_rows($db_result);
//For every one of the user's rating pairs, 
//update the dev table
while ($row = mysql_fetch_assoc($db_result)) {
    $other_itemID = $row["j_id"];
    $rating_difference = $row["rating_difference"];
    //if the pair ($itemID, $other_itemID) is already in the dev table
    //then we want to update 2 rows.
    if (mysql_num_rows(mysql_query("SELECT itemID1 
    FROM dev WHERE itemID1=$itemID AND itemID2=$other_itemID",
    $link)) > 0)  {
        $sql = "UPDATE dev SET count=count+1, 
	sum=sum+$rating_difference WHERE itemID1=$itemID 
	AND itemID2=$other_itemID";
        mysql_query($sql, $link);
	//We only want to update if the items are different                
        if ($itemID != $other_itemID) {
            $sql = "UPDATE dev SET count=count+1, 
	    sum=sum-$rating_difference 
	    WHERE (itemID1=$other_itemID AND itemID2=$itemID)";
            mysql_query($sql, $link);
        }
    }
    else { //we want to insert 2 rows into the dev table
        $sql = "INSERT INTO dev VALUES ($itemID, $other_itemID,
        1, $rating_difference)";
        mysql_query($sql, $link); 
	//We only want to insert if the items are different       
        if ($itemID != $other_itemID) {         
            $sql = "INSERT INTO dev VALUES ($other_itemID, 
	    $itemID, 1, -$rating_difference)";
            mysql_query($sql, $link);
        }
    }    
}

?>
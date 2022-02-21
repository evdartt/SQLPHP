<!DOCTYPE html>
<html>
<body>
<h2> Group 61 I308 Final Project Queries </h2>

<!--FORM FOR QUERY 1B--> 

<form action="query1b.php" method="post">
<p><h3>1b. Produce a class roster for a *specified section* sorted by student’s last name, first name. <br> At the end, include the average grade (GPA for the class.)- 10 points</h3></p>
<p><small>Please select the section number you would like the class roster for:</small></p>
Section: <select name="SectionID">
<?php
$con = mysqli_connect("db.sice.indiana.edu","i308s19_team61","my+sql=i308s19_team61","i308s19_team61");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{echo nl2br("Established Database Connection \n");}
		
$result = mysqli_query($con, "SELECT SectionID FROM tp_Section ORDER BY SectionID ASC;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($SectionID);
                  $SectionID = $row['SectionID']; 
                  echo '<option value="' . $SectionID . '">' . $SectionID . '</option>';
}


?>
 </select><br><br>
<input type="submit" name="Submit_q1b" value="Submit Query 1b">
</form>

<!--FORM FOR QUERY 2A-->

<form action="query2a.php" method="post">
<p><h3>2a. Produce a list of rooms that are equipped with *some feature*. - 5 points</h3></p>
<p><small>Please select which feature you would like to base your results on</small></p>
Feature: <select name="Feature">

<?php
$con = mysqli_connect("db.sice.indiana.edu","i308s19_team61","my+sql=i308s19_team61","i308s19_team61");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{echo nl2br("Established Database Connection \n");}

$result = mysqli_query($con, "SELECT Feature FROM tp_RoomFeature GROUP BY Feature ORDER BY Feature ASC;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($Feature);
                  $Feature = $row['Feature']; 
				  echo '<option value="' . $Feature . '">' . $Feature . '</option>';}
?>  
 </select><br><br>
<input type="submit" name="Submit_q2a" value="Submit Query 2a">
</form>

<!--FORM FOR QUERY 3B-->

<form action="query3b.php" method="post">
<p><h3>3b. Produce a list of faculty who have never taught a *specified course*. -10 points</h3></p>
<p><small>Please select which course you would like to base your results on</small></p>
Course: <select name="form-CourseNumber">

<?php
$con = mysqli_connect("db.sice.indiana.edu","i308s19_team61","my+sql=i308s19_team61","i308s19_team61");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{echo nl2br("Established Database Connection \n");}

$result = mysqli_query($con, "SELECT CourseNumber FROM tp_Course ORDER BY CourseNumber ASC;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($CourseNumber);
                  $CourseNumber = $row['CourseNumber'];
				  echo '<option value="' . $CourseNumber . '">' . $CourseNumber . '</option>';}
?>  
 </select><br><br>
<input type="submit" name="Submit_q3b" value="Submit Query 3b">
</form>

<!--FORM FOR QUERY 5A-->

<form action="query5a.php" method="post">
<p><h3>5a. Produce a chronological list (transcript-like) of all courses taken by a *specified student*.<br>Show grades earned.- 5 points</h3></p>
<p><small>Please select which student you would like to base your results on</small></p>
Student: <select name="StudentID">

<?php
$con = mysqli_connect("db.sice.indiana.edu","i308s19_team61","my+sql=i308s19_team61","i308s19_team61");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{echo nl2br("Established Database Connection \n");}

$result = mysqli_query($con, "SELECT sid FROM tp_Student ORDER BY sid ASC;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($StudentID);
                  $StudentID = $row['sid'];
				  echo '<option value="' . $StudentID . '">' . $StudentID . '</option>';}
?>  
 </select><br><br>
<input type="submit" name="Submit_q5a" value="Submit Query 5a">
</form>

<!--FORM FOR QUERY 7A-->

<form action="query7a.php" method="post">
<p><h3>7a.Produce an alphabetical list of students with their majors who are advised by a *specified advisor*. - 5 points </h3></p>
<p><small>Please select which advisor you would like to base your results on</small></p>
Advisor: <select name="Advisor">

<?php
$con = mysqli_connect("db.sice.indiana.edu","i308s19_team61","my+sql=i308s19_team61","i308s19_team61");
// Check connection
if (!$con)
	{die("Failed to connect to MySQL: " . mysqli_connect_error()); }
else 
	{echo nl2br("Established Database Connection \n");}

$result = mysqli_query($con, "SELECT AdvisorID FROM tp_Advisor ORDER BY AdvisorID ASC;");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($Advisor);
                  $Advisor = $row['AdvisorID'];
				  echo '<option value="' . $Advisor . '">' . $Advisor . '</option>';}
?>  
 </select><br>
 <p><small>Hint: AdvisorID '1' produces the most results</small></p>
<input type="submit" name="Submit_q7a" value="Submit Query 7a">
</form>

<!--FORM FOR QUERY 9C-->

<form action="query9c.php" method="post">
<p><h3>9c. Produce a list of students with hours earned and overall GPA who have met the graduation requirements for any major. Sort by major and then by student. - 15 points</h3></p>

<input type="submit" name="Submit_q9c" value="Submit Query 9c">
</form>

<!--FORM FOR ADDITIONAL QUERY 1-->

<form action="querya1.php" method="post">
<p><h3>Additional Query 1: Display the name of Faculty that work in rooms with greater than 300 capacity with RoomID and Building name included. - 5 points</h3></p>

<input type="submit" name="Submit_qa1" value="Submit Additional Query 1">
</form>

<!--FORM FOR ADDITIONAL QUERY 2-->

<form action="querya2.php" method="post">
<p><h3>Additional Query 2: Display all students names with last name starting with 'D', their advisor and adv's expertise</h3></p>

<input type="submit" name="Submit_qa2" value="Submit Additional Query 2">
</form>



</body>
</html>

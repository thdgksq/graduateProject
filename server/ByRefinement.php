<?php

header("Content-Type: text/html; charset=UTF-8");
$con = mysqli_connect("localhost", "thdgksq", "kjhpro159357", "thdgksq");

$usesrID = $_GET["userID"];

$result = mysqli_query($con, "SELECT course.courseID, course.courseGrade, course.courseTitle, course.courseProfessor, course.courseCredit, course.coursePersonnel, course.courseTime FROM schedule, course WHERE course.courseID = schedule.courseID AND course.courseArea = '교양및기타' GROUP BY schedule.courseID ORDER BY COUNT(schedule.courseID) DESC LIMIT 5;");

$response = array();

while($row = mysqli_fetch_array($result)){
    array_push($response, array("courseID"=>$row[0], "courseGrade"=>$row[1], "courseTitle"=>$row[2], "courseProfessor"=>$row[3], "courseCredit"=>$row[4], "coursePersonnel"=>$row[5], "courseTime"=>$row[6]));
}

echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
mysqli_close($con);

?>
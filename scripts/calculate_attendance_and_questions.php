<?php
//connection
require_once('./../includes/db_connection.php');



 //=========================================================



				$sql = "SELECT Prabhag_No ,SUM(Questions) AS Questions,AVG(Atendance_Percentage) As Atendance_Percentage FROM `attendance` GROUP BY Prabhag_No";
				$result = mysqli_query($con,$sql);
				while ($row = mysqli_fetch_array($result)) 
				{
    		
    		
    						$fieldVal1= $row['Questions'];
    						$fieldVal2= round($row['Atendance_Percentage'],2);
							


    						$sql = "UPDATE nagarsevak SET 
    										Total_Questions = '". $fieldVal1 ."', 
    										Avg_Attendance = '". $fieldVal2 ."'
    						                where Prabhag_No = '".$row['Prabhag_No']."' ";
    	

    	   					if(!mysqli_query($con, $sql))
    		   				{
         							die('Error : ' . mysqli_error($con));
    		   				}
     			}
     	
?>
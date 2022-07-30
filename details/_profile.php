<?php
    $row = [];
    $query = "SELECT Prabhag_No, Nagarsevak_Name, Party, Total_Questions, Avg_Attendance, Criminal_Records, Municipal_Committee FROM nagarsevak WHERE Prabhag_No = '" . $prabhag . "' ORDER BY Prabhag_No";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    }
?>

<div class="row">
    <div class="col-md-4 text-center">
        <?php
            $url = 'assets/images/photos/'. $row["Prabhag_No"] . '.jpg';
            if(!file_get_contents(SITE_URL . $url)){
                $url = 'assets/images/photos/'. $row["Prabhag_No"] . '.jpeg';
                if(!file_get_contents(SITE_URL . $url)){
                    $url = 'assets/images/profile_pic.png';
                }
            }
        ?>
        <img style='width:100px; height: 125px; margin-bottom:10px; ' src="<?=SITE_URL . $url; ?>">
        <table class='table table-bordered table-striped'>
            <tr><td colspan="2"><strong><?=$row['Nagarsevak_Name']; ?></strong></td></tr>
            <tr><td>Political Party</td><td><?=$row["Party"]; ?></td></tr>
        </table>
    </div> 
    <div class="col-md-8">
        
        <table class='table table-bordered table-striped1'>
            <tr><td>Prabhag No</td><td><?=$row["Prabhag_No"]; ?></td></tr>
            <tr>
                <td>No. of Questions asked in GB meetings</td>
                <td>
                    <?php
                        $query = "SELECT (SUM(Total_Questions)/(SELECT COUNT(id) FROM nagarsevak)) as cw_avg FROM nagarsevak";
                        $result = mysqli_query($con, $query);
                        $cw_row = mysqli_fetch_assoc($result);
                    ?>
                    <?=$row['Total_Questions']; ?> 
                    <span style="margin-left:10px;">(City-wide avg is <?=round($cw_row["cw_avg"], 2); ?>)</d>
                </td>
            </tr>
            <tr>
                <td>Attendance in GB meetings</td>
                <td>
                    <?php
                        $query = "SELECT (SUM(Avg_Attendance)/(SELECT COUNT(id) FROM nagarsevak)) as cw_avg FROM nagarsevak";
                        $result = mysqli_query($con, $query);
                        $cw_row = mysqli_fetch_assoc($result);
                    ?>
                    <?=$row['Avg_Attendance']; ?> % 
                    <span style="margin-left:10px;">(City-wide avg is <?=round($cw_row["cw_avg"], 2); ?>)</d>
                </td>
            </tr>
            <tr><td>Served on any Municipal Committee?</td><td><?php echo $row['Municipal_Committee'] ? $row['Municipal_Committee'] : "None"; ?></td></tr>
            <tr><td>Criminal charges filed?</td><td><?php echo "Data not provided by Govt."; // $row['Criminal_Records']; ?></td></tr>
        </table>
    </div>
    
</div>
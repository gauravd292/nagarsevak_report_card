<div class='<?=$config["class_name"]; ?> text-center'>
    <img style='width:100px; height: 125px;' src="<?=SITE_URL.'assets/images/photos/'. $row["Prabhag_No"] . '.jpg'; ?>">
    <div class='nagarsevak-name'><?=$row['Nagarsevak_Name']; ?></div>

    <table class='table table-bordered table-striped nagarsevak-short-info'>
        <colgroup> <col style='width:70%;'> <col style='width:30%;'> </colgroup>
        <tr><td>Prabhag No</td><td><?=$row["Prabhag_No"]; ?></td></tr>
        <tr><td>Political Party</td><td><?=$row['Party']; ?></td></tr>
        <tr><td>No. of Questions asked in GB meetings</td><td><?=$row['Total_Questions']; ?></td></tr>
        <tr><td>Attendance in GB meetings</td><td><?=$row['Avg_Attendance']; ?> % </td></tr>
        <tr><td>Criminal charges filed?</td><td><?=$row['Criminal_Records']; ?></td></tr>
    </table>
</div>
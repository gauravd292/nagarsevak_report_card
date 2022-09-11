<div class='<?=$config["class_name"]; ?> section'>
    <div class='text-center'><h3><?=$prabhag . " - " . $person_info["Nagarsevak_Name"] . " (". $person_info["Party"] .")"; ?></h3></div><br>
    <div class='text-center'><h4> <strong> Ward Level </strong></h4></div>
    <div class="data table-responsive ward-level"><?php echo json_encode($chart_data); ?></div>
    <div class='text-center'><h4> <strong> S-List </strong></h4></div>
    <div class="data table-responsive s-list"><?php echo json_encode($s_list_chart_data); ?></div>
</div>
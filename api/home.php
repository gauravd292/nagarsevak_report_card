<?php
    require_once('../_config.php');

    $q = $_GET["q"];

    $function_name = $q;
    call_user_func_array($function_name, array($con));

    function _get_block_config($con, $prabhag_num, $from = "")
    {
        $list = ["A", "B", "C", "D"];

        $p_list = [];
        foreach(range("A", "D") as $lbl) $p_list[] = '"' . (int)$prabhag_num . $lbl . '"';
        $p_list = $p_list ? implode(",", $p_list) : 0;
        
        $letters = [];

        $query = "SELECT * FROM nagarsevak WHERE Prabhag_No IN ({$p_list}) ORDER BY Prabhag_No";
        $result = mysqli_query($con, $query);
        
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $letters[] = $row["Prabhag_No"][strlen($row["Prabhag_No"])-1];
            }
        }

        $class_name = "";
        switch (count($letters)) {
            case 1:
                $class_name = "col-sm-6 col-md-4 block_1";
                break;
            case 2:
                $class_name = "col-sm-6 col-md-6 block_2";
                break;
            case 3:
                $class_name = "col-sm-6 col-md-4 block_3";
                break;
            case 4:
                $class_name = "col-sm-6 col-md-3 block_4";
                break;
        }

        return ([
            "letters" => $letters,
            "count" => count($letters),
            "class_name" => $class_name,
        ]);
    }

    function prabhag_no_info($con)
    {
        $prabhag_num = $_POST["i"];
        $query = "SELECT Prabhag_Name, Ward_ofc FROM nagarsevak WHERE Prabhag_No = '" . $prabhag_num . "'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        include("html/prabhag_no_info.php");
    }

    function profile_info($con)
    {
        $prabhag_num = $_POST["i"];

        $config = _get_block_config($con, $prabhag_num);

        $list = ["A", "B", "C", "D"];

        foreach($list as $lbl)
        {
            if(!in_array($lbl, $config["letters"])){
                continue;
            }

            $prabhag = $prabhag_num . $lbl;

            $query = "SELECT Prabhag_No, Nagarsevak_Name, Party, Total_Questions, Avg_Attendance, Criminal_Records, Municipal_Committee FROM nagarsevak WHERE Prabhag_No = '" . $prabhag . "' ORDER BY Prabhag_No";
            $result = mysqli_query($con, $query);
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    include("html/profile_info.php");
                }
            }
        }
    }

    function details_of_work($con)
    {
        $prabhag_num = $_POST["i"];

        $config = _get_block_config($con, $prabhag_num, "details_of_work");

        $list = ["A", "B", "C", "D"];

        foreach($list as $lbl)
        {
            if(!in_array($lbl, $config["letters"])){
                continue;
            }

            $prabhag = $prabhag_num . $lbl;

            $query = "SELECT Prabhag_No, Nagarsevak_Name, Party FROM nagarsevak WHERE Prabhag_No = '" . $prabhag . "'";
            $result = mysqli_query($con, $query);
            $person_info = mysqli_fetch_assoc($result);

            $data = [];
            $data_list = [];
            $query = "SELECT Year, SUM(Amount) as totalAmount FROM `work_details` WHERE Prabhag_No = '".$prabhag."' GROUP BY Year";
            $result = mysqli_query($con, $query);
            if ($result->num_rows > 0) 
            {
                while($row = mysqli_fetch_assoc($result)){
                    $data_list[$row["Year"]]["ward_level"] = $row;
                }
            }
            $query = "SELECT Year, SUM(Amount) as totalAmount FROM `s_list` WHERE Prabhag_No = '".$prabhag."' GROUP BY Year";
            $result = mysqli_query($con, $query);
            if ($result->num_rows > 0) 
            {
                while($row = mysqli_fetch_assoc($result)){
                    $data_list[$row["Year"]]["s_list"] = $row;
                }
            }

            $data = $data_list;

            include("html/details_of_work.php");
        }
    }

    function details_of_work_chart($con)
    {
        $prabhag_num = $_POST["i"];

        $config = _get_block_config($con, $prabhag_num);

        $list = ["A", "B", "C", "D"];

        foreach($list as $lbl)
        {
            if(!in_array($lbl, $config["letters"])){
                continue;
            }
            
            $prabhag = $prabhag_num . $lbl;

            $chart_data = [];

            $details_of_work = [];
            $amount = [];

            $query = "SELECT Code as Details_Of_Work, SUM(Amount) AS Amount, 'work_details' as list_type FROM `work_details` 
                WHERE Prabhag_No = '" . $prabhag . "' GROUP BY `Code` ORDER BY `Amount` DESC";
            $result = mysqli_query($con, $query);

            if($result->num_rows)
            {
                while($row = mysqli_fetch_assoc($result)) {
                    $details_of_work[] = $row['Details_Of_Work'];
                    $amount[] = $row['Amount'];
                }

                $total_amount = array_sum($amount);

                if(count($details_of_work) <= 7)
                {
                    for ($i=0; $i < count($details_of_work); $i++) { 
                        $chart_data[] = [
                            "name" => $details_of_work[$i],
                            "no_of_times" => $amount[$i],
                        ];
                    }
                }
                else
                {
                    $remaining_values = array_slice($amount, 7);
                    $remaining_total = array_sum($remaining_values);
                    
                    for($i=0; $i<7; $i++){
                        $chart_data[] = [
                            "name" => $details_of_work[$i],
                            "no_of_times" => $amount[$i],
                        ];
                    }
                    $chart_data[] = [
                        "name" => "Others",
                        "no_of_times" => $remaining_total,
                    ];
                }
            }

            $s_list_chart_data = _details_of_s_list_chart($con, $prabhag);

            $query = "SELECT Prabhag_No, Nagarsevak_Name, Party FROM nagarsevak WHERE Prabhag_No = '" . $prabhag . "'";
            $result = mysqli_query($con, $query);
            $person_info = mysqli_fetch_assoc($result);

            include("html/details_of_work_chart.php");
        }
    }

    function _details_of_s_list_chart($con, $prabhag)
    {
        $chart_data = [];

        $details_of_work = [];
        $amount = [];

        $query = "SELECT Code as Details_Of_Work, SUM(Amount) AS Amount, 's_list' as list_type FROM `s_list` 
            WHERE Prabhag_No = '" . $prabhag . "' GROUP BY `Code` ORDER BY `Amount` DESC";
        $result = mysqli_query($con, $query);

        if($result->num_rows)
        {
            while($row = mysqli_fetch_assoc($result)) {
                $details_of_work[] = $row['Details_Of_Work'];
                $amount[] = $row['Amount'];
            }

            $total_amount = array_sum($amount);

            if(count($details_of_work) <= 7)
            {
                for ($i=0; $i < count($details_of_work); $i++) { 
                    $chart_data[] = [
                        "name" => $details_of_work[$i],
                        "no_of_times" => $amount[$i],
                    ];
                }
            }
            else
            {
                $remaining_values = array_slice($amount, 7);
                $remaining_total = array_sum($remaining_values);
                
                for($i=0; $i<7; $i++){
                    $chart_data[] = [
                        "name" => $details_of_work[$i],
                        "no_of_times" => $amount[$i],
                    ];
                }
                $chart_data[] = [
                    "name" => "Others",
                    "no_of_times" => $remaining_total,
                ];
            }
        }

        return $chart_data;
    }

?>
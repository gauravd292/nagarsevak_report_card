<?php require_once('../_config.php'); ?>

<?php require_once('../_header.php'); ?>

<?php require_once('_common.php'); ?>
<?php

    $prabhag = $_GET["p"];
    $year = $_GET["y"];
    if($year){
        $year = str_replace('-', ' - ', $year);
    }
    
    $year = $year ? [$year] : $yearList;
    $data = [];
    $total_amt = "";

    for ($i=0; $i < count($year); $i++) { 
        $query = "SELECT Year, Details_Of_Work, Code, Amount,
            (SELECT Work_Type FROM `codes` as tbl WHERE tbl.Code = s_list.Code) as Work_Type
        FROM s_list WHERE Prabhag_No = '".$prabhag."' && Year = '".$year[$i]."'";

        $result = mysqli_query($con, $query);
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $data[$year[$i]][] = $row;
            }
        }
    }

    $query = "SELECT  SUM(Amount) AS Amount FROM s_list WHERE Prabhag_No = '".$prabhag."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $total_amt = $row['Amount'];

?>

<div id="fh5co-about" style="padding-top: 50px;">
    <div class="container">

        <?php require_once('_profile.php'); ?>
        
        <div class="text-center">
            <br><h2><strong>S-LIST FUNDS - (<?=moneyFormatIndia($total_amt); ?>)</strong></h2><br>

            <div class="btn-group btn-group-lg" role="group">
                <?php $url = SITE_URL . "details/s_list.php?&p={$prabhag}";  ?>
                <a href="<?=$url; ?>" class="btn btn-default <?=count($year) > 1 ? 'active' : ''; ?>">ALL</a>
                <?php
                    foreach ($yearList as $key => $value) {
                        $y = str_replace(" - ", "-", $value);
                        $url = SITE_URL . "details/s_list.php?y={$y}&p={$prabhag}"; 
                        ?>
                        <a href="<?=$url; ?>" class="btn btn-default <?=$y == $_GET["y"] ? 'active' : ''; ?>"><?=$value; ?></a>
                <?php
                    }   ?>
            </div>

        </div><br>

            <?php
                if($data){ 
                    foreach ($year as $k => $yr) {  ?>

                            <?=(($k)%2==0) ? '<div class="row">' : ''; ?>

                                <div class="col-md-6">
                                    <h4 class="text-center"><strong><?=$yr; ?></strong></h4>

                                    <?php
                                        if($data[$yr]){    ?>

                                            <div class="table-responsive">
                                                <table class='table table-bordered table-condensed'>
                                                    <colgroup>
                                                        <col style='width:70%;'>
                                                        <col style='width:30%;'>
                                                    </colgroup>
                                                    <thead class="table-odd">
                                                        <tr>
                                                            <th><strong>Type Of Work</strong></th>
                                                            <th><strong>Amount (Rs.)</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        foreach ($data[$yr] as $key => $row) 
                                                        {  ?>
                                                            
                                                            <tr>
                                                                <td>
                                                                    <span class="code" data-toggle="tooltip" data-placement="top" title="<?=$row['Work_Type']; ?>"><?=$row['Code']; ?></span>
                                                                </td>
                                                                <td align="right"><?=moneyFormatIndia($row['Amount']); ?></td>
                                                                <?php $total[$yr][] = $row['Amount']; ?>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                    <tfoot class="table-odd">
                                                        <tr>
                                                            <td><strong>Total Amount</strong></td>
                                                            <td align="right"><strong><?=moneyFormatIndia(array_sum($total[$yr])); ?></strong></td>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                    <?php
                                        }
                                        else {  ?>
                                            <div class='text-center'><h3><strong>No data found</strong></h3></div>
                                    <?php
                                        }   ?>
                                </div>

                            <?=(($k)%2!=0) ? '</div>' : ''; ?>
            <?php
                    }
                }   
                else{   ?>
                    <div class='col-md-12 text-center'><h3><strong>No data found</strong></h3></div>
            <?php
                }   ?>
        </div>


    </div>
</div>


<?php ob_start(); ?>
<script>$(document).find('span.code').tooltip();</script>
<?php 
    $contentData = ob_get_contents(); 
    ob_end_clean ();
    $contentBuffer["BOTTOM"][] = $contentData;
?>

<?php require_once('../_footer.php'); ?>
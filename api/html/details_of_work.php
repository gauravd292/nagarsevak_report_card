<div class='<?=$config["class_name"]; ?>'>
    <div class='text-center'><h3><?=$prabhag . " - " . $person_info["Nagarsevak_Name"] . " (". $person_info["Party"] .")"; ?></h3></div>

    <?php
        if($data){   ?>
            <div class='text-left'>
                <h4>
                    <strong>Ward Level</strong> 
                    <?php $url = SITE_URL . "details/ward_level.php?p={$prabhag}"; ?>
                    <a href="<?=$url; ?>" target="_self">[Click to see details]</a>
                </h4>
            </div>
            <div class="table-responsive">
                <table class='table table-bordered table-condensed'>
                    <thead class="table-odd">
                        <tr>
                            <th><strong>Year</strong></th>
                            <th><strong>Amount (Rs.)</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalW = 0;
                        foreach ($data as $yr => $r) {  ?>
                            <tr>
                                <td><?=$yr; ?> </td>
                                <td align="right"><?=moneyFormatIndia($r['ward_level']['totalAmount']); ?></td>
                                <?php $totalW += $r['ward_level']['totalAmount']; ?>
                            </tr>
                    <?php
                        }   ?>
                    </tbody>
                    <tfoot class="table-odd">
                        <tr>
                            <td><strong>Total Amount</strong></td>
                            <td align="right"><strong><?=moneyFormatIndia($totalW); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
    <?php
        }
        else{   ?>
            <div class='text-center'><h3><strong>No data found</strong></h3></div>
    <?php
        }   ?>



    <?php
        if($data){   ?>
            <div class='text-left'>
                <h4>
                    <strong>S-List</strong>
                    <?php $url = SITE_URL . "details/s_list.php?p={$prabhag}";  ?>
                    <a href="<?=$url; ?>" target="_self">[Click to see details]</a>
                </h4>
            </div>
            <div class="table-responsive">
                <table class='table table-bordered table-condensed'>
                    <thead class="table-odd">
                        <tr>
                            <th><strong>Year</strong></th>
                            <th><strong>Amount (Rs.)</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalS = 0;
                        foreach ($data as $yr => $r) {  ?>
                            <tr>
                                <td><?=$yr; ?> </td>
                                <td align="right"><?=moneyFormatIndia($r['s_list']['totalAmount']); ?></td>
                                <?php $totalS += $r['s_list']['totalAmount']; ?>
                            </tr>
                    <?php
                        }   ?>
                    </tbody>
                    <tfoot class="table-odd">
                        <tr>
                            <td><strong>Total Amount</strong></td>
                            <td align="right"><strong><?=moneyFormatIndia($totalS); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
    <?php
        }
        else{   ?>
            <div class='text-center'><h3><strong>No data found</strong></h3></div>
    <?php
        }   ?>
</div>
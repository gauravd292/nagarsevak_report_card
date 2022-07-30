<div class='<?=$config["class_name"]; ?>'>
    <div class='text-center'><h3><?=$prabhag . " - " . $person_info["Nagarsevak_Name"] . " (". $person_info["Party"] .")"; ?></h3></div>
    <?php
        if($data){   ?>
            <div class="table-responsive">
                <table class='table table-bordered table-condensed'>
                    <colgroup>
                        <col style='width:40%;'>
                        <col style='width:30%;'>
                        <col style='width:30%;'>
                    </colgroup>
                    <thead class="table-odd">
                        <tr>
                            <th rowspan="2"><strong>Year</strong></th>
                            <th colspan="2"><strong>Amount (Rs.)</strong></th>
                        </tr>
                        <tr>
                            <th><strong>Ward Level</strong></th>
                            <th><strong>S-List</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <?php
                                    $url = SITE_URL . "details/ward_level.php?p={$prabhag}"; 
                                ?>
                                <a href="<?=$url; ?>" target="_self">[Click to see details]</a>
                            </td>
                            <td>
                                <?php
                                    $url = SITE_URL . "details/s_list.php?p={$prabhag}"; 
                                ?>
                                <a href="<?=$url; ?>" target="_self">[Click to see details]</a>
                            </td>
                        </tr>
                    <?php
                        $totalW = 0;
                        $totalS = 0;
                        foreach ($data as $yr => $r) {  ?>
                            <tr>
                                <td><?=$yr; ?> </td>
                                <td align="right"><?=moneyFormatIndia($r['ward_level']['totalAmount']); ?></td>
                                <td align="right"><?=moneyFormatIndia($r['s_list']['totalAmount']); ?></td>
                                <?php $totalW += $r['ward_level']['totalAmount']; ?>
                                <?php $totalS += $r['s_list']['totalAmount']; ?>
                            </tr>
                    <?php
                        }   ?>
                    </tbody>
                    <tfoot class="table-odd">
                        <tr>
                            <td><strong>Total Amount</strong></td>
                            <td align="right"><strong><?=moneyFormatIndia($totalW); ?></strong></td>
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
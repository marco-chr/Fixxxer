<?php

// generate service calls event in a date interval for all tags linked to a maintenance master

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["lowerrange"]))
        {
            apologize("You must provide a start date.");
        }
        else if (empty($_POST["upperrange"]))
        {
            apologize("You must provide an end date.");
        }
    
    
    $lowerrange = new DateTime($_POST['lowerrange']);
    $upperrange = new DateTime($_POST['upperrange']);
    $sqlstring  = "SELECT * FROM tags";    
    $rows = query($sqlstring);
    
    foreach ($rows as $row)
    {
    if ($row["equip_type"] != NULL)
    {
        $sqlstring  = "SELECT * FROM maint_master WHERE maint_master.equip_type = ?";    
        $maintrows = query($sqlstring,$row["equip_type"]);
        foreach ($maintrows as $maintrow)
        {
            if($maintrow["active"] === 1)
            {                
                $sqlstring = "SELECT * FROM work_ins WHERE work_ins.equip_subtype = ?";
                $winsrows = query($sqlstring,$row["equip_subtype"]);
                foreach ($winsrows as $winsrow)
                {
                    
                    switch ($winsrow["freq"]) {
                    case "2Y":
                    $diff = "+2 year";
                    break;
                    case "Y":
                    $diff = "+1 year";
                    break;
                    case "6M":
                    $diff = "+6 month";
                    break;
                    case "3M":
                    $diff = "+3 month";
                    break;
                    case "M":
                    $diff = "+1 month";
                    break;
                    case "W":
                    $diff = "+1 week";
                    break;
                    }
                    
                    $baseyear = date('Y',strtotime($row["basedate"]));
                    $basemonth = date('m',strtotime($row["basedate"]));
                    $baseday = date('d',strtotime($row["basedate"]));
                    
                    $newdatestring = $baseyear."-".$basemonth."-".$baseday;
                    $newdate = new DateTime($newdatestring);
                    
                    
                    while ($newdate <= $upperrange)
                    {
                        $newdate -> modify($diff);
                        $newdatestring = $newdate->format('Y-m-d');
                        $newyear = date('Y',strtotime($newdatestring));
                        $newmonth = date('m',strtotime($newdatestring));
                        $newday = date('d',strtotime($newdatestring));
                        $newdatestring = $newyear."-".$newmonth."-".$newday;
                    
                        if ($newdate > $lowerrange && $newdate < $upperrange)
                        {
                            $sqlstring = "SELECT * FROM service_call WHERE service_call.tag = ? AND service_call.date = ? LIMIT 1";
                            $scallrows = query($sqlstring,$row["tag"],$newdatestring);
                           
                            if(!$scallrows)
                            {
                                $sqlstring  = "INSERT INTO `service_call`(`tag`, `date`, `opened`) ";
                                $sqlstring .= "VALUES(?,?,?)";        
                                $scallnewrows = query($sqlstring,$row["tag"],$newdatestring,1);
                                
                                $sqlstring = "SELECT * FROM service_call WHERE id=(SELECT max(id) FROM service_call)";
                                $callidrows = query($sqlstring);
                                $callidrow = $callidrows[0];
                                
                                $sqlstring  = "INSERT INTO `service_wins`(`tag`, `date`, `wins`,`service_id`) ";
                                $sqlstring .= "VALUES(?,?,?,?)";        
                                $swinsnewrows = query($sqlstring,$row["tag"],$newdatestring,$winsrow["instruction"],$callidrow["id"]);
                            }
                            else
                            {
                                $sqlstring = "SELECT * FROM service_wins WHERE service_wins.tag = ? AND service_wins.date = ? AND service_wins.wins = ?";
                                $swinscheck = query($sqlstring,$row["tag"],$newdatestring,$winsrow["instruction"]);
                                if(!$swinscheck)
                                {
                                    $sqlstring = "SELECT * FROM service_call WHERE service_call.tag = ? AND service_call.date = ?";
                                    $scallcheckrows = query($sqlstring,$row["tag"],$newdatestring);
                                    $scallcheckrow = $scallcheckrows[0];
                                    
                                    
                                    $sqlstring  = "INSERT INTO `service_wins`(`tag`, `date`, `wins`,`service_id`) ";
                                    $sqlstring .= "VALUES(?,?,?,?)";        
                                    $swinsnewrows = query($sqlstring,$row["tag"],$newdatestring,$winsrow["instruction"],$scallcheckrow["id"]);
                                }
                       
                            }
                        }
                    }
                }   
            }
        }
    }
    }
    redirect_to("/service.php");
    }
    else
    {
            // render header
            require("../templates/header.php");?>
        

            <form action="generate.php" method="post">
            <fieldset>
            <div class="form-group">
            <label>From date:</label><input autofocus class="form-control" name="lowerrange" placeholder="YYYY-MM-DD" type="text" /><br>
            <label>To date:</label><input autofocus class="form-control" name="upperrange" placeholder="YYYY-MM-DD" type="text" /><br>
             
            </select><br>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-default">Generate service calls</button>
            </div>
            </fieldset>
            </form>

            <?php
            // render footer
            require("../templates/footer.php");
 
    }
?>

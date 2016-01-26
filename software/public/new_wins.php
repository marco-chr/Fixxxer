<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $i=0;
        foreach ($_POST['workins'] as $workins)
        {
        
        if ($workins['instruction'] !== "")
        {

            $sqlstring  = "INSERT INTO `work_ins`(`equip_subtype`, `instruction`,`master_id`,`section`,`freq`) ";
            $sqlstring .= "VALUES(?,?,?,?,?)";
        
            $rows = query($sqlstring,$workins['equip_subtype'],$workins['instruction'],$workins['master_id'],$i,$workins['freq']);
            $i++;
        }
        
        }
        redirect_to("/");
    
        
    }
    else
    {
        
            $sqlstring  = "SELECT * FROM equip_subtypes WHERE parent_id = ?";
            $rows = query($sqlstring,$_GET["equip_id"]);
            require("../templates/header.php");
            ?>
            
            
            <div style="width:800px; margin:0 auto;">
            <form action="new_wins.php" method="post" role="form" class="form-inline">
            <fieldset>
                 <table align="center">
                 <thead>
                 <tr>
                 <td>Equip subtype</td>
                 <td>Frequency</td>
                 <td>Work instruction</td>
                 <td>Section</td>
                 </tr>
                 
                 <!-- row begin -->
                 <?php
                 for ($i=0; $i<10; $i++)
                 {
                 echo"<tr>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                     echo"<select class=\"form-control\" name=\"workins[".$i."][equip_subtype]\">";
                     foreach ($rows as $row){
                     echo"<option value=\"".$row['equip_subtype']."\">".$row['equip_subtype']."</option>";
                     }
                     echo"</select>";
                 echo"</div>";
                 echo"</td>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                     echo"<label class=\"sr-only\">Master</label>";
                     echo"<select class=\"form-control\" name=\"workins[".$i."][freq]\">";
                     echo"<option>2Y</option>";
                     echo"<option>Y</option>";
                     echo"<option>6M</option>";
                     echo"<option>3M</option>";
                     echo"<option>M</option>";
                     echo"<option>W</option>";
                     echo"<option>D</option>";
                     echo"</select>";
                 echo"</div>";
                 echo"</td>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                    echo"<label class=\"sr-only\">Work Instruction</label><input autofocus class=\"form-control\" name=\"workins[".$i."][instruction]\" size=\"50\" type=\"text\" align=\"left\"/>";
                 echo"</div>";
                 echo"</td>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                     echo"<div class=\"col-sm-10\">";
                     echo"<p class=\"form-control-static\">".$i."</p>";
                     echo"</div>";
                 echo"</div>";
                 echo"</td>";
                 echo"<input type=\"hidden\" name=\"workins[".$i."][master_id]\" value=\"".$_GET["master_id"]."\"/>";
                 echo"</tr>";
                 }
                 ?>
                 <!-- row end -->
                 
                 </table>
                 
            </fieldset>
            <button type="submit" class="btn btn-default">Add Master</button>
            </form>
            </div>
            
            <?php
            require("../templates/footer.php");
            
    }

?>

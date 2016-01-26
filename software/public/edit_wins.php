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
        
        $sqlstring = "DELETE from `work_ins` WHERE master_id = ?";
        $rows = query($sqlstring,$_GET["master_id"]);
        
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
            
            $sqlstring = "SELECT * FROM work_ins WHERE master_id = ?";
            $subtypes = query($sqlstring,$_GET["master_id"]);
            $countwins = countrows($sqlstring,$_GET["master_id"]);
            
            require("../templates/header.php");
            ?>
            
            
            <div style="width:800px; margin:0 auto;">
            
            <form action="edit_wins.php?master_id=<?= $_GET["master_id"] ?>"  method="post" role="form" class="form-inline">
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
                 
                 for ($i=0; $i<$countwins; $i++)
                 {

                 $subtype=$subtypes[$i];
                 echo"<tr>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                     echo"<select class=\"form-control\" name=\"workins[".$i."][equip_subtype]\">";
                     foreach ($rows as $row){
                     if ($subtype['equip_subtype'] === $row['equip_subtype']) {
                     echo"<option value=\"".$row['equip_subtype']."\" selected>".$row['equip_subtype']."</option>";
                     }
                     else {
                     echo"<option value=\"".$row['equip_subtype']."\">".$row['equip_subtype']."</option>";}
                     }
                     echo"</select>";
                 echo"</div>";
                 echo"</td>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                     echo"<label class=\"sr-only\">Master</label>";
                     echo"<select class=\"form-control\" name=\"workins[".$i."][freq]\">";
                     if ($subtype['freq'] === '2Y') {
                     echo"<option selected>2Y</option>";}
                     else {
                     echo"<option>2Y</option>";}
                     if ($subtype['freq'] === 'Y') {
                     echo"<option selected>Y</option>";}
                     else {
                     echo"<option>Y</option>";}
                     if ($subtype['freq'] === '6M') {
                     echo"<option selected>6M</option>";}
                     else {
                     echo"<option>6M</option>";}
                     if ($subtype['freq'] === '3M') {
                     echo"<option selected>3M</option>";}
                     else {
                     echo"<option>3M</option>";}
                     if ($subtype['freq'] === 'M') {
                     echo"<option selected>M</option>";}
                     else {
                     echo"<option>M</option>";}
                     if ($subtype['freq'] === 'W') {
                     echo"<option selected>W</option>";}
                     else {
                     echo"<option>W</option>";}
                     if ($subtype['freq'] === 'D') {
                     echo"<option selected>2Y</option>";}
                     else {
                     echo"<option>D</option>";}
                     echo"</select>";
                 echo"</div>";
                 echo"</td>";
                 echo"<td>";
                 echo"<div class=\"form-group\">";
                    echo"<label class=\"sr-only\">Work Instruction</label><input autofocus class=\"form-control\" name=\"workins[".$i."][instruction]\" value=\"".$subtype['instruction']."\" size=\"50\" type=\"text\" align=\"left\"/>";
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
                 
                 <!-- row begin -->
                 <?php
                 
                 for ($i=$countwins; $i<10; $i++)
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

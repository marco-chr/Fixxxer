<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");


confirm_logged();
            // render header
            require("../templates/header.php");
            ?>
            <div style="width:800px; overflow:auto; margin:0 auto; ">
            <strong>Workflow</strong>
            </br>
            <a><img alt="workflow" src="/img/workflow.png"/></a>
            
            </div>
            
            
            <?php
            // render footer
            require("../templates/footer.php");

?>


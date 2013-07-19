<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<html>
    <head>
        <title>Application Error Page!</title>
    </head>

    <body bgcolor="#0000FF" text="#FFFFFF">
        <h1>Error Page!</h1>
        <h2>Error <?php print( $_REQUEST['error_code']); ?></h2>
        <hr>
        <p>There is an error in the application!</p>
        <p>The error message is:</p>
        <p><i><?php print( $_REQUEST['error_message']); ?></i></p>
    </body>
</html>
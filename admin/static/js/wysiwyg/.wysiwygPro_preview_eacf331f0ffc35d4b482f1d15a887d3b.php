<?php
if ($_GET['randomId'] != "MIGNA9Z4FNjC79mpWLYFf7e0x_LQnhsMyarwyT6Ep5ovdAj6Ih5Vhi7h44XiFeSH") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  

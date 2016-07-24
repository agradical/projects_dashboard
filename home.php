<?php
$login = 1;
echo getRenderedHTML('views/login.html');

?>

<link rel="stylesheet" href="stylesheets/login.css" type="text/css">

<?php

function getRenderedHTML($path) {
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}

?>
<script src="javascripts/lib/jquery-2.2.0.min.js"></script>
<script src="javascripts/login.js"></script>

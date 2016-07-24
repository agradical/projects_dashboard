<?php
include('application.php');

$sort_types = array(1=>'Recent Projects', 2=>'Categories', 3=>'Title', 4=>'Username');
?>

<link rel="stylesheet" href="stylesheets/project_homepage.css" type="text/css">

<div class="welcome-bar">
    <div class="welcome-message">
        <span>Hi <?php echo $name; ?></span>
    </div>
</div>

<div class="container">
    <div class='container-header'>
        <div class="container-title">
            <span>List of Projects</span>
        </div>
        <div class="container-options">
            <select id="sort">
                <?php 
                    $count = 0;
                    foreach($sort_types as $key=>$types) {
                        $selected = '';
                        if($count == 0) {
                            $selected = 'selected';
                        }
                        echo '<option value='.$key.' >'.$types.'</option>';
                        $count++;
                    }
                ?>
            </select>
        </div>
    </div>
    
    <div class="container_body">
    </div>
    
    <div class="footer">Page 0</div>
    
    <div class="pagination" data-page_id=0>
        <button id="prev">Prev</button>
        <button id="next">Next</button>
    </div>
</div>

<script src="javascripts/lib/jquery-2.2.0.min.js"></script>
<script src="javascripts/project_homepage.js"></script>

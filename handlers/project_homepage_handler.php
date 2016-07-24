<?php

include('../application.php');

$html = '';
$result = array('success'=>0, 'html'=>$html);

if(!isset($_POST)){
}

if(!isset($_POST['sort'])) {
    $_POST['sort'] = 1;
}

$project = new Project();
$data = $project->getProjectPage($_POST['page'],2,$_POST['sort']);

//var_dump($data);die();
foreach($data as $key=>$details) {

    $project_id = $details['project_id'];
    $project_title = $details['project_title'];
    $category = $details['category_name'];
    $username = $details['username'];
    $firstname = $details['firstname'];

$html .= '
<div class="list-view">
    <div class="content">
        <div class="content-body">
            <header class="content-header">
                <h4 class="project-title" data-project_id="'.$project_id.'">'.$project_title.'</h4>
            </header>
            <footer class="content-footer">
                <h4 class="project_detail">'.'Author: '.$firstname.' (username: '.$username.'), Category: '.$category.'</h4>
            </footer>
        </div>
    </div>
</div>';

}

$result = array('success'=>1, 'html'=>$html);
echo json_encode($result);

?>


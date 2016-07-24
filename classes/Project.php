<?

class Project {
    var $project_id;
    var $project_title;
    var $author;
    var $category;
    var $date_created;
    var $description;
    
    public function getProject($project_id) {
    
    }

    public function getProjectPage($page_number, $count, $order_type=1) {
        
        $DB = new DB();
        $conn = $DB->getConnection();
        
        $sort_types = array (1=>'date_created',2=>'category_name',3=>'project_title', 4=>'firstname');
        $order_by = ' ORDER BY p.project_id DESC ';
        
        if($order_type == 2) {

            $order_by = ' ORDER BY c.category_name ASC ';
        }
        if($order_type == 3) {

            $order_by = ' ORDER BY p.project_title ASC ';
        }
        if($order_type == 4) {

            $order_by = ' ORDER BY u.username ASC ';
        }
        
        $query = 'SELECT p.project_id, p.project_title, u.firstname, u.lastname, u.username, c.category_name
                        FROM projects p
                        INNER JOIN users u ON u.user_id = p.user_id
                        LEFT JOIN categories c ON c.category_id = p.category_id
                        '.$order_by.'LIMIT ?,?';
        
        $stmt = $conn->prepare($query);
        $sort_type = $sort_types[$order_type];
        if($page_number < 0) {
            $page_number = 0;
        }
        $offset = $page_number * $count;
        $stmt->bind_param('ii', $offset, $count);
        $stmt->execute();
        $stmt->bind_result($project_id, $project_title, $firstname, $lastname, $username, $category_name);
        
        $result = array();
        while($stmt->fetch()) {
            $_result = array('project_id'=>$project_id, 'project_title'=>$project_title,
                               'firstname'=>$firstname, 'lastname'=>$lastname,
                               'username' => $username, 'category_name'=>$category_name);
            $result[] = $_result;
        }
        
        //var_dump($query, $result, $offset, $count);
        //die();
        return $result;
    }
}

?>

<?php
class database {
    private $database;
    private $latest_error;

    public function connect(){
        //=======================================================================
        // Set up a connection to the database.
        //=======================================================================
        $database = new mysqli("localhost","root","Bc1nygR6BYZ","database_phpmysql");
        if ($database -> connect_errno) {
            $latest_error = "Failed to connect to database: " . $database -> connect_error;
            exit();
        }
        $this->database = $database;
        return($database);
    }

    public function selectXfromY($x,$y){
        //=======================================================================
        // Selects column x from table y and returns it.
        //=======================================================================
        $query = "SELECT " . $x . " FROM " . $y . " ;";
        $result = $this->database->query($query);
        return($result);
    }

    public function selectXfromYwhereAisB($x,$y,$a,$b){
        //=======================================================================
        // Selects column x from table y where a = b and returns it.
        //=======================================================================
        $query = "SELECT " . $x . " FROM " . $y . " WHERE ". $a . " = " . $b . " ;";
        $result = $this->database->query($query);
        return($result);
    }

    public function selectXfromYwhereAisBorderbyC($x,$y,$a,$b,$c,$asc=true){
        //=======================================================================
        // Selects column x from table y where a = b ordered by c and returns it.
        //=======================================================================
        if $asc {
            $query = "SELECT " . $x . " FROM " . $y . " WHERE ". $a . " = " . $b . " ORDER BY " . $c . " ;";
        }else{
            $query = "SELECT " . $x . " FROM " . $y . " WHERE ". $a . " = " . $b . " ORDER BY " . $c . " DESC ;";
        }
        $result = $this->database->query($query);
        return($result);
    }

    public function getPageContent($page_id){
        //=======================================================================
        // Returns the content of a specified page.
        //=======================================================================
        $result = $this->selectXfromYwhereAisBorderbyC('content_id,content_type_id', 'pages_content', 'page_id', $page_id, 'view_order');
        $page_content = [];
        while($row = $result->fetch_assoc()){
            $page_content[] = [$row['content_id'],$row['content_type_id']];
        }
        return($page_content);
    }

    public function getBasicPage(){
        //=======================================================================
        // Returns the title, stylesheet and footer.
        //=======================================================================
        $result = $this->selectXfromY('text','standard_page_attributes');

        $row = $result -> fetch_assoc();
        $title = $row['text'];
        $row = $result -> fetch_assoc();
        $stylesheet = $row['text'];
        $row = $result -> fetch_assoc();
        $footer = $row['text'];

        return([$title,$row,$footer])
    }

    public function getParagraph($paragraph_id){
        //=======================================================================
        // Returns the text of a given paragraph.
        //=======================================================================
        $result = selectXfromY('text','paragraphs');
        $row = $result->fetch_assoc();
        return($row['text']);
    }
}
?>
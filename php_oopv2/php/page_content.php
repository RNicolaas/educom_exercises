<?php
class page_content {
    private $page_id;
    private $database;
    private $page_content;
    private $page_content_ids;

    public function __construct($database,$page_id){
        //=======================================================================
        // Constructs the header by getting the title and stylesheet from the 
        // database.
        //=======================================================================
        $this->database = $database;
        $this->page_content_ids = $database->getPageContent($page_id);
        
    }

    public function getContent(){
        for($i=0; $i<count($this->page_content_ids); $i++){
            $this->page_content[] = $this->makeContent($this->page_content_ids[$i][0],$this->page_content_ids[$i][1])
        }
    }

    private function makeContent($content_type_id,$content_id){
        switch($content_type_id){
            case 1:
                require_once "paragraph.php";
                $content = new paragraph($this->database->getParagraph($content_id));
                break;
            case 2:
                //require_once "form.php";
                //$content = new form($content_id);
                break;
            case 3:
                //require_once "link_button.php";
                //$content = new link_button($content_id);
                break;
            case 4:
                require_once "head_text.php";
                $content = new head_text($this->database->getHeadText($content_id));
                break;
            case 5:
                //require_once "paragraph.php";
                //$content = new paragraph($this->database->getParagraph($content_id));
                //break;
            case 6:
                //require_once "form.php";
                //$content = new form($content_id);
                //break;
            case 7:
                //require_once "link_button.php";
                //$content = new link_button($content_id);
                //break;
            case 8:
                //require_once "head_text.php";
                //$content = new head_text($this->database->getHeadText($content_id));
                //break;
            default:
                require_once "paragraph.php";
                $content = new paragraph('Something went wrong...');
                break;
        }
        $return($content);
    }
}
?>
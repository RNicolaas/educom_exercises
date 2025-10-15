<?php
class header {
    private $title;
    private $stylesheet;

    public function __construct($title,$stylesheet){
        //=======================================================================
        // Constructs the header by setting the title and stylesheet.
        //=======================================================================
        $this->title = $title;
        $this->stylesheet = $stylesheet;
    }

    public function getHeader(){
        //=======================================================================
        // Echos the header with title and stylesheet reference.
        //=======================================================================
        echo '<head><title>' . htmlspecialchars($this->title) . "</title><link rel='stylesheet' href='" . $this->stylesheet . "'></head>";
    }
}
?>
<?php
require_once "page.php";
class about_page extends page{
    public function __construct($response){
        //================================================
        // Constructs the cart_page by making an item 
        // object for the inputted item id and initialising 
        // the content of the page to show the item.
        //================================================
        $title = "About";
        parent::__construct($title,"",$response);
        $content = $this->getAboutContent();
        $this->setContent($content);
    }

    private function getAboutContent(){
        $content = "";
        $content = $content . $this->showParagraph("My full name is Rodney Nicolaas. I was born April 9th 2002 in Zupthen, where I grew up in a loving family. I have a younger brother who I have always had a good relationship with.");
        $content = $content . $this->showParagraph("I always did well in school and especially liked beta subjects. This eventually led me to a study astrophysics at the Radboud University.");
        $content = $content . $this->showParagraph("During this study I found my love for coding and software development. My master internship was spent developing a machine learning method to remove background from telescope images.");
        $content = $content . $this->showParagraph("Now I am doing a traineeship software development for Educom, so that I can start as a software developer.");
        return($content);
    }
}
?>
<?php

class View{
    
    private $view = null;
    private $set_data = array();
    private $file = null;

    public function __construct() {
        $this->view =  $this->loadTemplate();
    }
    
    private function loadTemplate(){
        
        // Twig Template
        $loader = new Twig_Loader_Filesystem('applications/views');
        $twig = new Twig_Environment($loader, array(
            
            // Enable Cache
            // 'cache' => 'tmp',
        ));
        
        // Base template
        $twig->loadTemplate('index.twig');
        return $twig;
    }
    
    public function setData($data) {
        
        $this->set_data = $data;
        
    }
//    
//    public function setView($file){
//        $this->file = $file;
//    }
    
    public function display($file, $data = array()) {
        
        if(isset($data['fb'])){
            $data['fb'] = array_merge($this->set_data['fb'], $data['fb']);
        }
        
        $content_data = array_merge($this->set_data, $data);
        
        echo $this->view->render($file, $content_data);
    }
}
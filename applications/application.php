<?php

/**
 * 
 */
class Application{
    
    private $url_controller = null;
    private $url_action = null;
    private $url_params = null;
    
    public function __construct() {
        $this->splitRequest($_SERVER['REQUEST_URI']);
        
        if (file_exists('applications/controllers/'.$this->url_controller.EXT)) {
            require 'applications/controllers/'.$this->url_controller.EXT;
            $this->url_controller = new $this->url_controller();
            
            if(method_exists($this->url_controller, $this->url_action)){
                $this->url_controller->{$this->url_action}($this->url_params);
            }else{
                $this->url_controller->index();
            }
            
        }else{
            
            require 'controllers/home.php';
            $home = new \Home();
            $home->index();
            
        }
        
    }
    
    private function splitRequest($requests) {
        if(strpos($requests, '/') === 0){
            $requests = substr($requests, 1);
        }
        
        $url = explode('/', $requests, 3);
        
        $this->url_controller = empty($url['0']) ? null : $url['0'] ;
        $this->url_action = empty($url['1']) ? 'index' : $url['1'] ;
        $this->url_params = empty($url['2']) ? null : explode('/', $url['2']);
    }
    
}
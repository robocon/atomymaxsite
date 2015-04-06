<?php

/**
 * Description of controller
 * 
 * @author robocon
 */
class Controller {
    
    public $db = null;
    public $view = null;
    
    protected $configs = [];
    protected $lang = [];
    protected $fb = [];
    protected $user = null;

    public function __construct() {
        $this->loadDatabase();
        $config = $this->loadConfig();
        
        $this->view = new View();
        
        $data = [];
        $data['config'] = $config;
        
        // load language
        $data['lang'] = $this->loadLanguage();
        
        // Default variable for template
        $data['base_url'] = DOMAIN;
        
        // Set message to system for notification
        $data['x_message'] = getSession('x-message');
        $data['x_msg_status'] = getSession('x-msg-status');
        
        $data['fb'] = [
            'app_id' => (!empty($data['config']['fb_app_id']) ? $data['config']['fb_app_id'] : null ),
            'url' => site_url(),
            'site_name' => $data['config']['title']
        ];
        
        setSession('x-message', null);
        setSession('x-msg-status', null);
        
        $this->user = $this->getCookieUser();
        $data['user'] = $this->user;
        
        // Load template top image
        $data['template'] = $this->db->get('web_templates',['picname'],[
            'AND' => [
                'temname' => 'cli3',
                'sort' => 1
            ]
        ]);
        
        $this->view->setData($data);
    }
    
    private function loadDatabase(){
        if(!$this->db instanceof medoo){
            
            // Database Config 
            $this->db = new medoo([
                // required
                'database_type' => 'mysql',
                'database_name' => DB_NAME,
                'server' => DB_HOST,
                'username' => DB_USERNAME,
                'password' => DB_PASSWORD,
                'charset' => 'utf8',

                // optional
                'port' => 3306,
                // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
                'option' => [
                    //  PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]
            ]);
        }
        
        return $this->db;
    }
    
    private function loadConfig(){
        
        if(empty($this->configs)){
            $items = $this->db->select('web_config',['posit','name']);
            foreach($items as $item){
                $this->configs[$item['posit']] = $item['name'];
            }
        }
        
        return $this->configs;
    }
    
    private function loadLanguage(){
        $config = $this->configs;
        include 'lang/'.$config['language'].EXT;
        $this->lang = $l;
        return $this->lang;
    }
    
    private function getCookieUser(){
        if($this->user === null){
            $this->user = unserialize(get_cookie('user'));
        }
        
        return $this->user;
    }
}

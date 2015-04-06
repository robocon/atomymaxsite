<?php
class DB{
    
    private $db = null;
    public $query = null;
    
    protected $server;
    protected $username;
    protected $password;
    protected $database_name;
    protected $port = '3306';
    protected $charset = 'utf8';
    
    public static $init_option = array();
    
    public function __construct($option) {
        if ($this->db === null) {
            
            foreach($option as $key => $value){
                $this->$key = $value;
            }
            
            self::$init_option = $option;
            
            $this->db = mysqli_connect($this->server, $this->username, $this->password, $this->database_name, $this->port);
            $this->db->query('SET NAMES '.$this->charset);
            
        }
    }
    
    /**
     * Connect database with static method
     * 
     * @return \DB
     */
    public static function init($option = array()) {
        if(empty($option)){
            $option = self::$init_option;
        }
        
        $dbi = new DB($option);

        return $dbi;
    }
    
    /**
     * Select multiple item
     * 
     * @param string $statement
     * @return mixed
     */
    public function select($statement){
        $res = $this->db->query($statement);
        
        $items = array();
        while($item = $res->fetch_assoc()){
            $items[] = $item;
        }
        
        return $items;
    }
    
    /**
     * Select single item
     * 
     * @param string $statement
     * @return mixed
     */
    public function get($statement){
        $res = $this->db->query($statement);
        $item = $res->fetch_assoc();
        return $item;
    }
}

// Example using
// Set config for the first time
$db_config = array(
    'server' => 'localhost',
    'username' => 'root',
    'password' => '123',
    'database_name' => 'maxsite',
    'port' => '3306',
    'charset' => 'utf8',
);
$db = DB::init($db_config);
$items = $db->select('SELECT * FROM `web_news`');
var_dump($items);

// The Second call don't need configuration
$db = DB::init();
$items = $db->select('SELECT * FROM `web_contact`');
var_dump($items);
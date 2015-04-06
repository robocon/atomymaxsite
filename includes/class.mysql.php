<?php

class DB{
	
    public $host = null ;
    public $database = null;
    public $connect_db = null;
    public $selectdb = null;
    public $db = null;
    public $sql = null;
    public $table = null;
    public $where = null; 
	
    public function __construct() {
        if($this->connect_db === null){
            $this->connect_db = mysql_connect ( DB_HOST, DB_USERNAME, DB_PASSWORD ) or $this->_error();
            $this->db = mysql_select_db ( DB_NAME, $this->connect_db) or $this->_error();
            mysql_query("SET NAMES UTF8", $this->connect_db);
        }
    }
    
    public function connectdb($db_host=null, $db_name=null, $user=null, $pwd=null){
        return true; 
    }

	function closedb( ){
            mysql_close ( $this->connect_db ) or $this->_error();
	}

	//$db->add_db("table",array("field"=>"value")); 
	function add_db($table="table", $data="data"){
		$key = array_keys($data); 
        $value = array_values($data); 
		$sumdata = count($key); 
		for ($i=0;$i<$sumdata;$i++) 
        { 
            if (empty($add)){ 
                $add="("; 
            }else{ 
                $add=$add.","; 
            } 
            if (empty($val)){ 
                $val="("; 
            }else{ 
                $val=$val.","; 
            } 
            $add=$add.$key[$i]; 
            $val=$val."'".$value[$i]."'"; 
        } 
        $add=$add.")"; 
        $val=$val.")"; 
        $sql="INSERT IGNORE INTO ".$table." ".$add." VALUES ".$val; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
	}

	//$db->update_db("tabel",array("field"=>"value"),"where"); 
    function update_db($table="table",$data="data",$where="where"){ 
        $key = array_keys($data); 
        $value = array_values($data); 
        $sumdata = count($key); 
        $set=""; 
        for ($i=0;$i<$sumdata;$i++) 
        { 
            if (!empty($set)){ 
                $set=$set.","; 
            } 
            $set=$set.$key[$i]."='".$value[$i]."'"; 
        } 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$db->update("table","set","where");
	function update($table="table",$set="set",$where="where"){ 
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$db->del("table","where"); 
    function del($table="table",$where="where"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 
        if (mysql_query($sql)){ 
            return true; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$db->num_rows("table","field","where"); 
    function num_rows($table="table",$field="field",$where="where") { 
        if ($where=="") { 
            $where = ""; 
        } else { 
            $where = " WHERE ".$where; 
        } 
        $sql = "SELECT ".$field." FROM ".$table.$where; 
        if($res = mysql_query($sql)){ 
            return mysql_num_rows($res); 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
    function select_query($sql="sql"){ 
        if ($res = mysql_query($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//$rows = $db->rows($res); 
    function rows($sql="sql"){ 
      if ($res = mysql_num_rows($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 
	//while ($arr = $db->fetch($res)) { 
	//		echo $arr['a']." - ".$arr['c']."<br>\n"; 
	//}
    function fetch($sql="sql"){ 
      if ($res = mysql_fetch_assoc($sql)){ 
            return $res; 
        }else{ 
            $this->_error(); 
            return false; 
        } 
    } 

	function sql_fetchrow($sql="sql")
	{
		if(!$sql)
		{
			$sql = $db->sql_query;
		}
		if($sql)
		{
			$db->rows[$sql] = @mysql_fetch_array($sql);
			return $db->rows[$sql];
		}
		else
		{
			return false;
		}
	}

    function _error(){ 
        $this->error[]=mysql_errno(); 
    } 

	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}

}
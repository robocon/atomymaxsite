<?php

/**
 * Description of validator
 *
 * @author robocon
 */
class Validator extends Valitron\Validator{
    
    public function __construct($data, $lang = null) {
        
        $fields = array();
        $langDir = null;
        if($lang !== null && $lang == 'th'){
            $langDir = BASE_DIR.'/lang/valitron';
        }
        
        parent::__construct($data, $fields, $lang, $langDir);
    }
}

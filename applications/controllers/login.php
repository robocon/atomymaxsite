<?php

/**
 * Description of admin
 *
 * @author robocon
 */
class Login extends Controller {
    
    public function index() {
        $user = get_cookie('user');
        
        if($user === null){
            $this->view->display('login.twig');
        } else {
            redirect();  
        }
            
    }
    
    public function logout(){
        set_cookie('user', null, -1);
        redirect();
    }
    
    public function register() {
        $this->view->display('user/register.twig');
    }
}

<?php

/**
 * Description of admin
 *
 * @author robocon
 */
class User extends Controller {
    
    public function index(){}
    
    public function login() {
        
        $post = input_post();
        $pass = md5($post['password']);
        $conf = $this->configs;
        
        $v = new Validator($post,$conf['language']);
        $v->rule('required', ['email','password'])->message($this->lang['label_require']);
        $v->labels(array(
            'email' => $this->lang['login_email'],
            'password' => $this->lang['login_password'],
        ));
        
        if(!$v->validate()){
            $error_txt = display_errors($v->errors());
            set_message($error_txt, 'warning');
            redirect('login');
            exit;
        }
        
        $user = $this->db->get('web_member',['id','user','email','level','confirm_key'],[
            'AND' => [
                'OR' => [
                    'user' => $post['email'],
                    'email' => $post['email'],
                ],
                'password' => $pass,
            ]
        ]);
        
        if($user !== false && empty($user['confirm_key'])){
            unset($user['confirm_key']);
            setcookie("user", serialize($user), time()+(3600 * 24 * 365), '/');
            set_message($this->lang['login_success']);
            redirect();
            exit;
        }else{
            set_message($this->lang['login_fail'], 'warning');
        }
        
        redirect('login');
    }
    
    public function register() {
        
        $post = input_post();
        $conf = $this->configs;
        
        $v = new Validator($post,$conf['language']);
        $v->rule('required', ['username','email','password','confirm_password','verify'])->message($this->lang['label_require']);
        $v->rule('email', 'email');
        $v->rule('lengthMin', 'password', 6);
        $v->rule('equals', 'password', 'confirm_password');
        $v->rule('lengthMin', 'verify', 5);
        
        $v->labels(array(
            'username' => $this->lang['regis_user'],
            'email' => $this->lang['regis_email'],
            'password' => $this->lang['regis_pass'],
            'confirm_password' => $this->lang['regis_confirm_pass'],
            'verify' => $this->lang['verify'],
        ));
        
        if(!$v->validate()){
            $error_txt = display_errors($v->errors());
            set_message($error_txt, 'warning');
            redirect('login/register');
            exit;
        }
        
        // Check verify
        if($post['verify'] !== getSession('captcha')){
            set_message($this->lang['verify_check'], 'warning');
            redirect('login/register');
            exit;
        }
        
        // Check username already exists
        $count_user = $this->db->count('web_member',[
            'user' => $post['username']
        ]);
        if($count_user > 0){
            set_message($this->lang['regis_user_exists'], 'warning');
            redirect('login/register');
            exit;
        }
        
        // Check email already exists
        $count_email = $this->db->count('web_member',[
            'email' => $post['email']
        ]);
        if($count_email > 0){
            set_message($this->lang['regis_email_exists'], 'warning');
            redirect('login/register');
            exit;
        }
        
        $confirm_key = hash('sha256', $post['email'].uniqid());
        $confirm_url = DOMAIN.'user/confirm/'.$confirm_key;
        $this->db->insert('web_member',[
            'member_id' => sha1($post['username'].uniqid()),
            'name' => $post['username'],
            'user' => $post['username'],
            'password' => md5($post['password']),
            'email' => $post['email'],
            'level' => 0,
            'confirm_key' => $confirm_key,
        ]);
        
        $subject = $this->lang['regis_mail_subject'].$conf['title'];
        
        $message = sprintf($this->lang['regis_mail_msg'], $confirm_url, $confirm_url);
        $from = [
            'name' => $conf['email'],
            'email' => $conf['email']
        ];
        send_mail($post['email'], $from, $subject, $message);
        
        set_message($this->lang['regis_success']);
        redirect();
    }
    
    public function confirm($params) {
        
        $h = check_hex($params['0']);
        if($h === false){
            set_message('Invalid key format','warning');
            redirect();
            exit;
        }
        
        $key = $this->db->get('web_member',['id','confirm_key'],[
            'confirm_key' => (string)$params['0']
        ]);
        if($key === false){
            set_message('Invalid key','warning');
            redirect();
            exit;
        }
        
        $this->db->update('web_member',[
            'confirm_key' => ''
        ],['id' => $key['id']]);
        
        set_message($this->lang['regis_mail_confirm']);
        redirect('login');
    }
}

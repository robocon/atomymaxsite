<?php

/**
 * Description of contact
 *
 * @author robocon
 */
class contact extends Controller {
    public function index() {
        setSession('x-message', null);
        
        $data['items'] = $this->db->select('web_contact',['alias','value'],['ORDER' => 'order ASC']);
        $this->view->display('contact.twig', $data);
    }
    
    public function send() {
        
        $post = input_post();
        if($post['verify'] !== getSession('captcha')){
            set_message($this->lang['verify_check'], 'warning');
            redirect('contact');
            exit;
        }
        
        $v = new Valitron\Validator($post);
        $v->rule('required', ['name','email','phone','address','detail'])->message($this->lang['label_require']);
        $v->rule('email', 'email');
        $v->labels(array(
            'name' => $this->lang['contact_name'],
            'email' => $this->lang['contact_email'],
            'phone' => $this->lang['contact_phone'],
            'address' => $this->lang['contact_address'],
            'detail' => $this->lang['contact_detail'],
        ));
        
        if(!$v->validate()){
            $error_txt = display_errors($v->errors());
            set_message($error_txt, 'warning');
            redirect('contact');
            exit;
        }
        
        // Load configuration
        $config = $this->configs;
        
        $from = [
            'name' => $post['name'],
            'email' => $post['email']
        ];
        
        $subject = $this->lang['contact_mail_from'].$post['name'];
        
        $message = $this->lang['contact_mail_msg'].$post['name'].'<br>';
        $message .= $this->lang['contact_mail_addr'].$post['address'].'<br>';
        $message .= $this->lang['contact_mail_detail'].$post['detail'].'<br>';
        
        $send = send_mail($config['email'], $from, $subject, $message);
        
        if($send === false){
            set_message($this->lang['send_email_fail'], 'warning');
            redirect('contact');
        } else {
            set_message($this->lang['send_email_fail']);
            redirect('contact');
        }

    }
}

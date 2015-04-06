<?php

/**
 * Description of config
 *
 * @author robocon
 */
class Config extends Controller {
    
    public function index() {
        if($this->user === false OR $this->user['level'] != 1){
            set_message($this->lang['not_auth'],'warning');
            redirect();
        }
        
        $items = $this->db->select('web_config',['posit','title','name']);
        $item_lists = [];
        $alllow_edit = ['title','url','email','fb_app_id','language'];
        foreach($items as $item){
            if(in_array($item['posit'], $alllow_edit)){
                $item_lists[] = $item;
            }
        }
        
        $template = $this->db->get('web_templates',['picname'],[
            'AND' => [
                'temname' => 'cli3',
                'sort' => 1
            ]
        ]);
        $data['template'] = $template;
        
        $data['items'] = $item_lists;
        $this->view->display('settings/config.twig', $data);

    }
    
    public function save(){
        
        $post = input_post();
        $config = $this->configs;
        $v = new Validator($post, $config['language']);
        $v->rule('required', ['title','url','email','language'])->message($this->lang['label_require']);
        $v->rule('email', 'email');
        
        $v->labels(array(
            'title' => $this->lang['config_title'],
            'url' => $this->lang['config_url'],
            'email' => $this->lang['config_email'],
            'language' => $this->lang['config_lang'],
        ));
        
        if(!$v->validate()){
            $error_txt = display_errors($v->errors());
            set_message($error_txt, 'warning');
            redirect('config');
            exit;
        }
        
        foreach($post as $key => $value){
            $this->db->update('web_config',['name' => $value],['posit' => $key]);
        }
        
        redirect('config');
    }
    
    public function save_template() {
        $post = input_post();
        var_dump($post);
        
        var_dump($_FILES);
        $info = pathinfo($_FILES['top']['name'], PATHINFO_EXTENSION);
//        $info = new SplFileObject($_FILES['top']['tmp_name']);
        var_dump($info); // get png
        exit;
    }
}

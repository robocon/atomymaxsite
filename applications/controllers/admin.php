<?php

/**
 * Description of admin
 *
 * @author robocon
 */
class Admin extends Controller {
    //put your code here

    public function index() {
        $data = array(
//            'test' => 'demo demo demo',
//            'go' => '12312123123123'
        );
        $this->view->display('admin.twig');
    }

    public function news(){
        // example
        $data = array(
            'news_title' => 'hello news'
        );
        $this->view->display('admin/news.twig', $data);
    }
}

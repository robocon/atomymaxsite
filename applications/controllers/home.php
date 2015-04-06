<?php

/**
 * Description of home
 *
 * @author robocon
 */
class Home extends Controller {
    
    public function index() {
        
        $data = array();
        
        // SELECT Latest 6 news
        $items = $this->db->select('web_news',[
            'id','topic','detail','posted','post_date','pageview','thumb'
        ],array(
            'ORDER' => 'id DESC',
            'LIMIT' => '6'
        ));
        $news_lists = array();
        foreach($items as $item){
            $item['post_date'] = stampToYmd($item['post_date'], 'd/m/Y H:i');
            $strip_detail = html_entity_decode(strip_tags($item['detail']));
            if(mb_strlen($strip_detail) > 250){
                $item['detail'] = mb_substr($strip_detail, 0, 250).'...';
            }else{
                $item['detail'] = $strip_detail;
            }
            
            $news_lists[] = $item;
        }
        $data['newses'] = $news_lists;
        
        // Select Gallery
        $data['pictures'] = $this->db->select('web_gallery',['path'],[
            'slideshow' => 1,
            'ORDER' => 'id DESC'
        ]);
        $data['picture_count'] = count($data['pictures']);
        
        $this->view->display('home.twig', $data);
    }
}

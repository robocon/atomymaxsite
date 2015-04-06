<?php

/**
 * Description of news
 *
 * @author robocon
 */
class News extends Controller {
    public $id = null;
    public function index() {
        redirect('news/page');
    }
    
    public function _id($params){
        if($this->id === null){
            $this->id = (int)$params['0'];
        }
        return $this->id;
    }
    
    public function page($params) {
        
        $data = [];
        
        $page = $params === null ? 0 : ( $params['0'] -1 ) ;
        $limit = 10;
        $limit_start = $limit * $page;
        
        $items = $this->db->select('web_news',[
            'id','topic','detail','posted','post_date','pageview','thumb'
        ],[
            'ORDER' => 'id DESC',
            'LIMIT' => [$limit_start, $limit]
        ]);
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
        
        $data['items'] = $news_lists;
        
        // Count news for pagination
        $news_rows = $this->db->count('web_news');
        $data['length'] = $news_rows;
        $data['current_page'] = $page + 1;
        $data['pagination'] = pagination($data['length'], $limit, $data['current_page']);
        
        $this->view->display('news/index.twig', $data);
    }
    
    public function details($params) {
        $id = $this->_id($params);
        $item = $this->db->get('web_news',[
            'id','topic','detail','posted','post_date','pageview','thumb','gallery'
        ],['id' => $id]);
        $item['post_date'] = stampToYmd($item['post_date'], 'd/m/Y H:i');
        
        if($item['gallery'] > 0){
            $item['pictures'] = $this->db->select('web_gallery',['path'],[
                'category' => $item['gallery'],
                'ORDER' => 'id DESC'
            ]);
        }
        
        $data['item'] = $item;
        
        // Set facebook og data
        $data['fb'] = [
            'title' => $item['topic'],
            'description' => strip_tags($item['detail']),
        ];
        
        $this->view->display('news/details.twig', $data);
    }
}

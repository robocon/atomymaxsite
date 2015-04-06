<?php

/**
 * Description of gallery
 *
 * @author robocon
 */
class Gallery extends Controller {
    
    public $id = null;
    
    public function _id($params){
        if($this->id === null){
            $this->id = (int)$params['0'];
        }
        return $this->id;
    }
    
    public function index() {
        
        $items = $this->db->select('web_gallery_category',[
            'id','category_name','post_date'
        ]);
        $item_lists = [];
        foreach($items as $item){
            
            // Get first picture
            $picture = $this->db->get('web_gallery',['path'],[
                'category' => $item['id'],
                'LIMIT' => 1,
                'ORDER' => 'id DESC'
            ]);
            $item['picture'] = $picture['path'];
            
            // Get all pictures
            $item['total'] = $this->db->count('web_gallery',['category' => $item['id']]);
            
            $item_lists[] = $item;
        }
        $data['items'] = $item_lists;
        $this->view->display('gallery/index.twig', $data);
    }
    
    public function details($params) {
        
        $id = $this->_id($params);
        
        // Get category details
        $data = $this->db->get('web_gallery_category',[
            'id','category_name','post_date'
        ],['id' => $id]);
        
        $data['post_date'] = stampToYmd($data['post_date'], 'd/m/Y H:i');
        
        // Get pictures
        $pictures = $this->db->select('web_gallery',[
            'id', 'posted', 'post_date', 'pic', 'path'
        ],[
            'category' => $id,
            'ORDER' => 'id DESC'
        ]);
        
        $item_lists = [];
        foreach ($pictures as $item) {
            $item['post_date'] = stampToYmd($item['post_date'], 'd/m/Y H:i');
            $item['picture'] = $item['path'];
            
            $item_lists[] = $item;
        }
        
        $data['pictures'] = $item_lists;
        
        $this->view->display('gallery/details.twig', $data);
    }
}

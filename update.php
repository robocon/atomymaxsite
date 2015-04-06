<?php
require 'vendor/autoload.php';
include 'includes/config.in.php';

// Database Config 
$db = new medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => DB_NAME,
    'server' => DB_HOST,
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',

    // optional
    'port' => 3306,
    // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
//        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// Copy top image template to new location
$template_file = $db->get('web_templates',['picname'],[
            'AND' => [
                'temname' => 'cli3',
                'sort' => 1
            ]
        ]);
$old_top = 'templates/cli3/images/config/'.$template_file['picname'];
$new_top = 'images/template/'.$template_file['picname'];
if(!file_exists($new_top)){
    copy($old_top, $new_top);
}

$db->query("ALTER TABLE `web_config` ADD `title` VARCHAR(255) NOT NULL AFTER `posit`;");

// Update field in config
$configs = $db->select('web_config',['posit']);
$config_keys = [];
foreach($configs as $item){
    $config_keys[] = $item['posit'];
}
if(!array_search('fb_app_id', $config_keys)){
    $db->query("INSERT INTO `web_config` (`id`, `posit`, `name`) VALUES (NULL, 'fb_app_id', NULL);");
}
if(!array_search('language', $config_keys)){
    $db->query("INSERT INTO `web_config` (`id`, `posit`, `name`) VALUES (NULL, 'language', 'th');");
}

$db->query("ALTER TABLE `web_news` ADD `gallery` INT(11) NOT NULL DEFAULT '0';");
$db->query("ALTER TABLE `web_news` ADD `slideshow` INT NULL DEFAULT '0' COMMENT 'Enable/Disable to show on slideshow' ;");
$db->query("ALTER TABLE `web_gallery` ADD `slideshow` INT NOT NULL COMMENT 'Set to slide show in home page' ;");

// Update news
$db->query("ALTER TABLE `web_news` ADD `thumb` VARCHAR(255) NULL ;");
$items = $db->select('web_news', ['id','post_date'],[
    'pic' => 1
]);

$news_folder = 'images/news/';
if(!file_exists($news_folder)){
    mkdir($news_folder);
}

foreach($items as $item){
    $file_name = $item['post_date'].'.jpg';
    $old_file = 'icon/news_'.$file_name;
    $new_file = $news_folder.$file_name;
    
    if(file_exists($old_file) && !file_exists($new_file)){
        copy($old_file, $new_file);
        $db->update('web_news', ['thumb' => $new_file], ['id' => $item['id']]);
    }
}

// Update gallery folder
$db->query("ALTER TABLE `web_gallery_category` ADD `folder` VARCHAR(255) NULL ;");
$items = $db->select('web_gallery_category', ['id','post_date','folder']);
foreach($items as $item){
    
    // Check and create new folder
    $folder_path = 'images/gallery/'.$item['post_date'];
    if(!file_exists($folder_path)){
        mkdir($folder_path);
    }

}

// Update gallery
$db->query("ALTER TABLE `web_gallery` ADD `path` VARCHAR(255) NULL ;");
$items = $db->select('web_gallery',[
    '[<]web_gallery_category(b)' => ['category' => 'id']
    ],[
        'web_gallery.id','web_gallery.post_date','web_gallery.pic','b.folder'
    ]);
foreach($items as $item){
    
    $old_path = 'images/gallery/gal_'.$item['folder'].'/'.$item['pic'];
    $new_path = 'images/gallery/'.$item['folder'].'/'.$item['pic'];
    
    if(!file_exists($new_path)){
        copy($old_path, $new_path);
        $db->update('web_gallery', ['path' => $new_path], ['id' => $item['id']]);
    }
}

/**
 * @todo Description
 * [] Combind web_member and web_admin together
 * [x] Add field level and check from web_admin if admin level=1 if not level=0
 */

// Update user level
$db->query("ALTER TABLE `web_member` ADD `level` INT NOT NULL DEFAULT '0' ;");
$db->query("ALTER TABLE `web_member` ADD `confirm_key` VARCHAR(255) NULL ;");
$users = $db->select('web_member',[
    '[<]web_admin(b)' => ['user' => 'username']
],[
    'web_member.id','b.level'
]);
foreach($users as $user){
    $db->update('web_member', [
        'level' => $user['level']
    ],['id' => $user['id']]);
}
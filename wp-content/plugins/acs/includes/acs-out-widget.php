<?php
/**
 * Name: ACS - Ads Content System
 * Author: Samuel Levy
 * Version: 1.0
 */

class Acs{
    public function __construct(){
        // add_filter('after_main_open_tag', array($this, 'printAds'));
        // $this->printAds();
        if( !is_admin() ){
            add_filter('pre_get_posts', array($this, 'printAds'));
            // add_filter('pre_get_posts','my_filter_the_search',10,1);
        }
    }

    public function printAds () {
        $url = '';
        $token = '';
        $qtt = 0;
        
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_name = $wpdb->prefix . "acs_configs";
        $configs = $wpdb->get_results("SELECT * from $table_name");

        if(isset($configs[0])){
            $url = $configs[0]->url;
            $token = $configs[0]->token;
            $qtt = $configs[0]->count;
        }
        
        $mydata = $this->getAds($url, $token);
        $extra_stuff = '<div class="props_wrapper"><div class="props">';

        if((int)$mydata->clicks < (int)$mydata->goal){
            foreach($mydata->ads as $key=>$item){
                $extra_stuff .= "<a href='".$item->url."' class='props_item_click' style='display: none;' campaign-id='".$item->id."' ad-id='".$item->ad_id."' ad-campaign-id='".$item->ad_campaign_id."' data-from='".$url."'  target='_blank'>
                <div class='props_item'>
                    <img src='".$item->img."' class=''/>
                    <p class='title'>".$item->title."</p>
                    <p>".$item->description."</p>
                </div></a>";
                if($key==($qtt-1)){
                    break;
                }
            }
        }
        else{
            echo('');
        }
        
        $extra_stuff .= '</div></div>';
        
        // return $content.$extra_stuff ;
        echo $extra_stuff;

        // return $content;
    }

    public function getAds($url, $token){
        $json = file_get_contents($url.'/wp-content/plugins/ams/json.php?token='.$token);
        $obj = json_decode($json);
        return $obj;
    }
}





<?php

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
        $url = 'http://dicadesaude.com';
        $token = '5ba0125cbbb28';
        $mydata = $this->getAds($url, $token);
        $extra_stuff = '<div class="props_wrapper"><div class="props">';

        if((int)$mydata->clicks < (int)$mydata->goal){
            foreach($mydata->ads as $item){
            $extra_stuff .= "<a href='".$item->url."' class='props_item_click' campaign-id='".$item->id."' ad-id='".$item->ad_id."' ad-campaign-id='".$item->ad_campaign_id."' data-from='".$url."'  target='_blank'>
            <div class='props_item'>
                <img src='".$item->img."' class=''/>
                <p class='title'>".$item->title."</p>
                <p>".$item->description."</p>
            </div></a>";
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





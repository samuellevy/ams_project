<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$data = json_decode(file_get_contents('php://input'), true);

$campaign_id = $data['campaign_id'];
$ad_id = $data['ad_id'];
$ip = $_SERVER['REMOTE_ADDR'];
$ad_campaign_id = $data['ad_campaign_id'];

// var_dump($data);

require_once('../../../wp-load.php');
global $wpdb;
$prefix = $wpdb->prefix;

//verifica se já votou
$count_click = $wpdb->get_results("SELECT id FROM ".$prefix."ams_clicks WHERE campaign_id = $campaign_id AND ad_id = $ad_id AND ip='$ip'");
$count_click = count($count_click);

//se não houver votos, insere voto
if($count_click==0){
    $message = 'saved';

    $table_name = $wpdb->prefix . "ams_clicks";
    $wpdb->insert(
        $table_name, //table
        array(
            'campaign_id' => $campaign_id,
            'ad_id' => $ad_id,
            'ip' => $ip
        ),
        array('%s', '%s') //data format			
    );

// atualiza campaign_id
    $ad_campaign_select = $wpdb->get_results("SELECT id, clicks FROM ".$prefix."ams_campaigns_ads WHERE id = $ad_campaign_id");
    $clicks = $ad_campaign_select[0]->clicks;
    // echo $clicks;
    $clicks++;
    $wpdb->update(
        // '".$prefix."ams_campaigns_ads', //table
        $prefix."ams_campaigns_ads", //table
        array(
            'clicks' => $clicks,
        ), //data
        array('ID' => $ad_campaign_id), //where
        array('%s'), //data format
        array('%s') //where format
    );

    // atualiza campaign
    $campaign_select = $wpdb->get_results("SELECT id, clicks FROM ".$prefix."ams_campaigns WHERE id = $campaign_id");
    $campaign_clicks = $campaign_select[0]->clicks;
    // echo $campaign_clicks;
    $campaign_clicks++;
    $wpdb->update(
        $prefix.'ams_campaigns', //table
        array(
            'clicks' => $campaign_clicks,
        ), //data
        array('ID' => $campaign_id), //where
        array('%s'), //data format
        array('%s') //where format
    );
}else{
    $message = 'not saved';
}

?>
{
    "status": 1,
    "count": "<?=$count_click?>"
    "message": "<?=$message?>"
}

<?php
$token = $_GET['token'];

require_once('../../../wp-load.php');
global $wpdb;
$table_name = $wpdb->prefix . "ams_anuncios";
$rows = $wpdb->get_results("SELECT campaign.id, campaign.clicks, campaign.click_goal, wp_ams_campaigns_ads.id as ad_campaign_id, ads.id as ad_id,ads.title, ads.file_url, ads.title, ads.url, ads.text, ads.category_id, category.name
FROM wp_ams_campaigns as campaign
JOIN wp_ams_campaigns_ads ON campaign.id = wp_ams_campaigns_ads.campaign_id
JOIN wp_ams_anuncios as ads ON wp_ams_campaigns_ads.ad_id = ads.id
JOIN wp_ams_categories as category ON ads.category_id = category.id
WHERE campaign.token='$token'");

?>
{
    "name": "name",
    "token": "xsDsaz",
    "clicks": "<?=$rows[0]->clicks?>",
    "goal": "<?=$rows[0]->click_goal?>",
    "ads": [
        <?php foreach($rows as $key=>$row): ?>
        {
            "id": "<?=$row->id?>",
            "ad_campaign_id": "<?=$row->ad_campaign_id?>",
            "ad_id": "<?=$row->ad_id?>",
            "title": "<?=$row->title?>",
            "img": "<?=$row->file_url?>",
            "description": "<?=$row->text?>",
            "url": "<?=$row->url?>",
            "category_id": "<?=$row->category_id?>"
        }
        <?=$key<count($rows)-1?',':'';?>
        <?php endforeach;?>
    ]
}
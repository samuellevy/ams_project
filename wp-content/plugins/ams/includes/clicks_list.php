<?php

function ams_clicks_list() {
    $id = $_GET["id"];
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Clicks gerais</h2>
        <div class="tablenav top">
    
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_clicks";

        $rows = $wpdb->get_results("SELECT clicks.id, campaign.title as campaign, ads.title as ad, clicks.ip, clicks.created FROM wp_ams_clicks as clicks 
        JOIN wp_ams_campaigns as campaign ON campaign.id = clicks.campaign_id
        JOIN wp_ams_anuncios as ads ON ads.id = clicks.ad_id
        WHERE clicks.campaign_id = $id");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">#</th>
                <th class="manage-column ss-list-width">Campanha</th>
                <th class="manage-column ss-list-width">Anúncio</th>
                <th class="manage-column ss-list-width">IP</th>
                <th class="manage-column ss-list-width">Data</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->campaign; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->ad; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->ip; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->created; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
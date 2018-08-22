<?php

function ams_campaign_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Campanhas</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=ams_campaign_create'); ?>">Novo</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_campaigns";
        $ads_table = $wpdb->prefix . "ams_anuncios";

        $campaigns = $wpdb->get_results("SELECT * from $table_name");
        $ads = $wpdb->get_results("SELECT * from $ads_table");
        
        echo('<pre>');
        var_dump($ads);
        echo('</pre>');
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Título</th>
                <th class="manage-column ss-list-width">Url</th>
                <th class="manage-column ss-list-width">Valor</th>
                <th class="manage-column ss-list-width">Meta de clicks</th>
                <th class="manage-column ss-list-width">Blog</th>
                <th class="manage-column ss-list-width">Responsável pagamento</th>
                <th class="manage-column ss-list-width">Anúncios</th>
                <th class="manage-column ss-list-width">Data</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($campaigns as $campaign) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $campaign->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->title; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->url; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->value; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->click_goal; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->blog_id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->owner; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->status; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $campaign->date; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=blogs_update&id=' . $campaign->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
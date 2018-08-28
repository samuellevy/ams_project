<?php

function ads_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Anúncios</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=ams_ads_create'); ?>">Novo</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_anuncios";
        $prefix = $wpdb->prefix;

        $rows = $wpdb->get_results("SELECT ads.*, category.name as category_name from ".$prefix."ams_anuncios as ads INNER JOIN ".$prefix."ams_categories as category ON ads.category_id=category.id");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Título</th>
                <th class="manage-column ss-list-width">Url</th>
                <th class="manage-column ss-list-width">Text</th>
                <th class="manage-column ss-list-width">Valor</th>
                <th class="manage-column ss-list-width">Categoria</th>
                <th class="manage-column ss-list-width">Imagem</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->title; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->url; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->text; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->value; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->category_name; ?></td>
                    <td class="manage-column ss-list-width">
                        <img src="<?php echo $row->file_url; ?>"/>
                    </td>
                    <td><a href="<?php echo admin_url('admin.php?page=ads_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
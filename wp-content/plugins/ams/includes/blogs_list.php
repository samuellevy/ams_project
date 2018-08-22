<?php

function blogs_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Blogs</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=sinetiks_schools_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_blogs";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Blog</th>
                <th class="manage-column ss-list-width">Url</th>
                <th class="manage-column ss-list-width">Dono do Blog</th>
                <th class="manage-column ss-list-width">Documento</th>
                <th class="manage-column ss-list-width">E-mail</th>
                <th class="manage-column ss-list-width">WhatsApp</th>
                <th class="manage-column ss-list-width">Dados Bancários</th>
                <th class="manage-column ss-list-width">Token</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->url; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->owner; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->document; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->email; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->whatsapp; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->bank; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->token; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=blogs_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}
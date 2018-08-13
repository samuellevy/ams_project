<?php

function ams_categories_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ams_categories";
    $id = $_GET["id"];

    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array(
                    'name' => $_POST['name'],
                ), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } 
    else {
        $blogs = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
        $blog = $blogs[0];
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Categorias</h2>

        <?php if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>School deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=ams_categories_list') ?>">&laquo; Listar categorias</a>

        <?php } else if (isset($_POST['update'])) { ?>
            <div class="updated"><p>School updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=ams_categories_list') ?>">&laquo; Listar categorias</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr>
                        <th class="ss-th-width">Nome do site</th>
                        <td><input type="text" name="name" class="ss-field-width" value="<?=$blog->name?>"/></td>
                    </tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
            </form>
        <?php } ?>

    </div>
    <?php
}
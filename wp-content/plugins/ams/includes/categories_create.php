<?php

function ams_categories_create() {
    $name = '';
    //insert
    // var_dump($_POST);
    if ($_POST!=null) {
        $name = $_POST["name"];
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_categories";

        $wpdb->insert(
            $table_name, //table
            array(
                'name' => $_POST['name'],
            ),
            array('%s', '%s') //data format			
        );
        $message="Nova categoria inserida com sucesso!";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Adicionar nova categoria</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Nome do site</th>
                    <td><input type="text" name="name" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' value='Salvar' class='button'>
        </form>
    </div>
    <?php
}
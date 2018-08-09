<?php

function blogs_create() {
    $name = '';
    //insert
    // var_dump($_POST);
    if ($_POST!=null) {
        $name = $_POST["name"];
        global $wpdb;
        $table_name = $wpdb->prefix . "ams_blogs";

        $wpdb->insert(
            $table_name, //table
            array(
                'name' => $_POST['name'],
                'url' => $_POST['url'],
                'owner' => $_POST['owner'],
                'document' => $_POST['document'],
                'email' => $_POST['email'],
                'whatsapp' => $_POST['whatsapp'],
                'bank' => $_POST['bank'],
                'token' => uniqid()
            ),
            array('%s', '%s') //data format			
        );
        $message="Novo blog inserido com sucesso!";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New School</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Nome do site</th>
                    <td><input type="text" name="name" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Url</th>
                    <td><input type="text" name="url" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Dono do Site</th>
                    <td><input type="text" name="owner" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">CPF/CNPJ</th>
                    <td><input type="text" name="document" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">E-mail</th>
                    <td><input type="text" name="email" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">WhatsApp</th>
                    <td><input type="text" name="whatsapp" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Dados Bancários</th>
                    <td>
                        <textarea name="bank" class="ss-field-width"></textarea>
                    </td>
                </tr>
            </table>
            <input type='submit' value='Salvar' class='button'>
        </form>
    </div>
    <?php
}
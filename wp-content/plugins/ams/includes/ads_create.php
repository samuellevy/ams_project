<?php
function ams_ads_create() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $name = '';
    //insert
    // var_dump($_POST);
    if ($_POST!=null) {

        if(isset($_FILES['file'])){
            $pdf = $_FILES['file'];

            // Use the wordpress function to upload
            // file corresponds to the position in the $_FILES array
            // 0 means the content is not associated with any other posts
            $uploaded=media_handle_upload('file', 0);
            // Error checking using WP functions
            if(is_wp_error($uploaded)){
                    echo "Error uploading file: " . $uploaded->get_error_message();
            }else{
                    // echo "File upload successful! ID: ".$uploaded;
                    // echo wp_get_attachment_url($uploaded);
            }
        }

        $table_name = $wpdb->prefix . "ams_anuncios";

        $wpdb->insert(
            $table_name, //table
            array(
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'url' => $_POST['url'],
                'value' => $_POST['value'],
                'category_id' => $_POST['category_id'],
                'file_id' => $uploaded,
                'file_url' => wp_get_attachment_url($uploaded),
            ),
            array('%s', '%s') //data format			
        );
        $message="Novo anúncio inserido com sucesso!";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Adicionar novo anúncio</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Título</th>
                    <td><input type="text" name="title" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Url</th>
                    <td><input type="text" name="url" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Valor</th>
                    <td><input type="text" name="value" class="ss-field-width" /></td>
                </tr>
                <?php
                $categories = $wpdb->get_results("SELECT * from ".$prefix."ams_categories");
                ?>
                <tr>
                    <th class="ss-th-width">Categoria</th>
                    <td>
                    <select name='category_id'>
                        <?php foreach($categories as $category):?>
                            <option value='<?=$category->id;?>'><?=$category->name;?></option>
                        <?php endforeach;?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th class="ss-th-width">Texto</th>
                    <td>
                        <textarea name="text" class="ss-field-width"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><input type='file' id='file' name='file'/></td>
                </tr>
                
            </table>
            <input type='submit' value='Salvar' class='button'>
        </form>
    </div>
    <?php
}
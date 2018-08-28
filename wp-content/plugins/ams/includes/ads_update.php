<?php

function ads_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ams_anuncios";
    $prefix = $wpdb->prefix;
    $id = $_GET["id"];

    if (isset($_POST['update'])) {
        var_dump($_POST);
        if(isset($_FILES['file'])){
            $pdf = $_FILES['file'];
            $file_id = $_POST['file_id'];
            $file_url = $_POST['file_url'];
            
            // Use the wordpress function to upload
            // file corresponds to the position in the $_FILES array
            // 0 means the content is not associated with any other posts
            $uploaded=media_handle_upload('file', 0);
            // Error checking using WP functions
            if(is_wp_error($uploaded)){
                    echo "Error uploading file: " . $uploaded->get_error_message();
            }else{
                wp_delete_attachment($file_id);
                $file_id = $uploaded;
                $file_url = wp_get_attachment_url($uploaded);
                    // echo "File upload successful! ID: ".$uploaded;
                    // echo wp_get_attachment_url($uploaded);
            }
        }
        
        $wpdb->update(
                $table_name, //table
                array(
                    'title' => $_POST['title'],
                    'text' => $_POST['text'],
                    'url' => $_POST['url'],
                    'value' => $_POST['value'],
                    'category_id' => $_POST['category_id'],
                    'file_id' => $file_id,
                    'file_url' => $file_url,
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
        $ads = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
        $ad = $ads[0];
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Atualizar anúncio</h2>

        <?php if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>School deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=blogs_list') ?>">&laquo; Back to blogs list</a>

        <?php } else if (isset($_POST['update'])) { ?>
            <div class="updated"><p>School updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=blogs_list') ?>">&laquo; Back to blogs list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Título</th>
                    <td><input type="text" name="title" class="ss-field-width" value="<?=$ad->title?>" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Url</th>
                    <td><input type="text" name="url" class="ss-field-width" value="<?=$ad->url?>"/></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Valor</th>
                    <td><input type="text" name="value" class="ss-field-width" value="<?=$ad->value?>" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Categoria</th>
                    <td><input type="text" name="category_id" class="ss-field-width" value="<?=$ad->category_id?>"/></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Texto</th>
                    <td>
                        <textarea name="text" class="ss-field-width"><?=$ad->text?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if(isset($ad->file_url)):?>
                            <img src="<?=$ad->file_url?>"/>
                        <?php endif;?>
                        <input type='hidden' name='file_url' value='<?=$ad->file_url?>'/>
                        <input type='hidden' name='file_id' value='<?=$ad->file_id?>'/>
                        <input type='file' id='file' name='file'/>
                    </td>
                </tr>
                
            </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
            </form>
        <?php } ?>

    </div>
    <?php
}
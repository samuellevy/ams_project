<?php


function ams_campaign_create() {
    global $wpdb;
    $timestamp = mktime(date("H")-3, date("i"), date("s"), date("m"), date("d"), date("Y"));
    $name = '';
    //insert
    echo('<pre>');
    var_dump($_POST);
    echo('</pre>');
    if ($_POST!=null) {
        $table_name = $wpdb->prefix . "ams_campaigns";

        $wpdb->insert(
            $table_name, //table
            array(
                'title' => $_POST['title'],
                'url' => $_POST['url'],
                'value' => $_POST['value'],
                'click_goal' => $_POST['click_goal'],
                'blog_id' => $_POST['blog_id'],
                'owner' => $_POST['owner'],
                'obs' => $_POST['obs'],
                'date' => gmdate("Y-m-d H:i:s", $timestamp),
                'token' => uniqid()
            ),
            array('%s', '%s') //data format			
        );

        $lastid = $wpdb->insert_id;
        $ads = $_POST['ads'];

        foreach($ads as $ad):
            $wpdb->insert(
                $wpdb->prefix . 'ams_campaigns_ads', //table
                array(
                    'campaign_id' => $lastid,
                    'ad_id' => $ad,
                ),
                array('%s', '%s') //data format			
            );
        endforeach;
       
        $message="Novo anúncio inserido com sucesso!";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Iniciar nova campanha</h2>
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
                <tr>
                    <th class="ss-th-width">Meta de clicks</th>
                    <td><input type="text" name="click_goal" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Pago por</th>
                    <td><input type="text" name="owner" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">OBS</th>
                    <td><textarea type="text" name="obs" class="ss-field-width"></textarea></td>
                </tr>
                <?php
                $blogs = $wpdb->get_results("SELECT * from wp_ams_blogs");
                $ads = $wpdb->get_results("SELECT * from wp_ams_anuncios");
                ?>
                <tr>
                    <th class="ss-th-width">Blog</th>
                    <td>
                    <select name='blog_id'>
                        <?php foreach($blogs as $blog):?>
                            <option value='<?=$blog->id;?>'><?=$blog->name;?></option>
                        <?php endforeach;?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <th class="ss-th-width">Anúncio</th>
                    <td>
                    <select name='ads[]' multiple>
                        <?php foreach($ads as $ad):?>
                            <option value='<?=$ad->id;?>'>#<?=$ad->id;?> - <?=$ad->title;?></option>
                        <?php endforeach;?>
                    </select>
                    </td>
                </tr>
            </table>
            <input type='submit' value='Salvar' class='button'>
        </form>
    </div>
    <?php
}
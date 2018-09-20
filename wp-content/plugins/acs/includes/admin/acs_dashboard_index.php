<?php

function getAds($url, $token){
    $json = file_get_contents($url.'/wp-content/plugins/ams/json.php?token='.$token);
    $obj = json_decode($json);
    return $obj;
}

function acs_dashboard_index() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $table_name = $wpdb->prefix . "acs_configs";
    $configs = $wpdb->get_results("SELECT * from $table_name");
    $infos=null;
    if(count($configs)!=0){
        // get clicks
        $infos = getAds($configs[0]->url,$configs[0]->token);
    }
    if ($_POST!=null) {
        if(count($configs)==0){
            $wpdb->insert(
                $table_name, //table
                array(
                    'token' => $_POST['token'],
                    'title' => $_POST['title'],
                    'count' => $_POST['count'],
                    'url' => 'https://dicadesaude.com',
                    // 'url' => $_POST['url'],
                ),
                array('%s', '%s') //data format			
            );
        } else{
            $id = $configs[0]->id;
            $wpdb->update(
                $table_name, //table
                array(
                    'token' => $_POST['token'],
                    'title' => $_POST['title'],
                    'count' => $_POST['count'],
                    'url' => 'https://dicadesaude.com',
                ), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
            );
        }

        $configs = $wpdb->get_results("SELECT * from $table_name");
        $infos=null;
        if(count($configs)!=0){
            // get clicks
            $infos = getAds($configs[0]->url,$configs[0]->token);
        }
        $message="Campanha configurada.";
    }

    
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/ams/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>ACS - Configurações</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Token</th>
                    <td><input type="text" name="token" class="ss-field-width" value="<?=isset($configs[0])?$configs[0]->token:''?>" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Título</th>
                    <td><input type="text" name="title" class="ss-field-width" value="<?=isset($configs[0])?$configs[0]->title:''?>" /></td>
                </tr>
                <!-- <tr>
                    <th class="ss-th-width">Url</th>
                    <td><input type="text" name="url" class="ss-field-width" value="<?=isset($configs[0])?$configs[0]->url:''?>" /></td>
                </tr> -->
                <tr>
                    <th class="ss-th-width">Quantidade de anúncios</th>
                    <td><input type="text" name="count" class="ss-field-width" value="<?=isset($configs[0])?$configs[0]->count:''?>" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Clicks únicos/Meta</th>
                    <td><?=$infos!=null?$infos->clicks.'/'.$infos->goal:'0/10';?></td>
                </tr>
            </table>
            <input type='submit' value='Salvar' class='button'>
        </form>
    </div>
    <?php
}
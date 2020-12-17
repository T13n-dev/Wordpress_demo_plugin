<?php 
/*
Plugin Name: HuuTien
Plugin URI: https://www.facebook.com/Tien.it.ntt
Description: First plugin
Author: HuuTien
Author URI: https://www.facebook.com/Tien.it.ntt
*/

// if(is_admin()){
//     require_once dirname(__FILE__) . '/includes/admin.php';
// } else {
//     require_once dirname(__FILE__) . '/includes/public.php';
// }

function pr($value) {
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

// echo '<br>'. plugin_dir_path(__FILE__);

// pr( dirname(__FILE__) . '/includes/admin.php' );
// pr( plugins_url('/css/abc.css', '__FILE__') );
// pr( __FILE__ );
// pr(unserialize('a:3:{s:4:"name";s:8:"Huu Tien";s:3:"age";s:2:"23";s:6:"status";s:8:"unemploy";}'));

register_activation_hook(__FILE__, 'huutien_mp_active');
register_deactivation_hook(__FILE__, 'huutien_mp_deactive');
register_uninstall_hook(__FILE__, 'huutien_mp_uninstall');

function huutien_mp_active() {
    global $wpdb;

    $table_name = $wpdb->prefix . "huutien_mp_table";
    if($wpdb->get_var("SHOW TABLES LIKE '". $table_name."'") != $table_name ){
        $sql = "CREATE TABLE `" . $table_name . "` (
            `myid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
            `my_name` varchar(50) DEFAULT NULL,
            PRIMARY KEY (`myid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    
        dbDelta($sql);
    }

    // Create Option
    $huutien_mp_option = array(
        'name' => 'Huu Tien',
        'age' => '23',
        'status' => 'unemploy'
    );

    // Option API
    add_option ('huutien_mp_option', $huutien_mp_option);

    // Active, must change autoload = yes in huutien_mp_option
}

function huutien_mp_deactive() {
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $wpdb->update(
        $table_name, // table name
        array('autoload'=>'no'), // value
        array('option_name'=>'huutien_mp_option'), // where
        array('%s'), // format value
        array('%s') // format where
    );
}

?>
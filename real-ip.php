<?php
/**
* Plugin Name: Real IP Detector
* Description: This plugin allow WordPress to detect visitors Real IP Address when WordPress is behind of Reverse Proxy, Load Balancer.  It will start working as soon as you activate it.
* Version: 1.4
* Author: Masoud Binaei
* License: GPL2
* Plugin URI: http://central-hosting.com/blog/real-ip-detector/
*/



add_action('admin_menu', 'realipd_plugin_setup_menu');
function realipd_plugin_setup_menu(){
add_menu_page( 'Real IP Detector', 'Real IP Detector', 'manage_options', 'real-ip-detector', 'realip_init','dashicons-location' );
}
function realip_init(){
$p_locale = get_bloginfo('language');

 echo '

	

<div class="wrap" style="margin:auto;">
<img border="0" src="' . plugins_url( 'banner-772x250.png', __FILE__ ) . '" width="772" height="250"><br>';
if($p_locale  == 'fa-IR'){
    
echo'
<div align="right" class="notice notice-success">
        <p> اگر به دنبال یک هاست حرفه ای هستید ما <strong><a href="https://www.central-hosting.com/" target="_blank">سنترال هاستینگ</a></strong> را پیشنهاد می کنیم</p>
    </div>';
}


echo'

<h1>Real IP Detector</h1>
<p>
Description:This plugin allow WordPress to detect Real visitors IP Address when WordPress is behind of Reverse Proxy, Load Balancer or CDN.
<br>It will start working as soon as you activate it.  <br>
<h2>It is also compatible:</h2>
Cloudflare.com<br>
geniusguard.com<br>
central-hosting.com<br>
incapsula.com<br>
sucuri.net<br>
barracuda.com<br>
f5.com And Other...<br>
 </p>
  <br> <a href="https://www.central-hosting.com/">Need the DDoS Protected Hosting for WordPress? click Here</a>
 
 </div>



		';
}
$p_locale = get_bloginfo('language');

if($p_locale=="fa-IR"){
function sample_admin_notice__success() {
    
     $user_id = get_current_user_id();
    if ( !get_user_meta( $user_id, 'realip_plugin_notice_dismissed' ) ) 
{
    
    ?>
    <div class="notice notice-success ">
        <p><?php _e( 'پلاگین Real IP Detector به روز شد، اگر به دنبال یک هاست حرفه ای هستید ما <strong><a href="https://www.central-hosting.com/" target="_blank">سنترال هاستینگ</a></strong> را پیشنهاد می کنیم. -<a href="admin.php?page=real-ip-detector&real-ip-dismissed">بستن</a>', 'sample-text-domain' ); ?></p>

    </div>
    <?php
}
}
add_action( 'admin_notices', 'sample_admin_notice__success' );

function realip_plugin_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['real-ip-dismissed'] ) )
        add_user_meta( $user_id, 'realip_plugin_notice_dismissed', 'true', true );
}
add_action( 'admin_init', 'realip_plugin_notice_dismissed' );

}


if (isset($_SERVER['HTTP_CLIENT_IP'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CLIENT_IP'];
}elseif(isset($_SERVER['HTTP_CF_CONNECTING_IP'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
}elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED'];
}elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
}elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_FORWARDED_FOR'];
}elseif(isset($_SERVER['HTTP_FORWARDED'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_FORWARDED'];
}elseif(isset($_SERVER['HTTP_X_REAL_IP'])){
$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
}
if(isset($_SERVER["HTTP_CF_VISITOR"])){
if (strpos($_SERVER["HTTP_CF_VISITOR"], "https") || $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = 'on';
}}
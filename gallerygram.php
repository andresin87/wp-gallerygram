<?PHP
/* 
    Plugin Name: Gallerygram 
    Plugin URI: http://codecanyon.net/item/gallerygram/7549360
    Description: Your photos from instagram
    Author: zhan.shatmanov
    Version: 2.0
    Author URI: http://shatmanov.com 
*/
 /*define( 'WP_DEBUG', true );
 ini_set('display_errors', '1');
 ini_set('error_reporting', E_ALL);*/
// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

		global $wpdb;
							
function gallerygram_cron_activation() { 
wp_schedule_event(time(), 'twicedaily', 'cron_daily'); 
}

function gallerygrami_cron_deactivation() { 
wp_clear_scheduled_hook('cron_daily'); 
}

							
		// Если мы в адм. интерфейсе
		if ( is_admin() ) {
			
			// Добавляем стили и скрипты
			add_action('admin_init', 'gallerygram_admin_init');
			add_action('admin_menu', 'gallerygram_admin_menu');
			
		} else {
 			// Добавляем стили и скрипты
			add_action('wp_print_scripts', 'site_load_scripts');
			add_action('wp_print_styles', 'site_load_styles');
 
 			add_shortcode( 'gallerygram', 'gallerygram_embed_shortcode');
		}
							
								
	$plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain('gallerygram', false, "$plugin_dir/lang");
    
    function gallerygram_admin_init()
    {
        /* Регистрируем наш стиль. */
		wp_register_style('myGallerygramStyle', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/css/style.css');
        wp_register_style('myGallerygramStyle2', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/css/bootstrap.min.css');
    }	
	
	function site_load_scripts()
    {
        /* Регистрируем наш стиль. */
		wp_register_script('myGallerygramSiteJS', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/js/gallerygram.lib.js');
		wp_enqueue_script('myGallerygramSiteJS');
		wp_register_script('GallerygramSiteJS', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/js/gallerygram.js');
		wp_enqueue_script('GallerygramSiteJS');
		wp_register_script('mediaelementplayer', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/videoplayer/mediaelement-and-player.min.js');
		wp_enqueue_script('mediaelementplayer');
    }
	
	
	function gallerygram_footer_js() {
?>
<script type="text/javascript">
var ias = jQuery.ias({
    container : "#instagramPhotos", //обёртка всех постов
    item: ".instablock", // один пост
    pagination: ".instapagi", // блок с навигацией
    next: "a.instapaginext", // ссылка на следующую страницу
});
ias.extension(new IASSpinnerExtension({src: '<?php echo WP_PLUGIN_URL; ?>/<?php echo basename(dirname(__FILE__)); ?>/images/loading.gif'}));
ias.extension(new IASNoneLeftExtension({html: '<div style="text-align:center;width: 100%;display: table;"><p><em><?php echo __( 'No more photos!', 'gallerygram' ); ?> :(</em></p></div>'}));

</script>
<?php
	}
	add_action('wp_footer', 'gallerygram_footer_js');
	


	function site_load_styles()
    {
		wp_register_style('myGallerygramSiteStyles', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/css/gallerygramstyle.css');
		$filename =  get_template_directory() . '/gallerygram.css';
if (file_exists($filename)) {
	//Файл есть, грузим стиль с папки темы
		wp_register_style('myGallerygramSiteStyle', get_template_directory_uri() . '/css/gallerygram.css');
} else {
	//Файла нет, грузим стиль с папки плагина
		wp_register_style('myGallerygramSiteStyle', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/css/gallerygram.css');
}
		wp_register_style('mediaelementplayerStyle', WP_PLUGIN_URL . '/'.basename(dirname(__FILE__)).'/videoplayer/mediaelementplayer.min.css');
		wp_enqueue_style('myGallerygramSiteStyle');
		wp_enqueue_style('myGallerygramSiteStyles');
		wp_enqueue_style('mediaelementplayerStyle');
    }


		//Plugin Menu Link
		function gallerygram_action_links( $links ) {
		   $links[] = '<a href="'. admin_url( 'admin.php?page=gallerygram' ) .'">'.__( 'General Settings', 'gallerygram' ).'</a>';
		   $links[] = '<a href="'. admin_url( 'admin.php?page=gallerygram_help' ) .'">'.__( 'Help', 'gallerygram' ).'</a>';
		   return $links;
		}
		#plugin page links
		add_filter('plugin_action_links_'.plugin_basename( __FILE__ ), 'gallerygram_action_links' );		

    function gallerygram_admin_menu()
    {
							  
		// Добавляем основной раздел меню
		$page = add_menu_page(__('Setting', 'gallerygram'), 'Gallerygram', '9', 'gallerygram', 'gallerygram_config', 'dashicons-format-gallery');
		// Добавляем дополнительный раздел
		$page2 = add_submenu_page( 'gallerygram', __('Help', 'gallerygram'), __('Help', 'gallerygram'), '9', 'gallerygram_help', 'get_gallerygram_help');
		
		   
        /* Используем зарегистрированный хендл страницы 
           чтобы добавить хук на загрузку стилей */
        add_action('admin_print_styles-' . $page, 'gallerygram_admin_styles');
		add_action('admin_print_styles-' . $page2, 'gallerygram_admin_styles');
    }
    
    function gallerygram_admin_styles()
    {
        /*
         * Эта функция будет вызвана только на странице плагина, 
           поставим наш стиль в очередь здесь */
        wp_enqueue_style('myGallerygramStyle');
		wp_enqueue_style('myGallerygramStyle2');
		wp_enqueue_style('myGallerygramStyle3');
    }
	
	
	//получаем ID пользователя
	
	function gallerygram_GetUserID($gallerygramUserID, $gallerygramAccessToken){
		
		if (is_numeric($gallerygramUserID)) {
		$user_id = $gallerygramUserID;
		} else {

		$search = array ("'http://instagram.com/'si",
		                 "'https://instagram.com/'si",
						 "'instagram.com/'si",
						 "'http://www.instagram.com/'si",
						 "'https://www.instagram.com/'si",
						 "'www.instagram.com/'si",); 
				 
		$search_login = preg_replace($search, "$1", $gallerygramUserID);

		$url_gallerygramUserID = 'https://api.instagram.com/v1/users/search?q='.$search_login.'&access_token='.$gallerygramAccessToken;

				$contentJsonGallerygramUserID = @file_get_contents($url_gallerygramUserID);
				if($contentJsonGallerygramUserID === FALSE) {
					$gallerygramUserID_curl = curl_init();
					curl_setopt($gallerygramUserID_curl, CURLOPT_URL, $url_gallerygramUserID);
					curl_setopt($gallerygramUserID_curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($gallerygramUserID_curl, CURLOPT_HEADER, false);
					$gallerygramUserID_curlgeturl = curl_exec($gallerygramUserID_curl);
				}else {$gallerygramUserID_curlgeturl = $contentJsonGallerygramUserID;}
		        $jsonDataGallerygramUserID = json_decode($gallerygramUserID_curlgeturl);

		if (isset($jsonDataGallerygramUserID->data[0]->id)){
			$gallerygramUserIDs = $jsonDataGallerygramUserID->data[0]->id;
		}else{
			$gallerygramUserIDs = $gallerygramUserID;
		}
		$user_id = $gallerygramUserIDs;	
		}
		return $user_id;
		
	}
	
    
	/**
	 * Выводим список отзывов для редактирования
	 */
	function gallerygram_config()
	{
		global $wpdb;
		
		$action = isset($_GET['action']) ? $_GET['action'] : null ;
		
		switch ($action) {
		
			case 'get_access_token':
 
			include_once('access_token.php');
			
			break;
			
			case 'oauth':
 
			include_once('success.php');
			
			break;
		
			default:
				include_once('main.php');
		}
		
	}
	/**
	 * Показываем статическую страницу
	 */
	
	function get_gallerygram_help()
	{
		
		include_once('help.php');
		
	}
	
	function gallerygram_embed_shortcode($atts){
		
		include_once('templeate.php');
		
	}
	
	include_once('widget.php');	
	

	/**
	 * Активация плагина
	 */
	function activate() 
	{
		global $wpdb;
		
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');	
		
		## Определение версии mysql
		if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
			if ( ! empty($wpdb->charset) )
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty($wpdb->collate) )
				$charset_collate .= " COLLATE $wpdb->collate";
		}
		
		## Структура нашей таблицы для галлереи
		$sql_table_gallerygram_bd = "
				CREATE TABLE `".$wpdb->prefix."gallerygram_bd` (
					`ID` int(10) unsigned NOT NULL auto_increment,
					`access_token` varchar(255) default NULL,
					`user_id` varchar(200) default NULL,
					`tag` varchar(200) NOT NULL,
					`tagoruserid` varchar(200) NOT NULL,
					`post_id` varchar(200) default NULL,
					`client_secret` varchar(200) NOT NULL,
					`client_id` varchar(200) NOT NULL,
					`num_img` varchar(200) default NULL,
					PRIMARY KEY  (`ID`)
				)".$charset_collate." AUTO_INCREMENT=2;";
		
		$sql_table_gallerygram_bd2 = "INSERT INTO `".$wpdb->prefix."gallerygram_bd` (`ID`, `access_token`, `user_id`, `tag`, `tagoruserid`, `post_id`, `client_secret`, `client_id`, `num_img`) VALUES
(1, '', '', '', 'userid', '', '', '', '20')";
		## Проверка на существование таблицы	
		if ( $wpdb->get_var("show tables like '".$wpdb->prefix . 'gallerygram_bd'."'") != $wpdb->prefix . 'gallerygram_bd' ) {
			dbDelta($sql_table_gallerygram_bd);
			dbDelta($sql_table_gallerygram_bd2);
		}
		
	}
register_activation_hook( __FILE__, 'activate' );	

	function deactivate() 
	{
		return true;
	}
register_deactivation_hook( __FILE__, 'deactivate' );

	/**
	 * Удаление плагина
	 */
	function uninstall() 
	{
		global $wpdb;
		
		$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}gallerygram_bd");
	}
register_uninstall_hook( __FILE__, 'uninstall' );

function gallerygram_cron_daily() {

// упрощенная функция scandir
function myscandir($dir)
{
    $list = scandir($dir);
    unset($list[0],$list[1]);
    return array_values($list);
}

// функция очищения папки
function clear_dir($dir)
{
    $list = myscandir($dir);
    
    foreach ($list as $file)
    {
        if (is_dir($dir.$file))
        {
            clear_dir($dir.$file.'/');
            rmdir($dir.$file);
        }
        else
        {
            unlink($dir.$file);
        }
    }
}

// пример использования
clear_dir(dirname(__FILE__).'/cache/');

}

register_activation_hook(__FILE__, 'gallerygram_cron_activation'); 
register_deactivation_hook(__FILE__, 'gallerygram_cron_deactivation'); 
add_action('cron_daily', 'gallerygram_cron_daily'); 
add_action('widgets_init', 'register_gallerygram_widget');
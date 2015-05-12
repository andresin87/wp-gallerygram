<?php

/**
 * Adds Gallerygram_Widget widget.
 */
class Gallerygram_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'gallerygram_widget', // Base ID
			__( 'Gallerygram', 'gallerygram' ), // Name
			array( 'description' => __( 'Your photos from instagram.', 'gallerygram' ), ) // Args
		);
	}

	/**
	 * Содержимое виджета
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		} ?>
<!-- Gallerygram START -->
<?PHP
if (!empty($instance['gallerygramWID'])) {
	$gallerygramWIDa=$instance['gallerygramWID'];
}else {$gallerygramWIDa='';}

if (!empty($instance['select'])) {
	$gallerygramSa=$instance['select'];
}else {$gallerygramSa='userid';}

if (!empty($instance['num_gallerygram_pic'])) {
	$num_gallerygram_picA=$instance['num_gallerygram_pic'];
}else {$num_gallerygram_picA='6';}

function get_gallerygram_widget($gallerygramWIDa,$gallerygramSa,$num_gallerygram_picA){
global $wpdb;
$gallerygram_info = $wpdb->get_row( "SELECT * FROM `" . $wpdb->prefix . 'gallerygram_bd' . "` WHERE ID = 1" );

ini_set("allow_url_include", true);

	$gallerygramUserID = $gallerygramWIDa;
	$gallerygramAccessToken = $gallerygram_info->access_token;
	
	$gallerygramUser = gallerygram_GetUserID($gallerygramWIDa,$gallerygramAccessToken);


//Если поле заполнили
if (!empty($gallerygramUser)){
	
if ($gallerygramSa == 'userid'){
    $gallerygram_url_w = 'https://api.instagram.com/v1/users/'.$gallerygramUser.'/media/recent/?access_token='.$gallerygram_info->access_token.'&count='.$num_gallerygram_picA;
}else if ($gallerygramSa == 'tags'){
	$gallerygram_url_w = 'https://api.instagram.com/v1/tags/'.$gallerygramWIDa.'/media/recent?client_id='.$gallerygram_info->client_id.'&count='.$num_gallerygram_picA;
}
//если просто поле пустое
}else{
if (($gallerygram_info->tagoruserid)=='userid'){
    $gallerygram_url_w = 'https://api.instagram.com/v1/users/'.$gallerygram_info->user_id.'/media/recent/?access_token='.$gallerygram_info->access_token.'&count='.$num_gallerygram_picA;
}else if (($gallerygram_info->tagoruserid)=='tags'){
	$gallerygram_url_w = 'https://api.instagram.com/v1/tags/'.$gallerygram_info->tag.'/media/recent?client_id='.$gallerygram_info->client_id.'&count='.$num_gallerygram_picA;
}
}

    //Also Perhaps you should cache the results as the instagram API is slow
	$gallerygram_cache = dirname(__FILE__).'/cache/widget_'.sha1($gallerygram_url_w).'.json';

    if(file_exists($gallerygram_cache) && filemtime($gallerygram_cache) > time() - 10*60){
        // If a cache file exists, and it is newer than 1 hour, use it
		$contentJsonGallerygram = @file_get_contents($gallerygram_cache);
		if($contentJsonGallerygram === FALSE) {
			$gallerygram_curl = curl_init();
			curl_setopt($gallerygram_curl, CURLOPT_URL, $gallerygram_cache);
			curl_setopt($gallerygram_curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($gallerygram_curl, CURLOPT_HEADER, false);
			$gallerygram_curlgeturl = curl_exec($gallerygram_curl);
		}else {$gallerygram_curlgeturl = $contentJsonGallerygram;}
        $jsonDataGallerygram = json_decode($gallerygram_curlgeturl);
    }else{
		
		$contentJsonGallerygram = @file_get_contents($gallerygram_url_w);
		if($contentJsonGallerygram === FALSE) {
			$gallerygram_curl = curl_init();
			curl_setopt($gallerygram_curl, CURLOPT_URL, $gallerygram_url_w);
			curl_setopt($gallerygram_curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($gallerygram_curl, CURLOPT_HEADER, false);
			$gallerygram_curlgeturl = curl_exec($gallerygram_curl);
		}else {$gallerygram_curlgeturl = $contentJsonGallerygram;}
		
        $jsonDataGallerygram = json_decode(($gallerygram_curlgeturl));
        file_put_contents($gallerygram_cache,json_encode($jsonDataGallerygram));
    }

    $resultGallerygram = '<ul id="gallerygram_widget">'.PHP_EOL;
    foreach ($jsonDataGallerygram->data as $key=>$value) {
		if (!empty($value->videos->standard_resolution->url)){$gallerygramBP = '<div class="mejs-overlay-button"></div>';$gallerygramVideoURL = $value->videos->standard_resolution->url;}else{$gallerygramBP = '';$gallerygramVideoURL = '';}
		if (!empty($value->caption->text)){$gramtitle = htmlentities($value->caption->text, ENT_QUOTES, "UTF-8");}else{$gramtitle = '';}
        $resultGallerygram .= '<li><div class="wgw" gram-video="'.$gallerygramVideoURL.'" gram-img="'.$value->images->standard_resolution->url.'" gram-title="'.$gramtitle.'" gram-url="'.$value->link.'" gram-user="'.$value->user->username.'" gram-user-pic="'.$value->user->profile_picture.'" gram-id="'.$value->id.'" gram-comment-count="'.$value->comments->count.'">
			'.$gallerygramBP.'
			<img src="'.$value->images->thumbnail->url.'" alt="'.$value->user->username.'" name="'.$value->user->username.'" title="'.$gramtitle.'">
    </div><div id="l'.$value->id.'" style="display:none;">'.PHP_EOL;;
	$reallikecount = $value->likes->data;
	$resultGallerygramreallikecount = count($reallikecount);
	if ($resultGallerygramreallikecount<=4){$x_c = $resultGallerygramreallikecount;}else{$x_c = 4;}
	
	for ($x=0, $y=0; $x<$x_c; $x++, $y++) $resultGallerygram .= '<a href="//instagram.com/'.$value->likes->data[$x]->username.'" title="'.$value->likes->data[$x]->full_name.'" target="_blank"><img src="'.$value->likes->data[$x]->profile_picture.'" class="like_avatar" align="left"></a>';
	
	$likecount = $value->likes->count;
	
	if ($likecount<=4) {
		$liketext ='';
	}else{
		$likecountr = $likecount - $x_c; $liketext =' '.__( 'and', 'gallerygram' ).' '.$likecountr.' '.__( 'others like this', 'gallerygram' ).'.';
	}
		
	$resultGallerygram .= $liketext.'</div><div id="com'.$value->id.'" class="commwrapp" style="display:none;">'.PHP_EOL;;
	
	$realcomments = $value->comments->data;
	$resultGallerygramrealcomments = count($realcomments);
	for ($x=0, $y=0; $x<$resultGallerygramrealcomments; $x++, $y++) $resultGallerygram .= '<a href="//instagram.com/'.$value->comments->data[$x]->from->username.'" title="'.$value->comments->data[$x]->from->full_name.'" target="_blank"><img src="'.$value->comments->data[$x]->from->profile_picture.'" class="comm_avatar" align="left"></a><div class="comgram"><a href="//instagram.com/'.$value->comments->data[$x]->from->username.'" title="'.$value->comments->data[$x]->from->full_name.'" target="_blank">'.$value->comments->data[$x]->from->username.'</a><br>'.$value->comments->data[$x]->text.'</div><div class="instaclear"></div>';
	$resultGallerygram .= '</div></li>'.PHP_EOL;

    }
    $resultGallerygram .= '</ul>'.PHP_EOL;

    return $resultGallerygram;
}
?>
        <?=get_gallerygram_widget($gallerygramWIDa,$gallerygramSa,$num_gallerygram_picA); ?>

<!-- /Gallerygram END --> 
<?php
	}
	
	/**********************/

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Gallerygram', 'gallerygram' );
		$num_gallerygram_pic = ! empty( $instance['num_gallerygram_pic'] ) ? $instance['num_gallerygram_pic'] : '6';
		$gallerygramWID = ! empty( $instance['gallerygramWID'] ) ? $instance['gallerygramWID'] : '';
		$select = ! empty( $instance['select'] ) ? $instance['select'] : 'userid';
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
        <label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Select:', 'gallerygram'); ?></label>
        <select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
        <?php
        $options = array('userid', 'tags');
        foreach ($options as $option) {
			if ($option == 'userid'){$option_name = __('User profile', 'gallerygram');} else {$option_name = __('Tag', 'gallerygram');} 
        	echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option_name, '</option>';
        }
        ?>
        </select>
        </p>
        <p>
		<label for="<?php echo $this->get_field_id( 'gallerygramWID' ); ?>"><?php echo __( 'User/tag:', 'gallerygram' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'gallerygramWID' ); ?>" name="<?php echo $this->get_field_name( 'gallerygramWID' ); ?>" type="text" value="<?php echo esc_attr( $gallerygramWID ); ?>">
		</p>
        <p>
		<label for="<?php echo $this->get_field_id( 'num_gallerygram_pic' ); ?>"><?php echo __( 'Number of images:', 'gallerygram' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'num_gallerygram_pic' ); ?>" name="<?php echo $this->get_field_name( 'num_gallerygram_pic' ); ?>" type="text" value="<?php echo esc_attr( $num_gallerygram_pic ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['num_gallerygram_pic'] = ( ! empty( $new_instance['num_gallerygram_pic'] ) ) ? strip_tags( $new_instance['num_gallerygram_pic'] ) : '';
		$instance['gallerygramWID'] = ( ! empty( $new_instance['gallerygramWID'] ) ) ? strip_tags( $new_instance['gallerygramWID'] ) : '';
		$instance['select'] = ( ! empty( $new_instance['select'] ) ) ? strip_tags( $new_instance['select'] ) : '';

		return $instance;
	}

} // class Gallerygram_Widget

// register Gallerygram_Widget widget
function register_gallerygram_widget() {
    register_widget( 'Gallerygram_Widget' );
}
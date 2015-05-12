<!-- Gallerygram START -->
<?PHP
if (!empty($atts['tag'])) {
	$gallerygramTag=$atts['tag'];
}else {$gallerygramTag='';}

if (!empty($atts['userid'])) {
	$gallerygramUser=$atts['userid'];
}else {$gallerygramUser='';}

function get_gallerygram_gall($gallerygram_next=null,$gallerygramTag,$gallerygramUser){
global $wpdb;
$gallerygram_info = $wpdb->get_row( "SELECT * FROM `" . $wpdb->prefix . 'gallerygram_bd' . "` WHERE ID = 1" );

ini_set("allow_url_include", true);

	$gallerygramUserID = $gallerygramUser;
	$gallerygramAccessToken = $gallerygram_info->access_token;
	
	$gallerygramUser = gallerygram_GetUserID($gallerygramUserID,$gallerygramAccessToken);

//Если используется таг [gallerygram tag=""] или [gallerygram userid=""]
if (!empty($gallerygramTag)||!empty($gallerygramUser)){
	
if (!empty($gallerygramUser)){
    $gallerygram_url = 'https://api.instagram.com/v1/users/'.$gallerygramUser.'/media/recent/?access_token='.$gallerygram_info->access_token.'&count='.$gallerygram_info->num_img;
}else if (!empty($gallerygramTag)){
	$gallerygram_url = 'https://api.instagram.com/v1/tags/'.$gallerygramTag.'/media/recent?client_id='.$gallerygram_info->client_id.'&count='.$gallerygram_info->num_img;
}
//если просто [gallerygram]
}else{

if (($gallerygram_info->tagoruserid)=='userid'){
    $gallerygram_url = 'https://api.instagram.com/v1/users/'.$gallerygram_info->user_id.'/media/recent/?access_token='.$gallerygram_info->access_token.'&count='.$gallerygram_info->num_img;
}else if (($gallerygram_info->tagoruserid)=='tags'){
	$gallerygram_url = 'https://api.instagram.com/v1/tags/'.$gallerygram_info->tag.'/media/recent?client_id='.$gallerygram_info->client_id.'&count='.$gallerygram_info->num_img;
}

}

    if($gallerygram_url !== null) {
        $gallerygram_url .= '&max_id=' . $gallerygram_next;
    }

    //Also Perhaps you should cache the results as the instagram API is slow
	//$gallerygram_cache = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/gallerygram/cache/'.sha1($gallerygram_url).'.json';
	$gallerygram_cache = dirname(__FILE__).'/cache/'.sha1($gallerygram_url).'.json';
    //unlink($gallerygram_cache); // Clear the cache file if needed

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
		
		$contentJsonGallerygram = @file_get_contents($gallerygram_url);
		if($contentJsonGallerygram === FALSE) {
			$gallerygram_curl = curl_init();
			curl_setopt($gallerygram_curl, CURLOPT_URL, $gallerygram_url);
			curl_setopt($gallerygram_curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($gallerygram_curl, CURLOPT_HEADER, false);
			$gallerygram_curlgeturl = curl_exec($gallerygram_curl);
		}else {$gallerygram_curlgeturl = $contentJsonGallerygram;}
		
        $jsonDataGallerygram = json_decode(($gallerygram_curlgeturl));
        file_put_contents($gallerygram_cache,json_encode($jsonDataGallerygram));
    }

    $resultGallerygram = '<ul id="instagramPhotos">'.PHP_EOL;
    foreach ($jsonDataGallerygram->data as $key=>$value) {
		if (!empty($value->videos->standard_resolution->url)){$gallerygramBP = '<div class="mejs-overlay-button"></div>'; $gallerygramVideoURL = $value->videos->standard_resolution->url;}else{$gallerygramBP = ''; $gallerygramVideoURL = '';}
		if (!empty($value->caption->text)){$gramtitle = htmlentities($value->caption->text, ENT_QUOTES, "UTF-8");}else{$gramtitle = '';}
        $resultGallerygram .= '<li class="instablock"><div class="album" gram-video="'.$gallerygramVideoURL.'" gram-img="'.$value->images->standard_resolution->url.'" gram-title="'.$gramtitle.'" gram-url="'.$value->link.'" gram-user="'.$value->user->username.'" gram-user-pic="'.$value->user->profile_picture.'" gram-id="'.$value->id.'" gram-comment-count="'.$value->comments->count.'">
		<span class="bg"></span>
		<figure class="frame">
			'.$gallerygramBP.'
			<i><img src="'.$value->images->standard_resolution->url.'" alt="" width="'.$gallerygram_info->wh_img.'" height="'.$gallerygram_info->wh_img.'" name="'.$value->user->username.'"></i>
        </figure>
        <ul class="photo-stats">
          <li class="stat-likes"><b>'.$value->likes->count.'</b></li>
          <li class="stat-comments"><b>'.$value->comments->count.'</b></li>
        </ul>
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

	
    if(isset($jsonDataGallerygram->pagination->next_max_id)) {
        $resultGallerygram .= '<div class="instapagi"><a class="instapaginext" href="?next=' . $jsonDataGallerygram->pagination->next_max_id . '">Next</a></div>';
    }

    return $resultGallerygram;
}
?>

    <div id="instagram_container">

        <?=get_gallerygram_gall(@$_GET['next'],$gallerygramTag,$gallerygramUser); ?>

        <div id="result"></div>
    </div>
<!-- /Gallerygram END --> 
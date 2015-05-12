<!--get_page_link( $page->ID )-->
<?php
if(empty($_GET['clearcache'])){}else if($_GET['clearcache']=='true'){
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
?>
<div class="alert alert-warning">
      <strong><?php echo __( 'Attention!', 'gallerygram' ); ?></strong> <?php echo __( 'The cache is cleared.', 'gallerygram' ); ?>
</div>
<?php
}
if(empty($_GET['code'])){}else if($_GET['code']=='error'){ ?>
<div class="alert alert-danger">
      <strong><?php echo __( 'Error!', 'gallerygram' ); ?></strong> <?php echo __( 'Try to repeat later.', 'gallerygram' ); ?>
</div>
<?php
}
$gallerygram_info = $wpdb->get_row( "SELECT * FROM `" . $wpdb->prefix . 'gallerygram_bd' . "` WHERE ID = 1" );
if(!empty($_POST['_pageID'])){
	
	$pageID = $_POST['_pageID'];
	$gallerygramUserID = $_POST['user_id'];
	$gallerygramAccessToken = $gallerygram_info->access_token;
	
	$user_id = gallerygram_GetUserID($gallerygramUserID,$gallerygramAccessToken);
	
	
	
	
	$tags = $_POST['tags'];
	$tagoruserid = $_POST['tagoruserid'];
	
	$num_img = $_POST['num_img'];
	
				global $wpdb;
				$inputData = array(
					'user_id' 		  => strip_tags($user_id),
					'post_id' 	 		  => strip_tags($pageID),
					'tag' 	 		  => strip_tags($tags),
					'tagoruserid' 	 		  => strip_tags($tagoruserid),
					'num_img' 	 		  => strip_tags($num_img),
				);
				// Обновляем существующую запись
				$wpdb->update( $wpdb->prefix . 'gallerygram_bd', $inputData, array( 'ID' => 1 ));
				
// Создаем массив данных
  $my_post = array();
  $my_post['ID'] = $pageID;
  $my_post['post_content'] = '[gallerygram]';

// Обновляем данные в БД
  wp_update_post( $my_post );		
?>				
<div class="alert alert-success">
      <strong><?php echo __( 'Your changes have been saved!', 'gallerygram' ); ?></strong>
</div>
<?php
}

if(empty($gallerygram_info->post_id)&&!empty($gallerygram_info->user_id)&&!empty($gallerygram_info->access_token)){ ?>
<div class="alert alert-danger">
      <strong><?php echo __( 'Error!', 'gallerygram' ); ?></strong> <?php echo __( 'Select page', 'gallerygram' ); ?>!
</div>
<?php
}
?>

<div id="gallerygram">
    <h2><?php echo __( 'Setting', 'gallerygram' ); ?></h2>
    <p><?php echo __( 'Gallerygram helps you to easily add instagram gallery on your site!', 'gallerygram' ); ?></p>

<?php
if (empty($gallerygram_info->access_token)){
	$disabled = 'disabled';
?>
<a href="admin.php?page=gallerygram&action=get_access_token" class="btn btn-danger"><?php echo __( 'Connect Instagram', 'gallerygram' ); ?></a>
<?php }else{$disabled = '';} ?>

<form method="post">
<label for="_pageID"><?php echo __( 'Select page', 'gallerygram' ); ?>:</label>
<select name="_pageID" class="form-control" <?php echo $disabled; ?>> 
 <option value=""><?php echo __( 'Select page', 'gallerygram' ); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
	if(($page->ID)==($gallerygram_info->post_id)){ $selectedsss = ' selected="selected"';}else{};
  	$option = '<option value="' . $page->ID  . '"'.$selectedsss.'>';
	$option .= $page->post_title;
	$option .= '</option>';
	echo $option;
	unset($selectedsss);
  }
 ?>
</select>
<div class="clear"></div>
<div class="radio">
  <label>
    <input <?php echo $disabled; ?> type="radio" name="tagoruserid" id="optionsRadios1" value="userid"<?php if (($gallerygram_info->tagoruserid)=='userid'){echo ' checked'; } ?>>
    <?php echo __( 'User profile', 'gallerygram' ); ?>
  </label>
</div>
<div class="radio">
  <label>
    <input <?php echo $disabled; ?> type="radio" name="tagoruserid" id="optionsRadios2" value="tags"<?php if (($gallerygram_info->tagoruserid)=='tags'){echo ' checked'; } ?>>
    <?php echo __( 'Tag', 'gallerygram' ); ?>
  </label>
</div>

<div class="clear"></div><?php if (($gallerygram_info->tagoruserid)=='userid'){$hideuserid = ''; $hidetag = ' style="display:none;"';}else if (($gallerygram_info->tagoruserid)=='tags'){$hideuserid = ' style="display:none;"'; $hidetag = '';} ?>
<div class="input-group" id="userid"<?php echo $hideuserid; ?>>
  <span class="input-group-addon">user id:</span>
  <input <?php echo $disabled; ?> name="user_id" type="text" class="form-control" value="<?php if(!empty($_POST['_pageID'])){echo $user_id;}else{echo $gallerygram_info->user_id;} ?>">
</div>

<div class="input-group" id="tag"<?php echo $hidetag; ?>>
  <span class="input-group-addon">tag:</span>
  <input <?php echo $disabled; ?> name="tags" type="text" class="form-control" value="<?php echo $gallerygram_info->tag; ?>">
</div>

<div class="input-group">
  <span class="input-group-addon">access token:</span>
  <input disabled name="access_token" type="text" class="form-control" value="<?php echo $gallerygram_info->access_token; ?>">
</div>
<?php if($disabled=='disabled'){}else{ ?>
    <h3><?php echo __( 'More Settings', 'gallerygram' ); ?></h3>
    
<div class="input-group">
  <span class="input-group-addon"><?php echo __( 'Number of images', 'gallerygram' ); ?></span>
  <input name="num_img" type="text" class="form-control" value="<?php echo $gallerygram_info->num_img; ?>">
</div>

<?php } ?>

<div class="clear"></div>
<input <?php echo $disabled; ?> type="submit" value="<?php echo __( 'Save changes', 'gallerygram' ); ?>" name="submit" class="btn btn-primary">
</form>
<br /><br /><br /><br />
<a href="admin.php?page=gallerygram&action=get_access_token" class="btn btn-default"><?php echo __( 'Reconnect Instagram', 'gallerygram' ); ?></a>
 
<a href="admin.php?page=gallerygram&clearcache=true" class="btn btn-danger" style="margin: 0px 0px 0px 15px;"><?php echo __( 'Clear cache', 'gallerygram' ); ?></a>
</div>

<script type="text/javascript">
jQuery('#optionsRadios1').click(function(){
    jQuery('#userid').css('display', 'table');
	jQuery('#tag').hide();
});

jQuery('#optionsRadios2').click(function(){
    jQuery('#tag').css('display', 'table');
	jQuery('#userid').hide();
});
</script>
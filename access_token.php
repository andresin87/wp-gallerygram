<?php
if((empty($_REQUEST['client_id']))&&(empty($_REQUEST['client_secret']))&&(empty($_REQUEST['redirect_uri']))){

	$gallerygram_form = 'method="post"';
	
	$disabled = '';
	$gallerygram_connect_btn = '';

}else{
	
	$client_id = $_REQUEST['client_id'];
	$client_secret = $_REQUEST['client_secret'];
	
				$inputData = array(
					'client_id' 	  	  => strip_tags($client_id),
					'client_secret' 		  => strip_tags($client_secret)
				);
				// Обновляем существующую запись
				$wpdb->update( $wpdb->prefix . 'gallerygram_bd', $inputData, array( 'ID' => 1 ));

	$gallerygram_form = 'method="get" action="https://instagram.com/oauth/authorize"';
	$disabled = 'disabled';
	$gallerygram_connect_btn = '<button id="insta_submit" class="btn btn-primary">'. __( 'Connect', 'gallerygram' ) .'</button>';

 }
$gallerygram_info = $wpdb->get_row( "SELECT * FROM `" . $wpdb->prefix . 'gallerygram_bd' . "` WHERE ID = 1" );
?>
<div class="alert alert-info">
<strong><?php echo __( 'Heads up', 'gallerygram' ); ?>!</strong> <?php echo __( 'If you do not know how to get the client id and client secret, please use the', 'gallerygram' ); ?> <a href="admin.php?page=gallerygram_help"><?php echo __( 'help section', 'gallerygram' ); ?></a>. </div>
      
<div id="access_token">
<h1 class="form-submit-heading"><?php echo __( 'Connect Instagram', 'gallerygram' ); ?></h1>
<form <?php echo $gallerygram_form; ?>>
<div class="input-group input-group-lg">
  <span class="input-group-addon">client id:</span>
  <input type="text" class="form-control" name="client_id" id="client_id" value="<?php echo $gallerygram_info->client_id; ?>">
</div>
<div class="input-group input-group-lg">
  <span class="input-group-addon">client secret:</span>
  <input type="text" class="form-control" name="client_secret" id="client_secret" value="<?php echo $gallerygram_info->client_secret; ?>">
</div>
<input type="hidden" name="response_type" value="code" />
<input type="hidden" name="redirect_uri" value="<?php echo home_url(); ?>/wp-admin/admin.php?page=gallerygram&action=oauth" />
<button <?php echo $disabled; ?> id="insta_submit" class="btn btn-success"><?php echo __( 'Save', 'gallerygram' ); ?></button>
<?php echo $gallerygram_connect_btn; ?>
</form>
</div>
<?php
$gallerygram_info = $wpdb->get_row( "SELECT * FROM `" . $wpdb->prefix . 'gallerygram_bd' . "` WHERE ID = 1" );
include 'instagram.class.php';
  $instagram = new Instagram(array(
    'apiKey'      => $gallerygram_info->client_id,
    'apiSecret'   => $gallerygram_info->client_secret,
    'apiCallback' => home_url().'/wp-admin/admin.php?page=gallerygram&action=oauth' // must point to success.php
  ));


// Receive OAuth code parameter
$code = $_GET['code'];

if (true === isset($code)) {
	
	$data = $instagram->getOAuthToken($code);
	

				$inputData = array(
					'access_token' 	  	  => strip_tags($data->access_token),
					'user_id' 		  => strip_tags($data->user->id)
				);
				// Обновляем существующую запись
				$wpdb->update( $wpdb->prefix . 'gallerygram_bd', $inputData, array( 'ID' => 1 ));
?>				
<div class="alert alert-success">
      <strong><?php echo __( 'You have successfully connected Instagram!', 'gallerygram' ); ?></strong>
</div>
<script type="text/javascript">
window.location = '<?php echo home_url(); ?>/wp-admin/admin.php?page=gallerygram';
</script>
<?php
} else {	
?>
<div class="alert alert-danger">
      <strong><?php echo __( 'Error!', 'gallerygram' ); ?></strong> <?php if (true === isset($_GET['error'])) {echo $_GET['error_description'];} ?>
</div>
<?php
}


?>

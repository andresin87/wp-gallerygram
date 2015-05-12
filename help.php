<div id="gallerygram_help">
    <h1><?php echo __( 'Help', 'gallerygram' ); ?></h1>
    <hr>
    
    <h2 id="toc" class="alt"><?php echo __( 'Table of Contents', 'gallerygram' ); ?></h2>
    <ol class="alpha">
    	<li><a href="#register_new_client"><?php echo __( 'Register a new Client', 'gallerygram' ); ?></a></li>
    	<li><a href="#connect_instagram"><?php echo __( 'Connect Instagram', 'gallerygram' ); ?></a></li>
    	<li><a href="#create_page"><?php echo __( 'Create a page', 'gallerygram' ); ?></a></li>
    	<li><a href="#setting_gallerygram"><?php echo __( 'Setting Gallerygram', 'gallerygram' ); ?></a></li>
        <li><a href="#widget_gallerygram"><?php echo __( 'Widget', 'gallerygram' ); ?></a></li>
    	<li><a href="#short_codes"><?php echo __( 'Short codes', 'gallerygram' ); ?></a></li>
        <li><a href="#your_design"><?php echo __( 'Your design', 'gallerygram' ); ?></a></li>
    </ol>
    
    <hr>
    
    <h3 id="register_new_client"><strong><?php echo __( 'Register a new Client', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    <p><?php echo __( 'For proper operation of the plugin Gallerygram you must have an account in Instagram. If you have not already, please register.', 'gallerygram' ); ?><br />
    <?php echo __( 'If you are already registered, skip to step to the registration.', 'gallerygram' ); ?><br />
    <?php echo __( 'First you need go to the website <a href="http://instagram.com/developer/" target="_blank">developer Instagram</a>. In upper-right corner you will see the login button.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/instagram_login.png">
    
    <p><?php echo __( 'After you logged, you need to click on Manage Clients.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/manage_client.png">
    
    <p><?php echo __( 'In the Manage Clients you need to choose Register a New Client.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/manage_client2.png">
    
    <p><?php echo __( 'After that, you may be asked to verify your account. In this step, you will need to enter a mobile phone number, which will receive an SMS with a verification code. This takes you to a page Register new Client ID.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/new_cliend_id.png">
    
    <p><?php echo __( 'Consider each field individually', 'gallerygram' ); ?>:
    <ol>
    	<li><?php echo __( 'In this field we enter the name application, for example', 'gallerygram' ); ?>- <strong>Gallerygram</strong>.</li>
        <li><?php echo __( 'Description field can be left blank, or write for example', 'gallerygram' ); ?>- <strong>Gallerygram- <?php echo __( 'Your photos from instagram.', 'gallerygram' ); ?></strong></li>
        <li><?php echo __( 'Write URL of your Website', 'gallerygram' ); ?>: <strong><?php echo home_url(); ?></strong></li>
        <li><?php echo __( 'Write', 'gallerygram' ); ?>: <strong><?php echo home_url(); ?>/wp-admin/admin.php?page=gallerygram&action=oauth</strong></li>
    </ol>
    <?php echo __( 'Now click on the button Register', 'gallerygram' ); ?>.</p>
    
    <p><?php echo __( 'Congratulations application registered! Now you need to copy the client id and client secret', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/client_info.png">
    
    <hr>
    
    <h3 id="connect_instagram"><strong><?php echo __( 'Connect Instagram', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <p><?php echo __( 'After registration application Instagram you got client id and client secret', 'gallerygram' ); ?>. <br />
    <?php echo __( 'Now you need to connect the plug Gallerygram on your site and register the application Instagram. To do this, we copy the registered application client id and client secret', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/client_info.png">
    
    <p><?php echo __( 'Now we go to the admin panel of your site and go to Gallerygram', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_13.jpg">
    
    <p><?php echo __( 'In the page that appears, click on the Settings Connect Instagram', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_10.jpg">
    
    <p><?php echo __( 'On the loaded page, enter client id and client secret. Copy in the appropriate fields', 'gallerygram' ); ?>.</p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_11.jpg">
    
    <p><?php echo __( 'Save the settings by pressing the button - <strong>Save</strong>. Then appear button <strong>Connect</strong>', 'gallerygram' ); ?>.</p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_12.jpg">
    
    <p><?php echo __( 'Completes the configuration by pressing the <strong>Connect</strong>', 'gallerygram' ); ?>.</p>
    
    <hr>
    
    <h3 id="create_page"><strong><?php echo __( 'Create a page', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <p><?php echo __( 'After you click on the Connect button, you will see an error message.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_9.jpg">
    
    <p><?php echo __( 'This error came from the fact that you need to select the page where it will be displayed photos of Instagram', 'gallerygram' ); ?>. <br />
    <?php echo __( 'First, create a simple page for this menu, select Pages and submenu click on Add New', 'gallerygram' ); ?>.</p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_15.jpg">
    
    <p><?php echo __( 'Enter the name of the page, such as Instagram', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_16.jpg">
    
    <p><?php echo __( 'Most do not need to enter, simply publish the page', 'gallerygram' ); ?>.<br />
    <?php echo __( 'On this page creation plugin Gallerygram completed. If you enter a different name (in our example, it was Instagram), please remember it for the next step', 'gallerygram' ); ?>.</p>
    
    <hr>
    
    <h3 id="setting_gallerygram"><strong><?php echo __( 'Setting Gallerygram', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <p><?php echo __( 'Go to settings Gallerygram', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_13.jpg">
    
    <p><?php echo __( 'In the drop-down list "Select page" choose our newly created page', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_18.jpg">
    
    <p><?php echo __( 'Now you need to choose', 'gallerygram' ); ?>:</p>
    <ul>
    	<li><?php echo __( 'display photos from Instagram Profile', 'gallerygram' ); ?></li>
        <li><?php echo __( 'display photos on a particular tag', 'gallerygram' ); ?></li>
    </ul> 
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_19.jpg">
    
    <p><?php echo __( 'Photos are displayed by default the user, through which the application was registered in Instagram', 'gallerygram' ); ?>.</p>
    
    <p><?php echo __( 'In the <strong>user id</strong> you need to enter a user ID or nickname', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_20.jpg">
    
    <p><?php echo __( 'If you want to <strong>display photos by tag</strong>, click on the Tag', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_8.jpg">
    
    <p><?php echo __( 'And in the field, enter the tag you are interested tag', 'gallerygram' ); ?>.</p>
    
    <p><?php echo __( 'The following additional settings', 'gallerygram' ); ?>.<br />
    <?php echo __( 'Here you can adjust the number of displayed images', 'gallerygram' ); ?> </p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_17.jpg">
    
    <p><?php echo __( 'After all the changes, click <strong>save changes</strong>.', 'gallerygram' ); ?></p>
    
    <hr>
    
    <h3 id="widget_gallerygram"><strong><?php echo __( 'Widget', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <p><?php echo __( 'Go to Widgets.', 'gallerygram' ); ?><br />
    <?php echo __( 'Drag the widget Gallerygram to widget area.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_21.jpg">
    
    <p><?php echo __( 'You can customize the widget as you wish.', 'gallerygram' ); ?></p>
    
    <img alt="" src="<?php echo plugins_url().'/gallerygram/' ?>images/help/image_22.jpg">
    
    <p><?php echo __( 'The widget is configured exactly the same as the plugin.', 'gallerygram' ); ?></p>
    
    <p><?php echo __( 'If the field User/tag is left blank, the settings are taken from the plug.', 'gallerygram' ); ?></p>
    
    <hr>
    
    <h3 id="short_codes"><strong><?php echo __( 'Short codes', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <?php echo __( 'You can also add a short codes to display the Gallery on any page.', 'gallerygram' ); ?></p>
    
    <ul>
    	<li><strong>[gallerygram]</strong> – <?php echo __( 'standard output of galleries', 'gallerygram' ); ?></li>
        <li><strong>[gallerygram userid=""]</strong> – <?php echo __( 'if you want to create multiple pages different gallerys of different users (in parentheses enter the user ID or login)', 'gallerygram' ); ?></li>
        <li><strong>[gallerygram tag=""]</strong> – <?php echo __( 'if you want to create multiple pages with different galleries of different tags (in parentheses enter tag)', 'gallerygram' ); ?></li>
    </ul>
    
    <hr>
    
    <h3 id="your_design"><strong><?php echo __( 'Your design', 'gallerygram' ); ?></strong> - <a href="#toc"><?php echo __( 'top', 'gallerygram' ); ?></a></h3>
    
    <p><?php echo __( 'You can change the css styles plugin on their own, for this you need to copy CSS in your theme folder from the plugin folder', 'gallerygram' ); ?> <strong>/gallerygram/css/gallerygram.css</strong><br />
    <?php echo __( 'Now you can change the css style you like.', 'gallerygram' ); ?></p>
    
    
</div>
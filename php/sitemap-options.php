<?php
session_start();

include 'filterPage.php';

add_action('admin_init', 'register_sitemap_settings');
add_action('admin_menu', 'sitemap_settings_init');

function sitemap_settings_init(){

	add_options_page(
	'Sitemap Menu',
	'Custom Sitemap Page',
	'manage_options',
	'sitemap-settings',
	'sitemap_settings_menu',
	3 //position
	);	
}

function sitemap_settings_menu(){
	
	echo '<h1>Sitemap settings</h1>'; ?>
	
	<form action='' method='post'>
		<?php
		settings_fields('sitemap_settings');
		do_settings_sections('sitemap-settings');
		submit_button(); ?>
	</form>
<?php
} 

function register_sitemap_settings(){
	
	#register_setting( 'sitemap_settings', 'sitemap_remove');
	#register_setting( 'sitemap_settings', 'sitemap_exclude_pages');
	#register_setting( 'sitemap_settings', 'sitemap_exclude_posts');
	#register_setting( 'sitemap_settings', 'sitemap_exclude_taxonomies');
	#register_setting( 'sitemap_settings', 'sitemap_exclude_protected');
	
	add_settings_section(
		'settings_sitemap_remove', // Section ID
		'', // title 
		'', // callback function
		'sitemap-settings' 
	);
	
	add_settings_section(
		'settings_sitemap_exclude', // Section ID
		'', // title 
		'', // callback function
		'sitemap-settings' 
	);
	
	add_settings_field(
		'sitemap_remove', // Setting ID
		'Remove page',
		'sitemap_remove_page', // callback function
		'sitemap-settings', 
		'settings_sitemap_remove' // Section ID
	);
	
	add_settings_field(
		'sitemap_exclude_pages', // Setting ID
		'Exclude pages',
		'sitemap_exclude_page', // callback function
		'sitemap-settings', 
		'settings_sitemap_exclude' // Section ID
	);

	add_settings_field(
		'sitemap_exclude_posts', // Setting ID
		'Exclude Custom Post Type',
		'sitemap_exclude_post', // callback function
		'sitemap-settings', 
		'settings_sitemap_exclude' // Section ID
	);

	add_settings_field(
		'sitemap_exclude_taxonomies', // Setting ID
		'Exclude taxonomies',
		'sitemap_exclude_taxonomy', // callback function
		'sitemap-settings', 
		'settings_sitemap_exclude' // Section ID
	);

	
	add_settings_field(
		'sitemap_exclude_protected', // Setting ID
		'Password protected',
		'sitemap_exclude_protected', // callback function
		'sitemap-settings', 
		'settings_sitemap_exclude' // Section ID
	);
}

function sitemap_exclude_page(){

	excludePage(); ?>
	<!-- <form method='post'> -->
		<input name="sitemap_exclude_page_id" id="sitemap_exclude_page_id">
		<p>Just add the IDs, separated by a comma, of the pages you want to exclude.</p>
	<!-- </form> -->
	
<?php
}?>

<?php
function sitemap_exclude_post(){
	
	excludePost();  ?>
	<!-- <form method='post'> -->
		<div>
			<input type='checkbox' name="sitemap_exclude_page" id="sitemap_exclude_page"
				  	<?php echo $_SESSION['sitemap_exclude_page'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_page'>Page</label>
		</div>
			
		<div>
			<input type='checkbox' name='sitemap_exclude_post' id='sitemap_exclude_post'
				   <?php echo $_SESSION['sitemap_exclude_post'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_post'>Post</label>
		</div>
			
		<div>
			<input type='checkbox' name="sitemap_exclude_archive" id="sitemap_exclude_archive"
				   <?php echo $_SESSION['sitemap_exclude_archive'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_archive'>Archive</label>
		</div>
			
		<div>
			<input type='checkbox' name="sitemap_exclude_author" id="sitemap_exclude_author"
				   <?php echo $_SESSION['sitemap_exclude_author'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_author'>Author</label>
		</div>
			
		<div>
			<input type='checkbox' name="sitemap_exclude_product" id="sitemap_exclude_product"
				   <?php echo $_SESSION['sitemap_exclude_product'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_product'>Products</label>
		</div>
	<!-- </form>  -->
<?php	
}?>

<?php
function sitemap_exclude_taxonomy(){
	
	$option = get_option('sitemap_exclude_posts');
	excludeTaxonomy(); ?>
	<!-- <form action='' method='post'> -->
		<div>
			<input type='checkbox' name="sitemap_exclude_category" id="sitemap_exclude_category"
				   <?php echo $_SESSION['sitemap_exclude_category'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_category'>Product categories</label>
		</div>
			
		<div>
			<input type='checkbox' name='sitemap_exclude_tag' id='sitemap_exclude_tag'
				   <?php echo $_SESSION['sitemap_exclude_tag'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_tag'>Product tags</label>
		</div>
			
		<div>
			<input type='checkbox' name="sitemap_exclude_ship" id="sitemap_exclude_ship"
				   <?php echo $_SESSION['sitemap_exclude_ship'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_ship'>Product shipping classes</label>
		</div>
	<!-- </form> -->
<?php
}?>


<?php
function sitemap_exclude_protected(){
	
	$option = get_option('sitemap_exclude_taxonomies');
	excludeProtected();?>
	<!-- <form action='' method='post'> -->
		<div>
			<input type='checkbox' name="sitemap_exclude_protected" id="sitemap_exclude_protected"
			  	   <?php echo $_SESSION['sitemap_exclude_protected'] == 'on' ? 'checked' : ''?> >
			<label for='sitemap_exclude_protected'>Exclude content protected by password</label>
		</div>
	<!-- </form> -->
<?php
}?>

<?php
function sitemap_remove_page(){
	
	$option = get_option('sitemap_remove');
	if(isset($_POST["sitemap_remove"])){
		removalResult();
	}?>
	<!-- <form action="" method='post'> -->
		<input id="sitemap_remove" name="sitemap_remove" />
	<!-- </form> -->
	
<?php
}?>


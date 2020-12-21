<?php
session_start();
function removalResult(){
	if(wp_delete_post($_POST['sitemap_remove'])){
		echo "<p>Successfully deleted post with ID #" . $_POST['sitemap_remove'] . '.</p>';	
	} else if(!$_POST['sitemap_remove'] == ''){
		echo '<p>Deletion unsuccessful.</p>';
	}
}

function excludePage(){
	if($_POST["sitemap_exclude_page_id"] != ''){
		if ($_POST["sitemap_exclude_page_id"] == $_SESSION["sitemap_exclude_page_id"] ||
		    $_POST["sitemap_exclude_page_id"] == ' '){
			unset($_SESSION["sitemap_exclude_page_id"]);
			echo "<p>Page filters were reset.</p>";
		} else {
			$_SESSION["sitemap_exclude_page_id"] = $_POST["sitemap_exclude_page_id"];
			echo "<p>Page ID filter: " . htmlentities($_SESSION["sitemap_exclude_page_id"]) . "</p>";
		}	
	} else if($_SESSION["sitemap_exclude_page_id"] != ''){
		echo "<p>Page ID filter: " . htmlentities($_SESSION["sitemap_exclude_page_id"]) . "</p>";
	}else{
		echo "<p>No filters were applied.</p>";
	}		
}

function excludePost(){

	if($_POST['sitemap_exclude_page'] == 'on'){
		$_SESSION['sitemap_exclude_page'] = $_POST['sitemap_exclude_page'];
		#echo '<p>Page filter: ' . $_SESSION['sitemap_exclude_page'] . '</p>';
	}else if(!isset( $_POST["sitemap_exclude_page"])){
		$_SESSION["sitemap_exclude_page"] = 'off';
		#echo '<p>Page filter: ' . $_SESSION['sitemap_exclude_page'] . '</p>';
	}else{
		#echo '<p>Page filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_post'] == 'on'){
		$_SESSION['sitemap_exclude_post'] = $_POST['sitemap_exclude_post'];
		#echo '<p>Post filter: ' . $_SESSION['sitemap_exclude_post'] . '</p>';
	}else if(!isset( $_POST["sitemap_exclude_post"])){
		$_SESSION["sitemap_exclude_post"] = 'off';
		#echo '<p>Post filter: ' . $_SESSION['sitemap_exclude_post'] . '</p>';
	}else{
		#echo '<p>Post filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_archive'] == 'on'){
		$_SESSION['sitemap_exclude_archive'] = $_POST['sitemap_exclude_archive'];
		#echo '<p>Archive filter: ' . $_SESSION['sitemap_exclude_archive'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_archive'])){
		$_SESSION['sitemap_exclude_archive'] = 'off';
		#echo '<p>Archive filter: ' . $_SESSION['sitemap_exclude_archive'] . '</p>';
	}else{
		#echo '<p>Archive filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_author'] == 'on'){
		$_SESSION['sitemap_exclude_author'] = $_POST['sitemap_exclude_author'];
		#echo '<p>Author filter: ' . $_SESSION['sitemap_exclude_author'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_author'])){
		$_SESSION['sitemap_exclude_author'] = 'off';
		#echo '<p>Author filter: ' . $_SESSION['sitemap_exclude_author'] . '</p>';
	}else{
		#echo '<p>Author filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_product'] == 'on'){
		$_SESSION['sitemap_exclude_product'] = $_POST['sitemap_exclude_product'];
		#echo '<p>Product filter: ' . $_SESSION['sitemap_exclude_product'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_product'])){
		$_SESSION['sitemap_exclude_product'] = 'off';
		#echo '<p>Product filter: ' . $_SESSION['sitemap_exclude_product'] . '</p>';
	}else{
		#echo '<p>Product filter: off</p>';
	}
}

function excludeTaxonomy(){
	
	if($_POST['sitemap_exclude_category'] == 'on'){
		$_SESSION['sitemap_exclude_category'] = $_POST['sitemap_exclude_category'];
		#echo '<p>Product Category filter: ' . $_SESSION['sitemap_exclude_category'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_category'])){
		$_SESSION['sitemap_exclude_category'] = 'off';
		#echo '<p>Product Category filter: ' . $_SESSION['sitemap_exclude_category'] . '</p>';
	}else{
		#echo '<p>Product Category filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_tag'] == 'on'){
		$_SESSION['sitemap_exclude_tag'] = $_POST['sitemap_exclude_tag'];
		#echo '<p>Product Tag filter: ' . $_SESSION['sitemap_exclude_tag'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_tag'])){
		$_SESSION['sitemap_exclude_tag'] = 'off';
		#echo '<p>Product Tag filter: ' . $_SESSION['sitemap_exclude_tag'] . '</p>';
	}else{
		#echo '<p>Product Tag filter: off</p>';
	}
	
	if($_POST['sitemap_exclude_ship'] == 'on'){
		$_SESSION['sitemap_exclude_ship'] = $_POST['sitemap_exclude_ship'];
		#echo '<p>Shipping Class filter: ' . $_SESSION['sitemap_exclude_ship'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_ship'])){
		$_SESSION['sitemap_exclude_ship'] = 'off';
		#echo '<p>Shipping Class filter: ' . $_SESSION['sitemap_exclude_ship'] . '</p>';
	}else{
		#echo '<p>Shipping Class filter: off</p>';
	}
}

function excludeProtected(){
	if($_POST['sitemap_exclude_protected'] == 'on'){
		$_SESSION['sitemap_exclude_protected'] = $_POST['sitemap_exclude_protected'];
		#echo '<p>Protected Content filter: ' . $_SESSION['sitemap_exclude_protected'] . '</p>';
	}else if(!isset($_POST['sitemap_exclude_ship'])){
		$_SESSION['sitemap_exclude_protected'] = 'off';
		#echo '<p>Protected Content filter: ' . $_SESSION['sitemap_exclude_protected'] . '</p>';
	}else{
		#echo '<p>Protected Content filter: off</p>';
	}
}	
?>


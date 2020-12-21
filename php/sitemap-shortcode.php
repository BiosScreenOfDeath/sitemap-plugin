<?php
session_start();
function wp_sitemap_shortcode(){
	
    ob_start(); ?>
	<h2>Sitemap:</h2>
	
    <ul class="sitemap-pages " style="list-style-type: none;">
    <?php
	
	$passwordProtectedPageIDs = array();
	
	if ($_SESSION['sitemap_exclude_protected'] == 'on'){
			#echo '<ul class="not-protected-pages">';
			$pages = get_pages();
			foreach($pages as $page){
				if(post_password_required($page)) { ?>
					<!-- <li><a href="http://localhost/community-posts/index.php/<?php echo get_post($page)->post_name; ?>" 
						   title="<?php echo get_post($page)->post_title; ?>">
						<?php echo get_post($page)->post_title; ?></a>
					</li> -->
				<?php
						array_push($passwordProtectedPageIDs, $page->ID);
				}
			}	
			#echo '</ul>';
		}
	
	if ($_SESSION['sitemap_exclude_page'] == 'on'){ // Exclude all pages.
		wp_list_pages(array(
			'exclude' => implode(",", get_all_page_ids())
		));
	}else if(isset($_SESSION['sitemap_exclude_page_id'])){ // Exclude page IDs.
		if(count($passwordProtectedPageIDs) > 0){ // Exclude password protected pages too.
			echo '<li>'.$passwordProtectedPageIDs.'</li>';
			array_push($passwordProtectedPageIDs, $_SESSION['sitemap_exclude_page_id']); 
			wp_list_pages(array(
				'exclude' => implode(",", $passwordProtectedPageIDs)
			));	
		} else {
			wp_list_pages(array(
				'exclude' => $_SESSION['sitemap_exclude_page_id']
			));	
		}
	} else {
		if(count($passwordProtectedPageIDs) > 0){
			wp_list_pages(array(
				'exclude' => implode(",", $passwordProtectedPageIDs)
			));
		}else{
			wp_list_pages();	
		}
	}
	
	?>
    </ul>

	<ul class="sitemap-posts" style="list-style-type: none;">
	    <?php
		if($_SESSION['sitemap_exclude_post'] == 'on'){
			$cats = get_categories(array(
				'exclude' => get_posts()
			));	
		} else if($_SESSION['sitemap_exclude_post'] == 'off') { ?>
			<li>Posts</li>
			<?php
			$cats = get_categories('exclude=');
			echo '<ul class="cat-posts">';
			foreach ($cats as $cat) {
			query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
			while(have_posts()){
				the_post();
				if(!post_password_required()) {
					$category = get_the_category();
					if ($category[0]->cat_ID == $cat->cat_ID) {?>
							<li><a href="<?php the_permalink() ?>" 
							   title="<?php the_title(); ?>">
								<?php the_title(); ?></a>
							</li>
					<?php }}
				else if (post_password_required() && $_SESSION['sitemap_exclude_protected'] == 'off'){
					$category = get_the_category();
					if ($category[0]->cat_ID == $cat->cat_ID) {?>
							<li><a href="<?php the_permalink() ?>" 
								title="<?php the_title(); ?>">
								<?php the_title(); ?></a>
							</li>
						<?php }}
			}}
			echo '</ul>';
		}?>
	</ul>
	
	<?php wp_reset_query(); ?>   

	<ul class="sitemap-products" style="list-style-type: none;">
		<?php
		if(!($_SESSION['sitemap_exclude_product'] == 'on')){ ?>
			<li>Products</li>
			<?php
			$params = array('posts_per_page' => 999,'post_type' => 'product');
			$wc_query = new WP_Query($params);
			echo '<ul class="cat-posts">';
			if ($wc_query->have_posts()){
				while ($wc_query->have_posts()){
					$wc_query->the_post();
					if(!post_password_required()) { ?>
						<li><a href="<?php the_permalink(); ?>"
							   title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a></li>
					<?php }
					else if(post_password_required() && $_SESSION['sitemap_exclude_protected'] == 'off') { ?>
						<li><a href="<?php the_permalink(); ?>"
							   title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a></li>
					<?php } 
				}}
			echo "</ul>";
		} ?>
		</ul>
		<?php wp_reset_query(); ?>

<?php
	if(!($_SESSION['sitemap_exclude_archive'] == 'on')){?>
		<ul class="sitemap-archives" style="list-style-type: none;">
			<li>Archives</li>
			<ul class="archive-posts">
				<li><?php
				wp_get_archives(array(
					'format' => 'li'
				));
				?></li>
			</ul>
		</ul>
	<?php 
	}?>

<?php
	if(!($_SESSION['sitemap_exclude_author'] == 'on')){?>
		<ul class="sitemap-authors" style="list-style-type: none;">
			<li>Authors</li>
			<ul class="authors">
				<?php
				wp_list_authors();
				?>
			</ul>
		</ul>
	<?php
	}?>				


<?php
	if(!($_SESSION['sitemap_exclude_category'] == 'on')){?>
		<ul class="sitemap-product-categories" style="list-style-type: none;">
			<li>Product Categories<li>
			<ul class="category">
		<?php
		$categories = get_terms( ['taxonomy' => 'product_cat'] );
		foreach($categories as $category){?>
			<li>
				<a 
				href='http://localhost/community-posts/index.php/product-category/<?php echo $category->slug; ?>'
				title='<?php echo $category->name; ?>'><?php echo $category->name; ?> </a>
			</li>
		<?php }
		echo '</ul></ul>';			   	
	}?>


<?php
	if(!($_SESSION['sitemap_exclude_tag'] == 'on')){?>
		<ul class="sitemap-product-tag" style="list-style-type: none;">
			<li>Product Tags<li>
			<ul class="tag">
		<?php
		$categories = get_terms( ['taxonomy' => 'product_tag'] );
		foreach($categories as $category){?>
			<li>
				<a 
				href='http://localhost/community-posts/index.php/product-tag/<?php echo $category->slug; ?>'
				title='<?php echo $category->name; ?>'><?php echo $category->name; ?> </a>
			</li>
		<?php }
		echo '</ul></ul>';			   	
	}?>

<?php
	if(!($_SESSION['sitemap_exclude_ship'] == 'on')){?>
		<ul class="sitemap-shipping-classes" style="list-style-type: none;">
			<li>Shipping Classes<li>
			<ul class="shipping-class">
		<?php
		$categories = get_terms( ['taxonomy' => 'product_shipping_class'] );
		foreach($categories as $category){?>
			<li>
				<a 
				href='http://localhost/community-posts/index.php/?taxonomy=product_shipping_class&term=<?php echo $category->slug; ?>'
				title='<?php echo $category->name; ?>'><?php echo $category->name; ?></a>
			</li>
		<?php }
		echo '</ul></ul>';			   	
	}?>				

<?php
    return ob_get_clean();
}
?>


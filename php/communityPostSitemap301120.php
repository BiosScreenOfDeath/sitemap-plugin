<?php
/**
 * Template Name: Sitemap
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<div class="html-sitemap">
   
    <h2>Sitemap:</h2>
	
    <ul class="sitemap-pages " style="list-style-type: none;">
    <?php
      wp_list_pages();
    ?>
    </ul> 

	<ul class="sitemap-posts" style="list-style-type: none;">
		<li>Posts</li>
	    <?php
		$cats = get_categories('exclude=');
		echo '<ul class="cat-posts">';
		foreach ($cats as $cat) {
		query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
		while(have_posts()){
			the_post();
			$category = get_the_category();
			 if ($category[0]->cat_ID == $cat->cat_ID) {?>
				<li><a href="<?php the_permalink() ?>" 
				   title="<?php the_title(); ?>">
	    			<?php the_title(); ?></a>
				</li>
			 <?php }} ?>	
		<?php
		}
		echo '</ul>';?>
	</ul> 
		<?php wp_reset_query(); ?>   

	<ul class="sitemap-products" style="list-style-type: none;">
		<li>Products</li>
		<?php
		$params = array('posts_per_page' => 999,'post_type' => 'product');
		$wc_query = new WP_Query($params);
		echo '<ul class="cat-posts">';
		if ($wc_query->have_posts()){
			while ($wc_query->have_posts()){
				$wc_query->the_post();?>
		<li><a href="<?php the_permalink(); ?>"
			   title="<?php the_title(); ?>">
			<?php the_title(); ?>
		</a></li>
		<?php 
			}}
		echo "</ul>";
		?>
	</ul>
		<?php wp_reset_query(); ?>  
	
</div>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>


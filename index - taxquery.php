<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wpbootstrap
 * @since wpbootstrap 0.1
 */

get_header(); ?>
<div class="row">
  <div class="span11 columns">
	
				<?php
			// $args = array(
			// 	'post_type' => 'post', 
			// 	'posts_per_page' => -1,
			// 	//'cat' => 15
			// 	
			// 	'tax_query' => array(
			//	'relation' => 'OR',
			// 		array(
			// 			'taxonomy' 	=> 'category',
			// 			'field'		=> 'slug',
			// 			'terms'		=>	array('cats'),
			// 			'include_children' => true,
			// 			'operator' 	=> 'IN'
			// 		),
			// 		array(
			// 			'taxonomy' 	=> 'post_tag',
			// 			'field'		=> 'slug',
			// 			'terms'		=>	array('joomla' , 'ruby' , 'css'),
			// 			'operator' 	=> 'IN'
			// 		)

			// 	)
			// );

			$args = array(
				'post_type' => 'post', 
				'posts_per_page' => -1,
				//'cat' => 15
				
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' 	=> 'genre',
						'field'		=> 'term_id',
						'terms'		=>	array(3,4),
						'include_children' => true,
						'operator' 	=> 'IN'
					),
					array(
						'taxonomy' 	=> 'category',
						'field'		=> 'slug',
						'terms'		=>	array('dogs'),
						'include_children' => true,
						'operator' 	=> 'IN'
					)

				)
			);


			$query = new WP_Query($args);

			while($query->have_posts()) : $query->the_post();
			$dontshowthisguy = $post->ID;
		?>
			<div class="featured">
					<h5><?php the_title(); ?></h5>
			<?php the_category(); ?><br>
			<?php the_tags(); ?>
			<span class="price"><?php the_field('price') ?></span>
			<span class="size"><?php the_field('size') ?></span>
			<span class="color"><?php the_field('color') ?></span>
			</div>
	
		<?php endwhile; wp_reset_query(); ?>
			
  </div>
  <div class="span5 columns">
		<?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
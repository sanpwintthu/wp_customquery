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
			//Single Meta Query
			// $args = array(
			// 	'post_type' => 'post', 
			// 	'posts_per_page' => -1,
			// 	'meta_key' => 'size',
			// 	'meta_value' => 'xl',
			// 	'meta_compare' => '='
			// );

			//Mutiple Meta Query
			// 	$args = array(
			// 	'post_type' => 'post', 
			// 	'posts_per_page' => -1,
			// 	'meta_query' => array(
			// 		'relation' => 'OR',
			// 		array(
			// 			'key' => 'size',
			// 			'value' => 'xl',
			// 			'type' =>  'CHAR',
			// 			'compare' => '='
			// 		),
			// 		array(
			// 			'key' => 'price',
			// 			'value' => 100,
			// 			'type' => 'NUMERIC',
			// 			'compare'=> '<'
			// 		)
			// 	)
			// );

			// price between query
			// $args = array(
			// 	'post_type' => 'post', 
			// 	'posts_per_page' => -1,
			// 	'meta_query' => array(
			// 		array(
			// 			'key' => 'price',
			// 			'value' => array(50 ,100),
			// 			'type' => 'NUMERIC',
			// 			'compare'=> 'BETWEEN'
			// 		)
			// 	)
			// );

				$args = array(
				'post_type' => 'post', 
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'relation' => 'OR',
						array(
						'key' => 'size',
						'value' => 'xl',
						'type' =>  'CHAR',
						'compare' => '='
						),
						array(
							'key' => 'color',
							'value' => 'blue',
							'type' => 'CHAR',
							'compare'=> '='
						)
					),

					array(
						'key' => 'price',
						'value' => 100,
						'type' => 'NUMERIC',
						'compare'=> '<'
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
<?php get_header(); ?>

	<div class="container">
		<h4 class="lesson-title">WP Custom Query - Basics</h4>

		<?php
			$args = array(
				'post_type' => 'post', 
				'posts_per_page' => 1,
				'orderby' => 'rand',
			);
			$query = new WP_Query($args);

			while($query->have_posts()) : $query->the_post();
			$dontshowthisguy = $post->ID;
		?>
			<div class="featured">
				<h5><?php the_title(); ?></h5>
			</div>
	
		<?php endwhile; wp_reset_query(); ?>
		<?php //echo $dontshowthisguy; ?>

		<?php
			$args = array(
				'post_type' => 'post', 
			//	'posts_per_page' => 5,
				'post__not_in' => array($dontshowthisguy),
				//'meta_key' => 'order', // from custom field plugin
				'orderby' => 'title', // ('title','rand','comment_count','meta_value')
				'order' => 'ASC',
				// 'cat' => 1,
				// 'category_name' => 'apples', 'orange'
				//'category_and' =>  array(17,20)
				//'category__not_in' =>  array(17)
				//'category__in' =>  array(17,19,20),
				//'tag' => 'css',
				//'tag_id' => 25
				//'tag__and' => array(25,32),
				//'tag__not_in' => array(25,32),
				//'tag__in' => array(25,32),
				//'tag_slug__in' => array(25,32),
				//'tag_slug__and' => array('craft','sass')
			);
			$query = new WP_Query($args);

			while($query->have_posts()) : $query->the_post();
		?>
			<h5><?php the_title(); ?></h5>
			<?php the_category(); ?><br>
			<?php the_tags(); ?>


		<?php endwhile; wp_reset_query(); ?>
	</div>



<?php get_footer(); ?>
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
	<?php 
		if($_GET['minprice'] && !empty($_GET['minprice']))
		{
			$minprice = $_GET['minprice'];
			//echo $minprice;
		} else {
			$minprice = 0;
		}
		if($_GET['maxprice'] && !empty($_GET['maxprice']))
		{
			$maxprice = $_GET['maxprice'];
			//echo $minprice;
		} else {
			$maxprice = 999999;
		}
		if($_GET['size'] && !empty($_GET['size']))
		{
			$size = $_GET['size'];
		}
		if($_GET['color'] && !empty($_GET['color']))
		{
			$color = $_GET['color'];
		}

		?>
<div class="row">
  <div class="span11 columns">
  	<form action="" method="get">
  		<!-- <form action="/" method="get"> -->
		<label>min:</label>
		<input type="number" name="minprice" value="<?php echo $minprice ?>">
		<label>max:</label>
		<input type="number" name="maxprice" value="<?php echo $maxprice ?>">

		<label>Size:</label>
		<select name='size'>
			<option value=''>Any</option>
			<option value='s'>S</option>
			<option value='m'>M</option>
			<option value='l'>L</option>
			<option value='xl'>XL</option>
		</select>

		<label>Color:</label>
		<select name='color'>
			<option value=''>Any</option>
			<option value='red'>Red</option>
			<option value='blue'>Blue</option>
			<option value='green'>Green</option>
			<option value='yellow'>Yellow</option>
			<option value='purple'>Purple</option>
			<option value='black'>Black</option>
		</select>
		<button type='submit' name=''>Filter</button>
  	</form>
	
				<?php
		

			$args = array(
				'post_type' => 'post', 
				'posts_per_page' => -1,
				//'cat' => 15
				'meta_query' => array(
					array(
						'key' => 'price',
						'type' => 'NUMERIC',
						'value' => array($minprice, $maxprice),
						'compare' => 'BETWEEN'
					),
					array(
						'key' => 'size',
						'value' => $size,
						'compare' => 'LIKE'
					),
					array(
						'key' => 'color',
						'value' => $color,
						'compare' => 'LIKE'
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
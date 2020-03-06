<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>
<!-- ///////////////////////     FRONT-PAGE  /////////////////// -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
            the_post();

			get_template_part( 'template-parts/content', 'page' );
        //    echo get_the_title();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
        
        

/////////////////////////////////////////////// CONFÉRENCE ///////////////////////////////////////////////////
echo '<h2>'.category_description( get_category_by_slug( 'conference')).'</h2>';
 
// The Query
$args = array(
    "category_name" =>"conference",
    "posts_per_page"=> 3,
    // "orderby" => "date",
    // "order" => "ASC"
);
$query1 = new WP_Query( $args );
 
// The Loop
while ( $query1->have_posts() ) {
    $query1->the_post();
    echo '<div class="conference">';
    the_post_thumbnail("thumbnail");
        echo '<div class="conferenceTexte">';
            echo '<h3>' . get_the_title() .' '. get_the_date('Y-m-d'). '</h3>';
            echo '<p>' . substr(get_the_excerpt(),0,200) . '</p>';
            echo '</div>';
    echo '</div>';
};
 
/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset with 
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata();


/////////////////////////////////////////////// NOUVELLE ///////////////////////////////////////////////////
echo '<h2>'.category_description( get_category_by_slug( 'nouvelle')).'</h2>';
 
// The Query
$args2 = array(
    "category_name" =>"nouvelle",
    "posts_per_page"=> 4,
    // "orderby" => "date",
    // "order" => "ASC"
);
$query2 = new WP_Query( $args2 );
 
// The Loop
echo '<div class="nouvelles">';
while ( $query2->have_posts() ) {
    $query2->the_post();
    echo '<div class="uneNouvelles">';
    echo '<h3>' . get_the_title() .'</h3>';
    the_post_thumbnail("thumbnail");
    echo '</div>';
};
echo '</div>';
 
/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset with 
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata();


/////////////////////////////////////////////// EVENEMENT ///////////////////////////////////////////////////

$args3=array(
    "category_name" =>"evenement",
    "posts_per_page"=> 10
);

 
 
//  The 2nd Query (without global var) 
$query3 = new WP_Query( $args3 );
 
// The 2nd Loop
while ( $query3->have_posts() ) {
    $query3->the_post();
    echo '<h2>' . get_the_title( $query3->post->ID ) . '</h2>';
    echo '<p>' . substr(get_the_excerpt(),0,200) . '</p>';

}
 
// Restore original Post Data
wp_reset_postdata();
 
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
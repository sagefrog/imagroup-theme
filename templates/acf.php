<?php

/*
	Template Name: ACF Template
*/

get_header();

while ( have_posts() ) : the_post();
	if( have_rows( 'sections' ) ) :
	  	while( have_rows( 'sections' ) ): the_row();
	  		$section_name = get_row_layout();
	  		get_template_part( 'template-parts/sections/'.$section_name );
	  endwhile;
	endif;
endwhile;

get_footer();

?>
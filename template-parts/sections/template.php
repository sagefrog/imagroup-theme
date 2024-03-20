<?php

$template_id = get_sub_field( 'template' );

if( have_rows( 'sections', $template_id ) ) :
    while( have_rows( 'sections', $template_id ) ): the_row();
        $section_name = get_row_layout();
        get_template_part( 'template-parts/sections/'.$section_name );
    endwhile;
endif;

?>
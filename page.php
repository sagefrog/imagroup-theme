<?php

get_header();

while ( have_posts() ) : the_post(); ?>
    <section class="content-part pt-50 pb-md-150 pb-100">
        <div class="container max-container">
            <div class="max-width-891">
				<div class="content-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="privacy-info wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section><?php
endwhile;

get_footer();

?>
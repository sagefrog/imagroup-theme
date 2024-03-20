            </div>
            </main>

            <!-- footer -->
            <footer>
                <div class="footer-part">
                    <div class="container">
                        <div class="footer-row">
                            <div class="footer-col"><?php
                                                    $logo = imagroup_theme_option('footer_column_one', 'logo');
                                                    if (!empty($logo)) { ?>
                                    <div class="footer-logo">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" class="main-element">
                                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                                        </a>
                                    </div><?php
                                                    }

                                                    $partners = imagroup_theme_option('footer_column_one', 'partners');
                                                    if (!empty($partners)) { ?>
                                    <div class="footer-logo-list"><?php
                                                                    foreach ($partners as $key => $value) {
                                                                        if (!empty($value)) {
                                                                            $link_url = isset($value['link']) && !empty($value['link']) ? $value['link'] : false;

                                                                            if ($link_url) { // If there is a link, wrap the image in an <a> tag 
                                                                    ?>
                                                    <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                                        <span><img src="<?php echo esc_url($value['image']['url']); ?>" alt="<?php echo esc_attr($value['image']['alt']); ?>"></span>
                                                    </a>
                                                <?php } else { // If there is no link, just display the image 
                                                ?>
                                                    <span><img src="<?php echo esc_url($value['image']['url']); ?>" alt="<?php echo esc_attr($value['image']['alt']); ?>"></span>
                                        <?php }
                                                                        }
                                                                    } ?>
                                    </div><?php
                                                    }
                                            ?>

                            </div>
                            <div class="footer-col"><?php
                                                    $partners = imagroup_theme_option('footer_column_one', 'partners');
                                                    if (!empty($partners)) { ?>
                                    <div class="footer-logo-list"><?php
                                                                    foreach ($partners as $key => $value) {
                                                                        if (!empty($value)) {
                                                                            $link_url = isset($value['link']) && !empty($value['link']) ? $value['link'] : false;

                                                                            if ($link_url) { // If there is a link, wrap the image in an <a> tag 
                                                                    ?>
                                                    <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                                        <span><img src="<?php echo esc_url($value['image']['url']); ?>" alt="<?php echo esc_attr($value['image']['alt']); ?>"></span>
                                                    </a>
                                                <?php } else { // If there is no link, just display the image 
                                                ?>
                                                    <span><img src="<?php echo esc_url($value['image']['url']); ?>" alt="<?php echo esc_attr($value['image']['alt']); ?>"></span>
                                        <?php }
                                                                        }
                                                                    } ?>
                                    </div><?php
                                                    }



                                                    $content = imagroup_theme_option('footer_column_two', 'content');
                                                    if (!empty($content)) {
                                                        echo do_shortcode($content);
                                                    } ?>
                            </div>
                            <div class="footer-col">
                                <div class="footer-contact"><?php
                                                            $heading = imagroup_theme_option('footer_column_three', 'heading');
                                                            if (!empty($heading)) { ?>
                                        <span class="span-heading"><?php echo $heading; ?></span><?php
                                                                                                }

                                                                                                $content = imagroup_theme_option('footer_column_three', 'content');
                                                                                                if (!empty($content)) {
                                                                                                    echo imagroup_remove_empty_p(wpautop($content));
                                                                                                }

                                                                                                $linkedin = imagroup_theme_option('footer_column_three', 'linkedin');
                                                                                                $facebook = imagroup_theme_option('footer_column_three', 'facebook');
                                                                                                if (!empty($linkedin) || !empty($facebook)) { ?>
                                        <ul class="footer-social"><?php
                                                                                                    if (!empty($linkedin)) { ?>
                                                <li><a href="<?php echo esc_url($linkedin); ?>"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin.svg" alt="linkedin" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-hover.svg" alt="linkedin" class="hover-icon"></a></li><?php
                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                if (!empty($facebook)) { ?>
                                                <li><a href="<?php echo esc_url($facebook); ?>"><img src="<?php echo IMAGE_ASSETS_URL; ?>/facebook.svg" alt="facebook" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/facebook-hover.svg" alt="facebook" class="hover-icon"></a></li><?php
                                                                                                                                                                                                                                                                                                } ?>
                                        </ul><?php
                                                                                                } ?>
                                </div>
                            </div>
                        </div><?php

                                $content = imagroup_theme_option('footer_bottom_area_content');
                                if (!empty($content)) { ?>
                            <div class="footer-bottom">
                                <?php echo imagroup_remove_empty_p(wpautop($content)); ?>
                            </div><?php
                                } ?>
                    </div>
                </div>
            </footer>
            <!-- footer -->

            <div id="sk-overlay"></div>

            <!-- scroll-top -->
            <a href="#" class="scroll-top"></a><?php

                                                if (!empty($success_popup)) {
                                                    echo $success_popup;
                                                } ?>
            </div>
            <?php wp_footer(); ?>

            </body>

            </html>
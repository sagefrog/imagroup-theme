<?php

$xls = get_sub_field( 'responsive_space_extra_large_screen' );
$ls = get_sub_field( 'responsive_space_large_screen' );
$ms = get_sub_field( 'responsive_space_medium_screen' );
$ss = get_sub_field( 'responsive_space_small_screen' );
$ess = get_sub_field( 'responsive_space_extra_small_screen' );

?>

<div class="sk-space-module" data-xls="<?php echo esc_attr($xls); ?>" data-ls="<?php echo esc_attr($ls); ?>" data-ms="<?php echo esc_attr($ms); ?>" data-ss="<?php echo esc_attr($ss); ?>" data-ess="<?php echo esc_attr($ess); ?>"></div>
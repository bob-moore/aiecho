<?php

if ( ! function_exists( 'get_fields' ) ) {
    return;
}
do_action( 'qm/debug', get_fields() );

do_action( 
    'mwf_cornerstone_render_template', 
    ['@mwf_cornerstone/link-block/block.twig'], 
    ['fields' => get_fields()]
);
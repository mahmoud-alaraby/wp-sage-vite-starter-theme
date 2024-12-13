<?php

$files = array_merge(
    glob(__DIR__ . '/acf-blocks/*.php')
);
foreach ($files as $filename) {
    include $filename;
}

add_filter('block_categories', function ($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'c95-builder',
                'title' => 'Code95 Builder',
            ),
        )
    );
}, 10, 2);

add_action('acf/init', 'my_acf_init');
function my_acf_init()
{
    // check function exists
    if (function_exists('acf_register_block')) {

        $blocks = [
            [
                'name'                => 'slider',
                'title'                => __('Slider'),
                'description'        => __('Add Slider'),
                'render_callback'    => 'my_acf_block_render_callback',
                'category'            => 'c95-builder',
                'icon'                => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M5 4v3h5.5v12h3V7H19V4z"></path><path fill="none" d="M0 0h24v24H0V0z"></path></svg>',
                'keywords'            => array('slider', 'quote'),
            ],

        ];


        foreach ($blocks as $block) {
            acf_register_block([
                'name'              => $block['name'],
                'title'             => $block['title'],
                'description'       => $block['description'] ?? null,
                'render_callback'   => 'my_acf_block_render_callback',
                'category'          => $block['category'] ?? 'builder',
                'icon'              => $block['icon'] ?? 'layout',
                'keywords'          => $block['keywords'] ?? []
            ]);
        }
    }
}

function my_acf_block_render_callback($block)
{
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if (is_admin()) {
        if (file_exists(get_theme_file_path() . "/resources/views/blocks/back-end/{$slug}.blade.php")) {
            echo view("blocks.back-end.{$slug}");
        }
    } else {
        if (file_exists(get_theme_file_path() . "/resources/views/blocks/front-end/{$slug}.blade.php")) {
            echo view("blocks.front-end.{$slug}");
        }
    }
}

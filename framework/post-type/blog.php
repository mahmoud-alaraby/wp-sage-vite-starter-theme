<?php // Register Custom Post Type
function blog_post_type() {

	$labels = array(

		'name'                  => _x( 'MUST Blog', 'MUST Blog', 'must' ),
		'singular_name'         => _x( 'MUST Blog', 'MUST Blog', 'must' ),
		'menu_name'             => __( 'MUST Blog', 'must' ),
		'name_admin_bar'        => __( 'MUST Blog', 'must' ),
		'archives'              => __( 'Item Archives blog', 'must' ),
		'attributes'            => __( 'Item Attributes', 'must' ),
		'parent_item_colon'     => __( 'Parent blog:', 'must' ),
		'all_items'             => __( 'All blog posts', 'must' ),
		'add_new_item'          => __( 'Add New Post', 'must' ),
		'add_new'               => __( 'Add New Post', 'must' ),
		'new_item'              => __( 'New Post', 'must' ),
		'edit_item'             => __( 'Edit Post', 'must' ),
		'update_item'           => __( 'Update Post', 'must' ),
		'view_item'             => __( 'View Post', 'must' ),
		'view_items'            => __( 'View Post', 'must' ),
		'search_items'          => __( 'Search Item', 'must' ),
		'not_found'             => __( 'Not found any Post', 'must' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'must' ),
		'featured_image'        => __( 'Featured Image', 'must' ),
		'set_featured_image'    => __( 'Set featured image', 'must' ),
		'remove_featured_image' => __( 'Remove featured image', 'must' ),
		'use_featured_image'    => __( 'Use as featured image', 'must' ),
		'insert_into_item'      => __( 'Insert into item', 'must' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'must' ),
		'items_list'            => __( 'Items list', 'must' ),
		'items_list_navigation' => __( 'Items list navigation', 'must' ),
		'filter_items_list'     => __( 'Filter items list', 'must' ),
	);
	$args = array(
		'label'                 => __( 'blog', 'must' ),
		'description'           => __( 'blog section', 'must' ),
		'labels'                => $labels,
		'supports'              =>array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions','post-formats' ),
		'show_in_rest' => true,
		'taxonomies'            => array(),
		'hierarchical'          => true,
		'public'                => true,
		// show tag in blockeditor
		'taxonomies'            => array( 'post_tag'),
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' 			=> 'dashicons-schedule',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'blog', $args );

	// create a new taxonomy
    $tax_labels_project = array(
        'name' => _x('blog category', 'blog category', 'must'),
        'singular_name' => _x('blog category', 'blog category', 'must'),
        'menu_name' => __('Blog Category', 'must'),
        'parent_item_colon' => __('Parent Item', 'must'),
        'all_items' => __('Blog Category', 'must'),
        'view_item' => __('View', 'must'),
        'add_new_item' => __('Add New Blog Category', 'must'),
        'add_new' => __('Add New Blog Category', 'must'),
        'edit_item' => __('Edit', 'must'),
        'update_item' => __('Update', 'must'),
        'search_items' => __('Search', 'must'),
        'not_found' => __('not found', 'must'),
        'not_found_in_trash' => __('not found in trash', 'must')
    );
    $tax_args_project = array(
        'labels' => $tax_labels_project,
        'rewrite' => array('slug' => 'blog_category'),
        'hierarchical' => true,
        'show_admin_column' => true,
		// show taxonomy i block editor
		'show_in_rest' => true,
    );
    register_taxonomy('blog_category', array('blog'), $tax_args_project);

}
add_action( 'init', 'blog_post_type', 0 );

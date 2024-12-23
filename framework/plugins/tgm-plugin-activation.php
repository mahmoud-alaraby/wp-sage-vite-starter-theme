<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */


/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once dirname(__FILE__) . '/TGM/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins()
{

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $current_stage = WP_ENV;
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name' => 'Advanced Custom Fields Pro',
            'slug' => 'advanced-custom-fields-pro',
            'source' => 'https://github.com/wp-premium/advanced-custom-fields-pro/archive/master.zip',
            'required' => true,
            'external_url' => 'https://github.com/wp-premium/advanced-custom-fields-pro.git', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name' => 'ACF Post Type Selector',
            'slug' => 'acf-post-type-selector',
            'source' => 'https://github.com/TimPerry/acf-post-type-selector/archive/master.zip',
            'required' => true,
            'external_url' => 'https://github.com/TimPerry/acf-post-type-selector.git', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name' => 'Download Advanced Custom Fields: Font Awesome Field',
            'slug' => 'advanced-custom-fields-font-awesome',
            'source' => 'https://downloads.wordpress.org/plugin/advanced-custom-fields-font-awesome.4.0.5.zip',
            'required' => true,
            'external_url' => 'https://wordpress.org/plugins/advanced-custom-fields-font-awesome/', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name' => 'WPML',
            'slug' => 'wpml',
            'source' => 'https://github.com/mahmoud-alaraby/wp-wpml/archive/refs/heads/main.zip',
            'required' => true,
            'external_url' => 'https://wpml.org', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name' => 'WP-Forms',
            'slug' => 'wp-forms',
            'source' => 'https://github.com/mahmoud-alaraby/wp-forms/archive/refs/heads/main.zip',
            'required' => true,
            'external_url' => 'https://wpforms.com', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name' => 'Force Regenerate Thumbnails',
            'slug' => 'force-regenerate-thumbnails',
            'required' => true,
        ),
        array(
            'name' => 'Simple Custom Post Order',
            'slug' => 'simple-custom-post-order',
            'required' => true,
        ),
    );

    if ($current_stage == 'local') {
        $plugins[] = array(
            'name' => 'wpml sitepress multilingual cms',
            'slug' => 'sitepress-multilingual-cms',
            'source' => 'https://github.com/MA7MOUDAL3RABY/wmpl-sitepress-multilingual-cms/archive/refs/heads/main.zip',
            'required' => true,
            'external_url' => 'https://github.com/MA7MOUDAL3RABY/wmpl-sitepress-multilingual-cms', // If set, overrides default API URL and points to an external URL.
        );
    } elseif ($current_stage == 'development' || $current_stage == 'local') {
        $plugins[] = array(
            'name' => 'Query Monitor',
            'slug' => 'query-monitor',
            'required' => true,
        );
    } elseif ($current_stage == 'production') {
        $plugins[] = array(
            'name' => 'WordPress SEO by Yoast',
            'slug' => 'wordpress-seo',
            'required' => true,
        );
        $plugins[] = array(
            'name' => 'WP Security Audit Log',
            'slug' => 'wp-security-audit-log',
            'required' => true,
        );
    }
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __('Install Required Plugins', 'tgmpa'),
            'menu_title'                      => __('Install Plugins', 'tgmpa'),
            'installing'                      => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops'                            => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins'),
            'return'                          => __('Return to Required Plugins Installer', 'tgmpa'),
            'plugin_activated'                => __('Plugin activated successfully.', 'tgmpa'),
            'complete'                        => __('All plugins installed and activated successfully. %s', 'tgmpa'), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa($plugins, $config);
}

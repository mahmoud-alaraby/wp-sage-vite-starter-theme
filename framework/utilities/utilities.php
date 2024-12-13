<?php

use Roots\Sage\Assets;

/**
 * This is the description for the Utilities class.
 *
 * @package    Utilities
 * @author     Code95 (Superheroes Team)
 * @version    1.0.0
 * @since      1.0.0 First time this was introduced.
 * @copyright  All right reseved Code95 - 2017
 * @link       http://code95.com.
 */
class Utilities
{
    /**
     * Function Name: Framework Path - Utilities::resources_path();
     * This Function can return the framework folder path to uesd it in our Code
     * @param ($filename) Add param in function have a file path in the framework root
     * @return ( All Path )
     */
    static function resources_path($filename)
    {
        $dist_path = get_template_directory_uri();
        $directory = dirname($filename) . '/';
        $file = basename($filename);

        return $dist_path . $directory . $file;
    }
    /**
     * Function Name: Global Thumbnails - Utilities::global_thumbnails();
     * This Function can return the url of any upload image
     * @param ($id, $size, true)
     * @return ( Just URl)
     */
    static function global_thumbnails($id, $size = 'large', $echo = true)
    {
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($id), $size);
        $default_image = get_field('default_image', 'option');
        if ($thumbnail) :
            $output = $thumbnail[0];
        elseif ($default_image) :
            $output = $default_image;
        else :
            $output = Utilities::resources_path('images/placeholder.jpg');
        endif;

        if ($echo) {
            echo $output;
        } else {
            return $output;
        }
    }
    /**
     * Function Name: C95 Shortcode - Utilities::c95_shortcode();
     * This Function can return the All of shortcodes in website
     * @param ()
     * @return (All in ShortCode array)
     */
    static function c95_shortcode()
    {
        $shortcodes = array(
            'C95 ShortCode' => 'c95_shortcode',
        );
        foreach ($shortcodes as $key => $shortcode) :
            echo '<option value="' . $shortcode . '">' . $key . '</option>';
        endforeach;
    }

     /**
    * Estimated reading time in minutes
    *
    * @param $content
    *
    * @return int estimated time in minutes
    */

    //estimated reading time
    static function reading_time($the_content) {

        if (!function_exists('mb_str_word_count')) {
            function mb_str_word_count($string, $format = 0, $charlist = '[]') {
                $string=trim($string);
                if(empty($string))
                    $words = array();
                else
                    $words = preg_split('~[^\p{L}\p{N}\']+~u',$string);
                switch ($format) {
                    case 0:
                        return count($words);
                        break;
                    case 1:
                    case 2:
                        return $words;
                        break;
                    default:
                        return $words;
                        break;
                }
            }
        }

        if(ICL_LANGUAGE_CODE == 'ar') {
            $word_count = mb_str_word_count($the_content) . PHP_EOL;
            $readingtime = ceil($word_count / 200);
        } else {
            $word_count = str_word_count( strip_tags( $the_content ) );
            $readingtime = ceil($word_count / 200);
        }


        return $readingtime;
    }


    /**
     * Function Name: is subcategory - Utilities::is_subcategory();
     * This Function can Check for the subcategory page and redurict to it
     * @param ()
     * @return (All in ShortCode array)
     */
    static function is_subcategory($cat_id = NULL)
    {
        if (!$cat_id)
            $cat_id = get_query_var('cat');
        if ($cat_id) {
            $cat = get_category($cat_id);
            if ($cat->category_parent > 0)
                return true;
        }
        return false;
    }


    /**
     * Function Name: language selector flags - Utilities::language_selector_flags();
     * This Function can Check for the language selector flags
     * @param ()
     * @return (All in ShortCode array)
     */
    static  function language_selector_flags()
    {
        if (function_exists('icl_get_languages')) {
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            ?>
                <div class="lang-switcher">
                    <?php
                    if (!empty($languages)) {
                        foreach ($languages as $l) {
                            if (!$l['active']) {
                    ?>
                                <a class="lang-name ff-<?= ICL_LANGUAGE_CODE == 'ar' ? 'en' : 'ar' ?>" href="<?= $l['url'] ?> ">
                                    <?= $l['native_name']; ?>
                                </a>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            <?php
        }
    }

        /**
     * Function Name: menu_title Path - Helpers::menu_title();
     * This Function can return the title of menu based on location param
     * @param ($location) Add location param in function to get the menu title
     * @return ( All Path )
     */
    static function menu_title($location)
    {

        if (array_key_exists($location, get_nav_menu_locations() )) {
            // Get the menu object for the specified location
            $menu_object = wp_get_nav_menu_object(get_nav_menu_locations()[$location]);

            // Get the title of the menu
            $menu_title = $menu_object->name;

            // Output the title
            return $menu_title;
        } else {
            return;
        }
    }


    /* End of the Utilities class. */
}
   
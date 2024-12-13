<?php
/**
* Function Name: C95 Pagination - c95_pagination();
* This Function can return WordPress Bootstrap Pagination
**/

if (!function_exists('juhayna_pagination')) :

    /**
    * Display navigation to next/previous set of posts when applicable.
    * Based on paging nav function from Twenty Fourteen
    */
    function juhayna_pagination() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 1) {
          return;
        }
  
        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);
  
        if (isset($url_parts[1])) {
          wp_parse_str($url_parts[1], $query_args);
        }
  
        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';
  
        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
  
        // Set up paginated links.
        $links = paginate_links(array(
          'base' => $pagenum_link,
          'format' => $format,
          'total' => $GLOBALS['wp_query']->max_num_pages,
          'current' => $paged,
          'mid_size' => 2,
          'add_args' => array_map('urlencode', $query_args),
          'prev_text'    => '<span class="active-arrow"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.86966 17L1 8.99546M1 8.99546L8.86966 1M1 8.99546L17 8.99546" stroke="#221F20" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/></svg></span>',
          'next_text'    => '<span class="active-arrow"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.13034 17L17 8.99546M17 8.99546L9.13034 1M17 8.99546L1 8.99546" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/></svg></span>',
          'type' => 'list',
        ));
  

        
        if ($links) :
          ?>
  <div class="pagination">
    <?php echo $links; ?>
  </div><!-- .navigation -->
  <?php
        endif;
      }
  
    endif;
  
  ?>
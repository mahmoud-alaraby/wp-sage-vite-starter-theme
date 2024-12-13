<?php 
add_action("wp_ajax_filter_posts", "filter_posts");
add_action("wp_ajax_nopriv_filter_posts", "my_must_login");

function filter_posts() {   
           
    $page = (isset($_GET['page']))? ($_GET['page']) : 1 ;
    $l_posts = array(
    'post_type' => 'news',
    'posts_per_page' => -1,
    'paged' => $page,
    ); 
    $query_posts = new WP_Query($l_posts);
    $cleanedCatValues= array();
    $cleanedValues = array();
        if (isset($_POST['checkedValues']) && !empty($_POST['checkedValues'])) {
        
        $cleanedValues = array_map(function($value) {
            return str_replace(["'", "\\"], "", $value);
        }, $_POST['checkedValues']);

        // Implode the cleaned values with commas and wrap them in single quotes
        $finalValues = "'" . implode("','", $cleanedValues) . "'";
        
    }
    if (isset($_POST['catValues']) && !empty($_POST['catValues'])) {
        
        $cleanedCatValues = array_map(function($value) {
            return str_replace(["'", "\\"], "", $value);
        }, $_POST['catValues']);
        $finacatlValues = "'" . implode("','", $cleanedCatValues) . "'";
    }

    $taxonomies = array(
        'news_tag' =>  $cleanedValues,
        'news_category' => $cleanedCatValues,
    );
    
    $tax_query = array();

    // Loop through each taxonomy and its terms
    foreach ($taxonomies as $taxonomy => $terms) {
        if($terms != []) {
        $l_posts['tax_query'][] = array(
            'taxonomy' =>$taxonomy,
            'field' => 'name',
            'terms' => $terms,
            'operator' => 'IN'
        );
    }
    }

    $query_posts = new WP_Query($l_posts);

    $count = 0; ?>
   
    <div class="row news">

        <?php
        if($query_posts->have_posts()) {
            while ( $query_posts->have_posts() ) {
                $query_posts->the_post();
            
                $count++;
                $date = get_the_date('j F، Y');
                $timestamp = strtotime($date); // Convert the date string to a Unix timestamp
                $formatted_date = date_i18n('j F، Y', $timestamp, true, 'ar'); // Format the date in Arabic
                $news_post_author = get_the_author();
            
                $news_post_category = get_the_terms(get_the_ID(  ), 'news_category');
                $post_category_name = $news_post_category[0]->name;
                
                $show_read_more = get_field('show_button');
            ?>
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="<?= 200 * $count ?>" data-aos-once="true">
                <div class="single-news mb-3">
                    <div class="news-image position-relative mb-4">
                        <a class="w-100" href="<?= the_permalink(get_the_ID()) ?>"><img src="<?= Utilities::global_thumbnails(get_the_ID(), 'large') ?>" alt="<?= get_the_title(get_the_ID()) ?>"></a>
                    </div>
                    <div class="news-content-wrapper">
                        <div class="d-flex justify-content-between mb-3">
                            <p class="mb-0 font-12 font-weight-300 line-height-14">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.6667 13.9597V13.9598C13.6667 14.2121 13.5715 14.4551 13.3999 14.6401C13.2298 14.8235 12.9973 14.9365 12.7481 14.9568L12.6611 14.9597H3.33333H3.33323C3.08094 14.9598 2.83794 14.8645 2.65295 14.693C2.46954 14.5229 2.35659 14.2903 2.33623 14.0412L2.33333 13.9542V13.2931C2.33333 13.2931 2.33333 13.2931 2.33333 13.2931C2.33338 12.52 2.63186 11.7768 3.16653 11.2184C3.70043 10.6608 4.42869 10.3306 5.19981 10.2962L5.33721 10.293H10.6666C10.6667 10.293 10.6667 10.293 10.6667 10.293C11.4397 10.2931 12.183 10.5916 12.7413 11.1262C13.2989 11.6601 13.6291 12.3884 13.6635 13.1595L13.6667 13.2969V13.9597ZM8 2.29305C8.79565 2.29305 9.55871 2.60912 10.1213 3.17173C10.6839 3.73434 11 4.4974 11 5.29305C11 6.0887 10.6839 6.85176 10.1213 7.41437C9.55871 7.97698 8.79565 8.29305 8 8.29305C7.20435 8.29305 6.44129 7.97698 5.87868 7.41437C5.31607 6.85176 5 6.0887 5 5.29305C5 4.4974 5.31607 3.73434 5.87868 3.17173C6.44129 2.60912 7.20435 2.29305 8 2.29305Z" stroke="#00AC5C" stroke-width="0.666667"/>
                            </svg>
                            <?= __('By', 'must') ?> <?= $news_post_author?>
                            </p>

                            <p class="mb-0 font-12 font-weight-300 line-height-14 tes">
                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.60736 2.41736C7.47181 2.05929 8.39832 1.875 9.33398 1.875C10.2697 1.875 11.1962 2.05929 12.0606 2.41736C12.925 2.77542 13.7105 3.30025 14.3721 3.96186C15.0337 4.62348 15.5586 5.40894 15.9166 6.27338C16.2747 7.13783 16.459 8.06433 16.459 9C16.459 10.8897 15.7083 12.7019 14.3721 14.0381C13.0359 15.3743 11.2237 16.125 9.33398 16.125C8.39832 16.125 7.47181 15.9407 6.60737 15.5826C5.74292 15.2246 4.95747 14.6998 4.29585 14.0381C2.95965 12.7019 2.20898 10.8897 2.20898 9C2.20898 7.11033 2.95965 5.29806 4.29585 3.96186C4.95747 3.30025 5.74292 2.77542 6.60736 2.41736ZM11.8027 12.1711C12.2468 12.4444 12.8284 12.3059 13.1017 11.8618C13.3771 11.4141 13.234 10.8277 12.7833 10.5573L10.266 9.04692C10.1531 8.97915 10.084 8.85708 10.084 8.72536V5.8125C10.084 5.29473 9.66425 4.875 9.14648 4.875C8.62872 4.875 8.20898 5.29473 8.20898 5.8125V9.3309C8.20898 9.72157 8.41166 10.0843 8.74438 10.289L11.8027 12.1711Z" stroke="#00AC5C" stroke-width="0.75"/>
                            </svg>
                            <?= $date ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                    
                        <p class="mb-0 font-12 font-weight-300 line-height-14">
                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2584 8.89812L14.612 9.25168L14.613 9.25062L14.2584 8.89812ZM9.27056 13.886L8.91701 13.5324L8.91681 13.5326L9.27056 13.886ZM14.2584 6.93638L14.613 6.58387L14.612 6.58282L14.2584 6.93638ZM8.86851 1.54648L8.51496 1.90003L8.51496 1.90003L8.86851 1.54648ZM1.91278 8.50318L1.55943 8.85694H1.55943L1.91278 8.50318ZM7.30185 13.886L7.6556 13.5326L7.6552 13.5322L7.30185 13.886ZM8.81899 14.188L8.62752 13.7261H8.62752L8.81899 14.188ZM13.9049 8.54457L8.91701 13.5324L9.62411 14.2395L14.612 9.25168L13.9049 8.54457ZM14.163 7.91725C14.163 8.15272 14.0698 8.37863 13.9038 8.54562L14.613 9.25062C14.9653 8.89626 15.163 8.41691 15.163 7.91725H14.163ZM13.9038 7.28888C14.0698 7.45587 14.163 7.68178 14.163 7.91725H15.163C15.163 7.41759 14.9653 6.93824 14.613 6.58388L13.9038 7.28888ZM8.51496 1.90003L13.9049 7.28993L14.612 6.58282L9.22207 1.19293L8.51496 1.90003ZM7.4543 1.46069C7.85213 1.46069 8.23366 1.61873 8.51496 1.90003L9.22207 1.19293C8.75323 0.724086 8.11734 0.460693 7.4543 0.460693V1.46069ZM3.32617 1.46069H7.4543V0.460693H3.32617V1.46069ZM1.82617 2.96069C1.82617 2.13227 2.49774 1.46069 3.32617 1.46069V0.460693C1.94546 0.460693 0.826172 1.57998 0.826172 2.96069H1.82617ZM1.82617 7.08814V2.96069H0.826172V7.08814H1.82617ZM2.26613 8.14942C1.98445 7.86806 1.82617 7.48627 1.82617 7.08814H0.826172C0.826172 7.75169 1.08996 8.38801 1.55943 8.85694L2.26613 8.14942ZM7.6552 13.5322L2.26613 8.14942L1.55943 8.85694L6.94851 14.2397L7.6552 13.5322ZM7.94489 13.7261C7.83668 13.6812 7.73838 13.6155 7.6556 13.5326L6.9481 14.2393C7.12375 14.4152 7.33235 14.5547 7.56195 14.6499L7.94489 13.7261ZM8.28621 13.794C8.16907 13.794 8.05309 13.7709 7.94489 13.7261L7.56195 14.6499C7.79155 14.745 8.03766 14.794 8.28621 14.794V13.794ZM8.62752 13.7261C8.51932 13.7709 8.40334 13.794 8.28621 13.794V14.794C8.53475 14.794 8.78086 14.745 9.01047 14.6499L8.62752 13.7261ZM8.91681 13.5326C8.83403 13.6155 8.73573 13.6812 8.62752 13.7261L9.01047 14.6499C9.24007 14.5547 9.44866 14.4152 9.62431 14.2393L8.91681 13.5326ZM5.00168 4.09142C5.00168 4.39157 4.75835 4.6349 4.4582 4.6349V5.6349C5.31064 5.6349 6.00168 4.94386 6.00168 4.09142H5.00168ZM4.4582 3.54793C4.75835 3.54793 5.00168 3.79126 5.00168 4.09142H6.00168C6.00168 3.23897 5.31064 2.54793 4.4582 2.54793V3.54793ZM3.91471 4.09142C3.91471 3.79126 4.15804 3.54793 4.4582 3.54793V2.54793C3.60575 2.54793 2.91471 3.23897 2.91471 4.09142H3.91471ZM4.4582 4.6349C4.15804 4.6349 3.91471 4.39157 3.91471 4.09142H2.91471C2.91471 4.94386 3.60575 5.6349 4.4582 5.6349V4.6349Z" fill="#00AC5C"/>
                            </svg>  
                            <?= $post_category_name ?>
                        </p>
                    
                        </div>
                        <a href="<?= the_permalink(get_the_ID()) ?>">
                        <h3 class="pointer font-16 mb-4"><?= wp_trim_words(get_the_title(get_the_ID()), 14) ?></h3>
                        </a>
                        
                        <a href="<?= get_the_permalink() ?>" class="read-more-btn text-blue-white font-16 d-flex mt-3 align-items-end"><?= __('Read More', 'must') ?><i class="flaticon-next"></i></a>
            
                    
                    </div>
                </div>
            </div>
            <?php
            }
        }else { ?>
            <div class="no-results">
                <h6><?=  _e('Sorry, no results were found.', 'must') ?></h6>
            </div>
        <?php }
        ?>
    </div>
<?php
    
    // Send the HTML markup as the AJAX response
    // wp_send_json_success( $html_output );
    
    // $response = wp_send_json_success( $html_output );


    // For debugging purposes, log the response
   // error_log(print_r($response, true));

    // Return JSON response
   // wp_send_json($response);

    // Always exit after AJAX calls
    die; 
}

 
?>

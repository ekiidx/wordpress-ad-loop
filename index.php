<?php

    //   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $get_posts = new WP_Query(array(
        'post_type'         => 'articles',
        'post_status'       =>'publish', 
        'posts_per_page'    =>-1
    ));

    $posts = get_posts(array(
        'post_type' => 'ads',
        'posts_per_page' =>-1,
        //'orderby'   => 'date'
      ));
      
    $master = [];
    $counter = 1;

    if ( $get_posts -> have_posts() ) : 
        while ( $get_posts -> have_posts() ) : 
            $get_posts -> the_post();

                echo the_title();

                if ($counter % 3 === 0 ) {

                        foreach ($posts as $post) {
                            setup_postdata($post);
                        
                            $title = $post->post_title;
                            $post_id = $post->ID;
                            $master[$title] = $posts[($counter-1)/3]->post_title;
                    
                        }
                      wp_reset_postdata(); 

                    if ($master[$title]) {
                        $master[$title];
                    }
                }
                $counter++;
        endwhile;

    else : ?>
        <p class="notice"><?php _e( 'There are no posts to display at the moment.' ); ?></p> <?php 
    endif;
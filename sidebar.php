

<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-4 dg-nav float-left-to-right" role="complementary">

    <!-- new side navigation -->

    <h2><a href="/">Introduction</a></h2>
    <!-- child pages below-->




    <?php

    $thispost = $wp_query->post->ID;


    $page_get = get_page_by_title('Design guide');

    if ($page_get) {
        $page_id = $page_get->ID;
    }


    // loop through the sub-pages for the current page.

    $childpages = new WP_Query(array(
            'post_type' => 'page',
            'post_parent' => $page_id,
            'posts_per_page' => -1,
           // 'post__not_in' => array(get_option('page_on_front')),
            'orderby' => 'menu_order date',
            'order' => 'ASC'
        )
    );

    while ($childpages->have_posts()) : $childpages->the_post();

        ?>



        <h3><a href="<?php echo (make_path_relative(get_page_link())); ?>">
                <?php the_title(); ?>
            </a></h3>



        <?php
        $child_page_id = get_the_ID();
        // loop through the sub-pages for each child page as grandchildren.
        $grandchildrenpages = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => $child_page_id,
                'posts_per_page' => -1,
    //                'cat' => -EXCLUDE_FROM_INDEX_PAGE,
                'orderby' => 'menu_order date',
                'order' => 'ASC'
            )
        );
        if ($grandchildrenpages->have_posts()):?>
            <ul class="">
                <?php
                while ($grandchildrenpages->have_posts()) : $grandchildrenpages->the_post();

                    $current = $post->ID;

                    ?>
                    <li>
                        <?php
                        if ($current == $thispost) {


                            ?>

                            <?php the_title(); ?>


                        <?php } else {
                            ?>
                            <a href="<?php echo (make_path_relative(get_page_link())); ?>">
                                <?php the_title(); ?>
                            </a>
                        <?php } ?>
                    </li>
                <?php endwhile;
                wp_reset_query(); ?>
            </ul>
        <?php endif; ?>
    <?php endwhile;
    wp_reset_postdata(); ?>



</aside>


<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-4 float-left-to-right" role="complementary">

    <div class="dg-nav">
        <div class="dg-nav-content">
    <!-- new side navigation -->

            <?php

            // $thispost = gets id of current post, used to set navigation styles

            $thispost = $wp_query->post->ID;

            // $home_id = gets id of home page, used to set top level in navigation hierarchy

            $home_id = get_option('page_on_front');


if (is_front_page()){?>
    <h2>Introduction</h2>
    <?php

}else {
    ?>

    <h2><a href="<?php echo(home_url('/'));?>">Introduction</a></h2>


<?php
}

    // loop through the sub-pages for the current page.

    $pages = new WP_Query(array(
      'post_type' => 'page',
//          'post_parent' => $home_id,
        'category_name' => 'design-guide',
            'posts_per_page' => -1,
           'post__not_in' => array(get_option('page_on_front')),
            'orderby' => 'menu_order title',
            'order' => 'ASC',
        'post_parent' => 0
        )
    );

    while ($pages->have_posts()) : $pages->the_post();

$current = $pages->post->ID;

            if ($current == $thispost) { ?>

           <h3><?php the_title(); ?></h3>
            <?php }else {?>



        <h3><a href="<?php echo (make_path_relative(get_page_link())); ?>">
                <?php the_title(); ?>
            </a></h3>

            <?php }


        $child_page_id = get_the_ID();
        // loop through the sub-pages for each child page to build nested navigation in sidebar.
        $childrenpages = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => $child_page_id,
                'posts_per_page' => -1,
    //                'cat' => -EXCLUDE_FROM_INDEX_PAGE,
                'orderby' => 'menu_order date',
                'order' => 'ASC'

            )
        );
        if ($childrenpages->have_posts()):?>
            <ul class="full">
                <?php
                while ($childrenpages->have_posts()) : $childrenpages->the_post();

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

    </div>    </div>

</aside>
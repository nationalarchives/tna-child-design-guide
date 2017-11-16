<?php if ( ! is_single() ) { ?>
	<!-- page.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <?php

    if (is_page("design-guide")){

//        $image_id = get_post_thumbnail_id($page->ID);
//        $image_url = wp_get_attachment_image_src($image_id, 'full', false);
//
//
//        if ($image_url) {
//
//            ?>
<!---->
<!--            <img src="--><?php //echo(make_path_relative($image_url[0])); ?><!--" width="100%">-->
<!---->
<!--            <h1 style="display:none;">--><?php //the_title(); ?><!--</h1>-->

        <div class="intro"><h1><?php the_title(); ?></h1>
            <ul class="content">
            <li><a href="#sidebar">Guidelines</a></li>
            </ul>

        </div>



        <?php
    //}
    }else{?>


		<div class="entry-header">






			<h1><?php the_title(); ?></h1>
		</div>
        <?php }?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
<?php } else { ?>
	<!-- singe.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
<?php } ?>
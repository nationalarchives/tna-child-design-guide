<?php if ( ! is_single() ) { ?>
	<!-- page.php -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <?php

    if (is_page("design-guide")){
        ?>

        <div class="intro"><h1><?php the_title(); ?></h1>
            <ul class="content">
            <li><a href="#sidebar">Guidelines</a></li>
            </ul>

        </div>



        <?php
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
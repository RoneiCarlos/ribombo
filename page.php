<?php
/**
 * @package Ribombo
 * @since Ribombo 1.0
 */

get_header();
?>
<!-- posts -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="jumbotron">
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
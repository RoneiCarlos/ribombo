<?php get_header(); ?>
<!-- posts -->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post(); ?>
                    <div class="jumbotron">
                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <p><?php the_date(); ?> por <b><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author(); ?></a></b></p>
                        
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid mb-3')); ?>
                        
                        <?php the_content(); ?>
                        
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
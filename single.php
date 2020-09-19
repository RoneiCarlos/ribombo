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
                        <p>Por <?php the_author(); ?> em <?php the_date(); ?></p>
                        
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid mb-3')); ?>
                        
                        <?php the_content(); ?>
                        
                        
                    
                <?php endwhile; ?>
            <?php endif; ?>
                        <hr>
                        <div class="card border-white col-md-12 mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-img-top" style="border-radius: 3px; overflow: hidden;">
                                        <?php echo get_avatar( get_the_author_meta('ID'),400,'','', array( 'class' => 'img-fluid'));?>
                                    </div>
                            
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="col-md-12 mt-2 btn btn-outline-info">Mais publicações</a>
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Escrito por: <?php echo get_the_author_meta('display_name'); ?></h5>
                                        <br>
                                        <p><?php echo get_the_author_meta('description'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
    </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
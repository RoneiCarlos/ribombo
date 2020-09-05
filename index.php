<?php
/**
 * @package Ribombo
 * @since Ribombo 1.0
 */

get_header();
?>
<!-- carroussel -->
<div class="container">
    <div class="row">
        <div class="col mb-5">
            <div id="carouselExampleCaptions" class="carousel slide center mx-5" data-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                        $my_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => '3'
                        );

                        $my_query = new WP_Query ($my_args);
                    ?>  
                    <?php if($my_query->have_posts()):while($my_query->have_posts()):$my_query->the_post(); ?>
                        <div class="text-center carousel-item <?php $c++; if($c == 1){echo ' active';} ?>" style="height: 30rem; overflow: hidden;">
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('post_thumbnail', array('class' => 'img-fluid')); ?></a>
                            <div class="carousel-caption d-none d-md-block bg-c-white">
                                <a href="<?php the_permalink() ?>"><h5><?php the_title(); ?></h5></a>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
                </div>
                <a class="ml-4 carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="mr-4 carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- menu de produções -->
<div class="container">
    <div class="row">
        <div class="text-white text-center col-md-3 mb-4">
            <a href="<?php echo get_category_link(get_cat_ID('podcast')) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/podcast.jpg" class="img-fluid rounded"></a>
            <div class="card-img-overlay rounded margin-div">
            <h4 class="card-title" style="padding-top: 33%;">Podcasts</h4></a>
            </div>
        </div>
        <div class="text-white text-center col-md-3 mb-4">
            <a href="<?php echo get_category_link(get_cat_ID('publicacoes')) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/publicacao.jpg" class="img-fluid rounded"></a>
            <div class="card-img-overlay rounded margin-div">
                <h4 class="card-title" style="padding-top: 33%;">Publicações</h4>
            </div>
        </div>
        <div class="text-white text-center col-md-3 mb-4">
            <a href="<?php echo get_category_link(get_cat_ID('videos')) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/video.jpg" class="img-fluid rounded"></a>
            <div class="card-img-overlay rounded margin-div">
                <h4 class="card-title" style="padding-top: 33%;">Vídeos</h4>
            </div>
        </div>
        <div class="text-white text-center col-md-3 mb-4">
            <a href="<?php echo get_category_link(get_cat_ID('eventos')) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/evento.jpg" class="img-fluid rounded"></a>
            <div class="card-img-overlay rounded margin-div">
                <h4 class="card-title" style="padding-top: 33%;">Eventos</h4>
            </div>
        </div>
    </div>
</div>

<!-- divisor -->
<hr class="mt-0 mb-4 container">
<!-- posts -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if(have_posts()): ?>
                <?php while(have_posts()): the_post(); ?>
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-md-4 mb-3" style="height: 12em; overflow: hidden;">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid')); ?></a>
                            </div>
                            <div class="col-md-8">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <p><b><?php the_date(); ?></b> por <b><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author(); ?></a></b></p>
                            </div>
                        </div>
                        <?php the_excerpt(); ?>
                        <div class="row">
                            <div class="offset-sm-9 offset-md-9 offset-lg-10">
                                <button class="btn btn-outline-info">
                                    <a href="<?php the_permalink(); ?>">Veja mais</a>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; wp_reset_query(); ?>
            <div class="pagination col-md-5 mb-4">
                <?php previous_posts_link('< Mais recentes'); ?> <?php next_posts_link('Mais antigos >'); ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
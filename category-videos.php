<?php
/**
 * @package Ribombo
 * @since Ribombo 1.0
 */

get_header();
?>


<div class="container">
<h1>Vídeos</h1>
    <div class="row">
        <div class="col-md-8">

            <?php 
                $my_args = array(
                    'post_type' => 'post',
                    'category_name' => array('videos',
                                             'videos-educomunicacao',
                                             'videos-educacao-ambiental',
                                             'entrevistas'),
                    'posts_per_page' => '10'
                );
			 	

                $my_query = new WP_Query ($my_args);
            ?>
            <div class="container row">
                <?php if(have_posts()):while(have_posts()):the_post(); ?>

                    <div class="card col-md-5 mr-3 mb-3">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid')); ?></a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-info">Veja mais</a>
                        </div>
                    </div>

                <?php endwhile;endif;wp_reset_query(); ?> 
            </div>
            <div class="pagination col-md-5 mb-4">
                <?php previous_posts_link('< Mais recentes'); ?> <?php next_posts_link('Mais antigos >'); ?>
            </div>       
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
<?php
/**
 * @package Ribombo
 * @since Ribombo 1.0
 */

get_header();
?>

<div class="container">
<h1>Vídeos Educação Ambiental</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="container">
                    <?php get_template_part( 'nav', 'videos' ); ?>
                </div>
            </div>

            
            <?php 
                $my_args = array(
                    'post_type' => 'post',
                    'category_name' => 'videos-educacao-ambiental'
                );

                $my_query = new WP_Query ($my_args);
            ?>  
            <?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-md-4">
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
            <?php endwhile;endif;wp_reset_query(); ?> 
            <div class="pagination col-md-5 mb-4">
                <?php previous_posts_link('< Mais recentes'); ?> <?php next_posts_link('Mais antigos >'); ?>
            </div>       
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
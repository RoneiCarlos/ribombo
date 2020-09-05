<?php
/**
* Template Name: Textos de Apoio
*/
get_header();
?>

<div class="container">
<h1><?php the_title(); ?></h1>
    <div class="row">
        <div class="col-md-8">
            <?php 
                $my_args = array(
                    'post_type' => 'textos-de-apoio',
                    'posts_per_page' => '-1'
                );
    
                $my_query = new WP_Query ($my_args);
            ?>  
            <?php if($my_query->have_posts()):while($my_query->have_posts()):$my_query->the_post(); ?>
                <div class="jumbotron">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="
                                <?php $mykey_values = get_post_custom_values('_my_url');

                                    foreach ( $mykey_values as $key => $value ) {
                                        echo $value; 
                                    } 
                                ?>
                                "><h5 style="color: #1d4c79;"><?php the_title(); ?></h5></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-11">
                            <a href="
                                <?php $mykey_values = get_post_custom_values('_my_url');

                                    foreach ( $mykey_values as $key => $value ) {
                                        echo $value;
                                    } 
                                ?>
                                "><button class="btn btn-info align-right">Visitar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
    
</div>


<?php get_footer(); ?>
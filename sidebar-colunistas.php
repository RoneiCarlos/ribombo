<div class="jumbotron">
    <h2 class="mb-0">Colunistas</h2>
    <hr class="mt-0">
    <?php 
        $my_args = array(
            'post_type' => 'colunistas',
            'posts_per_page' => '3'
        );

        $my_query = new WP_Query ($my_args);
    ?>  
    <?php if($my_query->have_posts()):while($my_query->have_posts()):$my_query->the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 rounded" style="overflow: hidden; margin: 0px; padding: 0px;">
                    <?php the_post_thumbnail('post_thumbnail', array('class' => 'img-fluid', 'style' => 'filter: grayscale(100%);')); ?>
                </div>
                <div class="col-md-9">
                    <h5 style="color: #1d4c79; padding-top: 10%;"><?php the_title(); ?></h5>
                </div>
                <div class="offset-md-1 col-md-11">
                    <p><?php the_content(); ?></p>
                    <?php $mykey_values = get_post_custom_values('_my_autor');
 
                        foreach ( $mykey_values as $key => $value ) {
                            echo '<p class="align-right"> - '.$value .'</p>'; 
                        } ?>
                    <hr>
                </div>
                
            </div>
        </div>
    <?php endwhile; endif; wp_reset_query(); ?>
    <a href="/colunistas" ><button class="btn btn-info col-md-12">Veja todos</button></a>
</div>
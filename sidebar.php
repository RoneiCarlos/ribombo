<div class="col-md-4">
    <div class="jumbotron">
        <h2 class="mb-0">Redes sociais</h2>
        <hr class="mt-0">
        <a href="https://www.instagram.com/gruporibombo"><img class="bg-insta mx-1 rounded-insta" src="<?php echo get_template_directory_uri().'/img/insta.svg' ?>" width="30" height="30"></a>
        <a href="https://open.spotify.com/show/1Rid6MdpolnllBO9E2A3Si"><img class="bg-spotify mx-1 my-1 rounded-circle" src="<?php echo get_template_directory_uri().'/img/spotify.svg' ?>" width="30" height="30"></a>
        <a href="https://anchor.fm/ribombo"><img class="bg-anchor mx-1 my-1 rounded-anchor" src="<?php echo get_template_directory_uri().'/img/anchor.svg' ?>" width="30" height="30"></a>
        <a href="https://podcasts.google.com/?feed=aHR0cHM6Ly9hbmNob3IuZm0vcy9jZWY0M2ZjL3BvZGNhc3QvcnNz"><img class="mx-1 my-1" src="https://upload.wikimedia.org/wikipedia/commons/1/14/Google_Podcasts_Logo.png" width="30" height="30"></a>
        <a href="https://radiopublic.com/ribombo-6vr0kX"><img class="mx-1 my-1" src="https://radiopublic.com/static/media/red-rp-flag.16198a87.svg" width="30" height="30"></a>
        <a href="https://salapodcast.furg.br/podcast/ribombo"><img class="mx-1 my-1" src="<?php echo get_template_directory_uri().'/img/furg.png' ?>" width="30" height="30"></a>
    </div>

    <?php
        if( !is_page_template( 'page-textosdeapoio.php' )){
            dynamic_sidebar('Sidebar'); 
        }
    ?>

    <?php 
        $my_args = array(
            'post_type' => 'parceiros',
            'posts_per_page' => '-1'
        );

        $my_query = new WP_Query ($my_args);
    ?>
        
    <div class="jumbotron">
        <h2 class="mb-0">Parceiros</h2>
        <hr class="mt-0">
        <div class="container">
            <div class="row">
                <?php if($my_query->have_posts()):while($my_query->have_posts()):$my_query->the_post(); ?>
                    
                    <div style="margin: 5px; padding: 0px; width: 30px; height: 30px;">
                        <a href="<?php echo the_title(); ?>"><?php the_post_thumbnail('post_thumbnail', array('class' => 'img-fluid')); ?></a>
                    </div>
                    
                <?php endwhile; endif; wp_reset_query(); ?>
            </div>
        </div>
    </div>
    <?php 
        if( !is_page_template( 'page-colunistas.php' )){
            get_template_part( 'sidebar', 'colunistas' );
        }
    ?>
</div>
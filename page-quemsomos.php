<?php
/**
* Template Name: Quem Somos
*/
get_header();
?>

<?php
$args = array(
    'display_name',
    'meta_query' => array(
        'first_name',
        'last_name',
        'description'
    ),
    'user_email',
    'ID'
);

// The Query
$user_query = new WP_User_Query( $args );
// User Loop
if ( ! empty( $user_query->get_results() ) ) {
    echo '<div class="container">';
    echo '<h1>',the_title(),'</h1>';
    echo '<div class="row">';
    echo '<div class="col-md-8">';
    
    
	foreach ( $user_query->get_results() as $user ) {
        echo '<div class="jumbotron">';
        echo '<a href="' . get_author_posts_url($user->ID) . '"><h2>' . $user->first_name . ' ' . $user->last_name . '</h2></a>';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo '<a href="' . get_author_posts_url($user->ID) . '">' . get_avatar($user->user_email, '180', '', '', array( 'class' => array( 'img-fluid', 'img-qs-padding' ))) . '</a>';
        echo '<button class="btn btn-outline-info col-md-12 mt-3 mb-3"><a href="' . get_author_posts_url($user->ID) . '">Publicações</a></button>';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<p>' . $user->description . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
    get_sidebar();
    echo '</div>';
    echo '</div>';
    
}


get_footer();
?>
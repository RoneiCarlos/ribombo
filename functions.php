<?php
    //enfileirando os arquivos css
    function enqueue_ribombo_styles(){
        wp_enqueue_script('bs-js', '//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_style('bs-css', '//stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
        wp_enqueue_style('ribombo-css', get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts', 'enqueue_ribombo_styles');

    //funcionalidades do tema
    function suportes(){
        // banner do cabeçalho
        add_theme_support('custom-logo');
        
        //adicionando suporte ao título da aba
        add_theme_support('title-tag');

        //adicionando suporte para thumbnails nos posts
        add_theme_support('post-thumbnails');

    }
    add_action('after_setup_theme', 'suportes');

    //registrando os menus
    function register_menu() {
        register_nav_menus(array(
            'principal' => __('Menu Principal', 'ribombo'),
            'video' =>__('Menu Vídeos', 'ribombo'),
            'publicacao' =>__('Menu Publicações', 'ribombo')
        ));
    }
    add_action('after_setup_theme', 'register_menu');
    
    //registrando o navwalker
    function register_navwalker(){
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    }
    add_action('after_setup_theme', 'register_navwalker');

    //sidebar
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="jumbotron">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));

    //campo de busca no menu
    register_sidebar(array(
        'name' => 'Busca',
        'id' => 'busca',
        'before_widget' => '<div class="blog-search">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

    // Removes from admin menu
    add_action( 'admin_menu', 'my_remove_admin_menus' );
    function my_remove_admin_menus() {
        remove_menu_page( 'edit-comments.php' );
    }
    // Removes from post and pages
    add_action('init', 'remove_comment_support', 100);

    function remove_comment_support() {
        remove_post_type_support( 'post', 'comments' );
        remove_post_type_support( 'page', 'comments' );
    }
    // Removes from admin bar
    function mytheme_admin_bar_render() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
    add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

    //textos de apoio
    function textos_de_apoio_cpt() {
        register_post_type( 'textos-de-apoio',
            array(
                'labels' => array(
                    'name'               => __('Textos de Apoio'),
                    'singular_name'      => __('Texto de Apoio'),
                    'add_new'            => __('Adicionar novo texto de apoio'),
                    'add_new_item'       => __('Adicionar novo texto de apoio'),
                    'edit_item'          => __('Editar texto de apoio'),
                    'new_item'           => __('Novo texto de apoio'),
                    'all_items'          => __('Todos os textos de apoio'),
                    'view_item'          => __('Ver texto de apoio'),
                    'search_items'       => __('Procurar texto de apoio'),
                    'not_found'          => __('Sem textos de apoio encontrados'),
                    'not_found_in_trash' => __('Sem textos de apoio encontrados na lixeira')
                ),
                'supports' => array(
                    'title'
                ),
                'public' => true,
                'has_archive' => true,
                'menu_icon' => 'dashicons-list-view',
                'rewrite' => array('slug' => 'textos-de-apoio')
            )
        );
    }
    add_action('init', 'textos_de_apoio_cpt');

    //METABOX para os links dos textos de apoio
    function my_url_add_metabox() {
    add_meta_box(
            'my_url_section',           // The HTML id attribute for the metabox section
            'Link do arquivo',     // The title of your metabox section
            'my_url_metabox_callback',  // The metabox callback function (below)
            'textos-de-apoio'                  // Your custom post type slug
        );
    }
    add_action( 'add_meta_boxes', 'my_url_add_metabox' );

    /**
     * Print the metabox content.
     */

    function my_url_metabox_callback( $post ) {

    // Create a nonce field.
        wp_nonce_field( 'my_url_metabox', 'my_url_metabox_nonce' );

        // Retrieve a previously saved value, if available.
        $url = get_post_meta( $post->ID, '_my_url', true );

    // Create the metabox field mark-up.
    ?>
    
        <p>
            <label>Link do arquivo para onde o visitante será redirecionado</label>
            <br>
            <input style="width: 100%;" type="text" name="my_url" value="<?php echo esc_url( $url ); ?>" size="30" class="regular-text" />
        </p>
    
    <?php }

    /**
     * Save the metabox.
     */

    function my_url_save_metabox( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['my_url_metabox_nonce'] ) ) {
        return;
    }

    $nonce = $_POST['my_url_metabox_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'my_url_metabox' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check for and sanitize user input.
    if ( ! isset( $_POST['my_url'] ) ) {
        return;
    }

    $url = esc_url_raw( $_POST['my_url'] );

    // Update the meta fields in the database, or clean up after ourselves.
    if ( empty( $url ) ) {
        delete_post_meta( $post_id, '_my_url' );
    } else {
        update_post_meta( $post_id, '_my_url', $url );
    }
    }
    add_action( 'save_post', 'my_url_save_metabox' );
    
    //parceiros
    function parceiros_cpt() {
        register_post_type( 'parceiros',
            array(
                'labels' => array(
                    'name'               => __('Parceiros'),
                    'singular_name'      => __('Parceiro'),
                    'add_new'            => __('Adicionar novo parceiro'),
                    'add_new_item'       => __('Adicionar novo parceiro'),
                    'edit_item'          => __('Editar parceiro'),
                    'new_item'           => __('Novo parceiro'),
                    'all_items'          => __('Todos os parceiros'),
                    'view_item'          => __('Ver parceiro'),
                    'search_items'       => __('Procurar parceiro'),
                    'not_found'          => __('Sem parceiros encontrados'),
                    'not_found_in_trash' => __('Sem parceiros encontrados na lixeira'),
                    'featured_image'     => __('Logo do parceiro'),
                    'set_featured_image' => __('Adicionar logo do parceiro'),
                    'use_featured_image' => __('Usar como logo do parceiro')

                ),
                'supports' => array(
                    'title', 'thumbnail'
                ),
                'public' => true,
                'has_archive' => true,
                'menu_icon' => 'dashicons-buddicons-buddypress-logo',
                'rewrite' => array('slug' => 'parceiros')
            )
        );
    }
    function parceiros_placeholder_titulo( $title ){
        $screen = get_current_screen();
    
        if  ( 'parceiros' == $screen->post_type ) {
            $title = 'Adicionar o link';
        }
    
        return $title;
    }
    add_action('init', 'parceiros_cpt');
    add_filter( 'enter_title_here', 'parceiros_placeholder_titulo' );
    

    //feed de colunistas (CPT)
    function colunistas_cpt() {
        register_post_type( 'colunistas',
            array(
                'labels' => array(
                    'name'               => __('Colunistas'),
                    'singular_name'      => __('Colunista'),
                    'add_new'            => __('Adicionar novo colunista'),
                    'add_new_item'       => __('Adicionar novo colunista'),
                    'edit_item'          => __('Editar colunista'),
                    'new_item'           => __('Novo colunista'),
                    'all_items'          => __('Todos os colunistas'),
                    'view_item'          => __('Ver colunista'),
                    'search_items'       => __('Procurar colunista'),
                    'not_found'          => __('Sem colunistas encontrados'),
                    'not_found_in_trash' => __('Sem colunistas encontrados na lixeira'),
                    'featured_image'     => __('Imagem do colunista'),
                    'set_featured_image' => __('Adicionar imagem do colunista'),
                    'use_featured_image' => __('Usar como imagem do colunista')
                ),
                'supports' => array(
                    'title', 'editor', 'thumbnail'
                ),
                'public' => true,
                'has_achive' => true,
                'menu_icon' => 'dashicons-format-quote',
                'rewrite' => array('slug' => 'colunistas')
            )
        );
    }
    function colunistas_placeholder_titulo( $title ){
        $screen = get_current_screen();
    
        if  ( 'colunistas' == $screen->post_type ) {
            $title = 'Adicionar o título da coluna';
        }
    
        return $title;
    }
    add_action('init', 'colunistas_cpt');
    add_filter( 'enter_title_here', 'colunistas_placeholder_titulo' );

    //METABOX para os links dos textos de apoio
    function my_autor_add_metabox() {
        add_meta_box(
            'my_autor_section',           // The HTML id attribute for the metabox section
            'Nome do colunista',     // The title of your metabox section
            'my_autor_metabox_callback',  // The metabox callback function (below)
            'colunistas',                  // Your custom post type slug
            'side',
            'high'
        );
    }
    add_action( 'add_meta_boxes', 'my_autor_add_metabox' );

    /**
     * Print the metabox content.
     */

    function my_autor_metabox_callback( $post ) {

    // Create a nonce field.
        wp_nonce_field( 'my_autor_metabox', 'my_autor_metabox_nonce' );

        // Retrieve a previously saved value, if available.
        $autor = get_post_meta( $post->ID, '_my_autor', true );

    // Create the metabox field mark-up.
    ?>
    
        <p>
            <label>Nome do autor da coluna</label>
            <br>
            <input style="width: 100%;" type="text" name="my_autor" value="<?php echo esc_attr( $autor ); ?>" size="30" class="regular-text" />
        </p>
    
    <?php }

    /**
     * Save the metabox.
     */

    function my_autor_save_metabox( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['my_autor_metabox_nonce'] ) ) {
        return;
    }

    $nonce = $_POST['my_autor_metabox_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'my_autor_metabox' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check for and sanitize user input.
    if ( ! isset( $_POST['my_autor'] ) ) {
        return;
    }

    $autor = esc_attr( $_POST['my_autor'] );

    // Update the meta fields in the database, or clean up after ourselves.
    if ( empty( $autor ) ) {
        delete_post_meta( $post_id, '_my_autor' );
    } else {
        update_post_meta( $post_id, '_my_autor', $autor );
    }
    }
    add_action( 'save_post', 'my_autor_save_metabox' );
        
    //estilizar a paginação
    function botao_paginacao(){
        return 'class="btn btn-outline-secondary"';
    }
    add_filter('next_posts_link_attributes', 'botao_paginacao');
    add_filter('previous_posts_link_attributes', 'botao_paginacao');

    //texto do footer
    register_sidebar(array(
        'name' => 'Footer',
        'id' => 'footer',
        'before_widget' => '<div class="blog-footer">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

?>
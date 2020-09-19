<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header();
?>

<h1>Não encontramos o que procurava. </h1>

<div class="container">
    <div class="row">
        <div class="col-md-8" >
            <div class="jumbotron">
                <h3>Tente buscar por algo em específico...</h3>
                <div class="jumbotron margin-padding-1" style="background-color:#343a40;"><?php get_search_form(); ?></div>
                <h4>Ou volte para nossa página inicial.</h4>
                <a href="<?php echo get_template_directory_uri().'../../../../' ?>"><button class="offset-md-3 col-md-6 btn btn-info">Início</button></a>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
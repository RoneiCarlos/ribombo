<?php
/**
* Template Name: Contato
*/
get_header();
?>

<div class="container">
<h1><?php the_title(); ?></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron">
                <h4>Envie um e-mail diretamente para: <a href="mailto:contato@ribombo.com.br">contato@ribombo.com.br</a></h4>
                <hr>
                <h5>Ou deixe sua mensagem por meio do formulário de contato</h5>
                <form action="mailto:contato@ribombo.com.br" method="get" enctype="text/plain">
                    <div>
                        <label for="name">
                            <input class="form-control" type="text" name="name" id="name" placeholder="Nome"/>
                        </label>
                    </div>
                    <div>
                        <label for="email">
                            <input class="form-control" type="text" name="email" id="email" placeholder="E-mail"/>
                        </label>
                    </div>
                    <div>
                        <textarea class="form-control" name="comments" rows="4" placeholder="Escreva aqui a sua mensagem."></textarea>
                    </div>
                    <div>
                        <input class="btn btn-outline-info" style="margin-top: 10px; margin-bottom: 15px;" type="submit" name="submit" value="Enviar" />
                        <input class="btn btn-outline-warning" style="margin-top: 10px; margin-bottom: 15px;" type="reset" name="reset" value="Limpar" />
                    </div>
                </form>
            </div>        
        </div>
        
        <?php get_sidebar(); ?>
    </div>
    
</div>

<?php get_footer(); ?>
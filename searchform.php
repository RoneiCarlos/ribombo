<form role="search" method="get" action="<?php echo home_url('/'); ?>">
    <div class="input-group">
        <input type="search" class="form-control" placeholder="Busque por um termo" value="<?php echo get_search_query(); ?>" name="s">
        <div class="input-group-append">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
        </div>
    </div>
</form>
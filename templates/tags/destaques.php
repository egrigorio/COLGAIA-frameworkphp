<section class="md-section" style="background-color:#f7f7f7;padding:0;">
    <div class="container">
        <div class="textbox-group">
            <div class="row">
                <?php 
                $lang = isset($_SESSION['lingua']) ? $_SESSION['lingua'] : 'pt';                                
                $sql = "SELECT * FROM destaques INNER JOIN destaques_linguas ON destaques_linguas.id = destaques.id WHERE destaques.ativo = 1  ORDER BY ordem";
                $res_destaques = db_query($sql);
                foreach($res_destaques as $row) {
                    echo '
                        <div class="col-md-4 col-lg-4 ">                    
                            <!-- textbox -->
                            <div class="textbox">
                                <div class="textbox__image"><a href="' . $row['link'] . '"><img src="assets/img/services/' . $row['img'] .'" alt="' . 'Imagem ' . $row['titulo'] . '"/></a></div>
                                <div class="textbox__body">
                                    <h2 class="textbox__title"><a href="#">' . $row['titulo'] . '</a></h2>
                                    <div class="textbox__description">' . $row['descricao'] . '</div>
                                </div>
                            </div><!-- End / textbox -->
                        </div>                    
                    ';
                }                                
                ?>                
            </div>
        </div>
    </div>
</section>
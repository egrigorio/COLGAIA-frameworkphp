<div class="slider">    
    <!-- carousel__element owl-carousel -->
    <div class="carousel__element owl-carousel" data-options='{"items":1,"loop":true,"dots":false,"nav":false,"margin":0, "autoplay": true, "autoplayTimeout": 3000}'>
        <?php 
        $lang = isset($_SESSION['lingua']) ? $_SESSION['lingua'] : 'pt';
        $sql = "SELECT * FROM slider INNER JOIN slider_linguas ON slider_linguas.id = slider.id WHERE slider.ativo = 1 AND slider_linguas.lingua = '$lang' ORDER BY ordem";
        $res_slider = db_query($sql);
        foreach($res_slider as $row) {            
            echo '
                <div class="slider__item" style="background-image: url(\'assets/img/' . $row['img'] . '\');">
                    <div class="md-tb">
                        <div class="md-tb__cell">
                            <div class="slider__content">
                                <div class="container">
                                    <h2>'.$row['titulo'].'</h2>
                                    <p>'.$row['descricao'].'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        ?>        
    </div><!-- End / carousel__element owl-carousel -->    
</div>
<header class="header header__style-02">
    <div class="container">
        <div class="header__logo"><a href="index.html"><img src="assets/img/logo.png" alt=""/></a></div>
        <div class="header__toogleGroup">
            <div class="header__chooseLanguage">
                            
                            <!-- dropdown -->
                            <div class="dropdown" data-init="dropdown"><a class="dropdown__toggle" href="javascript:void(0)">PT <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="dropdown__content" data-position="right">
                                    <ul class="list-style-none">
                                        <?php 
                                            $sql = "SELECT * FROM langs WHERE ativo = 1";
                                            $res_langs = db_query($sql);
                                            foreach($res_langs as $row) {
                                                echo '<li><a href="?lang='.$row['sigla'].'">'.$row['sigla'].'</a></li>';
                                            }
                                        ?>                                        
                                    </ul>
                                </div>
                            </div><!-- End / dropdown -->
                            
            </div>
            <div class="search-form">
                <div class="search-form__toggle"><i class="ti-search"></i></div>
                <div class="search-form__form">
                                        
                    <!-- form-search -->
                    <div class="form-search">
                        <form>
                            <input class="form-control" type="text" placeholder="Hit enter to search or ESC to close"/>
                        </form>
                    </div><!-- End / form-search -->
                                    
                </div>
            </div>
        </div>
        
        <!-- consult-nav -->
        <nav class="consult-nav">
            
            <!-- consult-menu -->
            <ul class="consult-menu">
                <?php 
                    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'pt';                                              
                    $lang = strtoupper($lang);                    
                    foreach($res_langs as $row) {
                        if($row['sigla'] == $lang) {
                            $_SESSION['lingua'] = $lang;
                        }                                                                                                                       
                    }                                                   
                    $sql = "SELECT * FROM menu INNER JOIN menu_linguas ON menu_linguas.id = menu.id AND lingua = '$lang' WHERE menu.ativo = 1 ORDER BY ordem";
                    $res_menu = db_query($sql);                    
                    foreach($res_menu as $row) {
                        echo '<li><a href="'.$row['link'].'">'.$row['nome'].'</a></li>';
                    }
                ?>                
            </ul><!-- consult-menu -->
            
            <div class="navbar-toggle"><span></span><span></span><span></span></div>
        </nav><!-- End / consult-nav -->
        
    </div>
</header>
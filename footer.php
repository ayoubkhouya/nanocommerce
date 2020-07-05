<div class="footer-top-area">
    <div class="field-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2><span>Nano</span>Commerce</h2>
                    <p>Ce site est développé par <a href="#" target="_blank">Ayoub KHOUYA</a></p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Navigation </h2>
                    <ul >
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="index.php?cats=true">Catégories</a></li>
                        <li><a href="index.php?cart=true">Panier</a></li>
                        <li><a href="index.php?contact=true">Contact</a></li>
                        <?php 
                            if(! isset($_SESSION['nanouser'])) echo "<li><a href='index.php?login=true'>Connexion</a></li>";
                            else echo "<li><a href='logout.php'>Déconnexion</a></li>";
                        ?>
                    </ul>                        
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Catégories</h2>
                    <ul>
                    <?php 
	                    $sql = "SELECT * FROM categories";
	                    $res = $conn->query($sql);
	                    while($row = $res->fetch_assoc()){
	                    	echo "<li><a href='index.php?cat={$row['id_cat']}'>{$row['nom_cat']}</a></li>";
	                    }
                    ?>
                    </ul>     
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>S'enregistrez-vous dans notre newsletter pour recevoir les nouveautté</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Entrer votre email">
                            <input type="submit" value="S'enregistrer">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>© 2017, All rights reserved to <a href="#" target="_blank">Ayoub KHOUYA</a></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-discover"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="viewer">No Data Recieved</div>
<script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".linker").mouseenter(function(){
            var pos = $(this).position();
            var width = $(this).outerWidth();
            var url = $(this).attr('href');
            var arr = url.split('?');
            url = "preview.php?"+arr[1];
            $("#viewer").css({
                position: "absolute",
                top: pos.top + "px",
                left: (pos.left + width - 20) + "px"
            }).slideToggle('medium');
            $('#viewer').load(url+' .preview');
        })
        $(".linker").mouseleave(function(){
            $('#viewer').hide();
        })
        $(".viewer").mouseenter(function(){
            $('#viewer').show();
        })
        $(".viewer").mouseleave(function(){
            $('#viewer').hide();
        })
    })
</script>
</body>
</html>
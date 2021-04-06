<?php
    include_once 'public/header.php';
    //nos aseguramos que la sesión aun esté activa
    //también se carga al volver a la página de inicio de sesión
    if (!isset($_SESSION['idUserSession'])) {
        include_once 'public/logInAgain.php';
    }else{
        if($_SESSION['idUserSession'] == -1){
            include_once 'public/logInAgain.php';
        }else{
?>  

<style>
a{text-decoration:none}
h4{text-align:center;margin:30px 0;color:#444}
.main-timeline2{padding-top:50px;overflow:hidden;position:relative}
.main-timeline2:before{content:"";width:7px;height:100%;background:#084772;margin:0 auto;position:absolute;top:80px;left:0;right:0}
.main-timeline2 .timeline{width:50%;float:left;padding:20px 60px;border-top:7px solid #084772;border-right:7px solid #084772;border-radius:0 30px 0 0;position:relative;right:-3.5px}
.main-timeline2 .icon{display:block;width:50px;height:50px;line-height:50px;border-radius:50%;background:#e84c47;border:1px solid #fff;text-align:center;font-size:25px;color:#fff;box-shadow:0 0 0 2px #e84c47;position:absolute;top:-30px;left:0}
.main-timeline2 .timeline-content{display:block;padding:30px 10px 10px;border-radius:20px;background:#e84c47;color:#fff;position:relative}
.main-timeline2 .timeline-content:hover{text-decoration:none;color:#fff}
.main-timeline2 .timeline-content:after,.main-timeline2 .timeline-content:before{content:"";display:block;width:10px;height:50px;border-radius:10px;background:#e84c47;border:1px solid #fff;position:absolute;top:-35px;left:50px}
.main-timeline2 .timeline-content:after{left:auto;right:50px}
.main-timeline2 .title{font-size:24px;margin:0}
.main-timeline2 .description{font-size:15px;letter-spacing:1px;margin:0 0 5px}
.main-timeline2 .timeline:nth-child(2n){border-right:none;border-left:7px solid #084772;border-radius:30px 0 0;right:auto;left:-3.5px}
.main-timeline2 .timeline:nth-child(2n) .icon{left:auto;right:0;box-shadow:0 0 0 2px #4bd9bf}
.main-timeline2 .timeline:nth-child(2){margin-top:130px}
.main-timeline2 .timeline:nth-child(odd){margin:-130px 0 30px}
.main-timeline2 .timeline:nth-child(even){margin-bottom:80px}
.main-timeline2 .timeline:first-child,.main-timeline2 .timeline:last-child:nth-child(even){margin:0 0 30px}
.main-timeline2 .timeline:nth-child(2n) .icon,.main-timeline2 .timeline:nth-child(2n) .timeline-content,.main-timeline2 .timeline:nth-child(2n) .timeline-content:after,.main-timeline2 .timeline:nth-child(2n) .timeline-content:before{background:#4bd9bf}
.main-timeline2 .timeline:nth-child(3n) .icon,.main-timeline2 .timeline:nth-child(3n) .timeline-content,.main-timeline2 .timeline:nth-child(3n) .timeline-content:after,.main-timeline2 .timeline:nth-child(3n) .timeline-content:before{background:#ff9e09}
.main-timeline2 .timeline:nth-child(3n) .icon{box-shadow:0 0 0 2px #ff9e09}
.main-timeline2 .timeline:nth-child(4n) .icon,.main-timeline2 .timeline:nth-child(4n) .timeline-content,.main-timeline2 .timeline:nth-child(4n) .timeline-content:after,.main-timeline2 .timeline:nth-child(4n) .timeline-content:before{background:#3ebae7}
.main-timeline2 .timeline:nth-child(4n) .icon{box-shadow:0 0 0 2px #3ebae7}
@media only screen and (max-width:767px){.main-timeline2:before{left:0;right:auto}
.main-timeline2 .timeline,.main-timeline2 .timeline:nth-child(even),.main-timeline2 .timeline:nth-child(odd){width:100%;float:none;padding:20px 30px;margin:0 0 30px;border-right:none;border-left:7px solid #084772;border-radius:30px 0 0;right:auto;left:0}
.main-timeline2 .icon{left:auto;right:0}
}
@media only screen and (max-width:480px){.main-timeline2 .title{font-size:18px}
}
</style>

<!---->
<div class="container">
    <legend class="text-center">Proyecto</legend>
    <legend class="text-center"> <?php echo $_SESSION['numProySession'] ?> </legend>
    <div class="row">
        <div class="col-md-12">
            <div class="main-timeline2">
                <?php
                    $temp = 1;
                    foreach ($vars['listaAvances'] as $item) {
                ?>
                        <div class="timeline">
                            <span class="icon"> <?php echo $temp ?> </span>
                            <div href="#" class="timeline-content">
                                <h3 class="title"><?php echo date_format(date_create($item[3]), "d-m-Y") ?></h3>
                                <div class="description">
                                    <span>Nombre: <?php echo $item[4] ?></span>
                                    <hr>
                                    <span>Avance: <?php echo $item[10] ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                        $temp++;
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!---->

<?php
        }
    }
?>

<?php
    include_once 'public/footer.php';
?>
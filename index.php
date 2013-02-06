<?
$minefold_id = 52147;

$f = file_get_contents('https://minefold.com/servers/'.$minefold_id.'.json');
$si = json_decode($f);
$start = strtotime($si->createdAt);



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $si->name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2><a href="https://minefold.com/servers/<?php echo $minefold_id;?>/"><?php echo $si->name; ?></a></h2>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <dl class="dl-horizontal">
                    <dt>Address:</dt>
                    <dd><?php echo $si->address; ?></dd>
                    <dt>Server Status:</dt>
                    <dd><?php echo $si->state; ?></dd>
                    <dt>Age:</dt>
                    <dd><?php echo date('d',mktime()- $start); ?> days</dd>
                </dl>
            </div>
        </div>
         <div class="row">
            <div class="span12">       

                <div class="well">
                <?
                
                if (count($si->players)>0){
                    
                ?>
                <h3>Currently Playing:</h3>
                
                <ul class="thumbnails">
                <?
                foreach ($si->players as $p){
                ?>
                    <li class="span2">

                    <img src="https://minotar.net/helm/<?php echo $p;?>/100.png" alt="">
                            <h3><?php echo $p;?></h3>
                        </li>
                <?}
                ?>
                </ul>
                <?
                }else{
                    echo "Nobody is currently playing";
                }
                ?>

                </div>
            </div>
         </div>
         <div class="row">
            <div class="span12">
                <iframe src="https://minefold.com/servers/52147/map/embed" width="100%" height="400"></iframe>
            </div>
         </div>
        <div class="row">
            <div class="span12">

                <small>Please be nice. If you have questions, want to play with us, etc - email <a href="mailto:harper@nata2.org">harper@nata2.org</a></small>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>

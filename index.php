<!DOCTYPE html>
<!-- style="background-color: #29487d;" bleu-->
<!-- style="background-color: #e9ebee -->
<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
    </head>

    <body  style="background-color: #e9ebee;">
      <div class="col border " style="background-color: #29487d;" >
        <form class="col" action=""><input type="submit" id="Deconnect" value="Deconnexion" class="btn-danger " style="float: right;" /></form>
        <br><br><br>
        <div class="h4 col-1 text-white" style="left: 20%; font-family: 'Consolas' " >
          PoulpBook
        </div>
      </div>
      <br>

        <div class="container" >



            <div class="row" >

              <br>
              <br>
                <div class="col-3">
                    <img src="images/CFPT_logo.png"  alt="CFPT_logo" class="img-fluid" />
                    <br><br><br><br><br>
                    <div class="h4 text-muted">
                      Troller Fabian
                      <br>
                      Computer Scientist
                      <br>
                      CFPT Informatique
                      <br>
                      Rue des Poulpes 456
                      <br>
                      1212 Terre
                    </div>
                </div>

                <div class="col-9 " >
                <img src="images/Code_image.jpg"  alt="Code_image" class=" img-fluid w-75  " />
                </div>


            </div>


        <br>
        <br>
        <br>
        <!--Formulaire-->
        <div class="rows center-block text-center border border-dark bg-white" >
        <form method="post" action="PhpServer.php" enctype="multipart/form-data" id="formulaire" class="text-center img-fluid col-12 border">
          <br>
            <textarea rows="5" cols="100" form="formulaire" name="textPost" class="img-fluid form-control"></textarea>
            <br>
            <br>
              <input type="file" accept="image/*" multiple name="filePictures[]"/>
              <br>
              <br>
              <input type="submit" name="btnEnvoyer" value="Choisir un fichier" class="btn btn-outline-secondary" />
        </form>


      </div>
    </div>

    <div class="container">
      <?php for ($i=0; $i < count($_SESSION["image"]); $i++) { ?>
        <div class="rows center-block text-center border border-dark bg-white mt-5">
          <input type="submit" class="btn" style="background:url('.\\images\\Trash.png');width: 50px;height:50px;margin-left: 95%;" value=""/>
          <?php print("<p>\"{$_SESSION["message"][$i]}\"</p>"); ?>
       <?php print("<img src=\"{$_SESSION["image"][$i]}\" alt=\"error\" class=\"col-4 img-fluid\" >"); ?>
        </div>
     <?php } ?>
   </div>


    </body>

</html>

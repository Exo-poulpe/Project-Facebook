<!DOCTYPE html>
<!-- style="background-color: #29487d;" bleu-->
<!-- style="background-color: #e9ebee -->

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
    </head>

    <body  style="background-color: #e9ebee;">
      <div class="col border " style="background-color: #29487d;" >
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
                    <img src="images/CFPT_logo.png"  alt="CFPT_logo" class="img-fluid " />
                    <br><br><br><br><br>
                    <div class="h4 text-muted ">
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

                <div class="col-9" >
                <img src="images/Code_image.jpg"  alt="Code_image" class=" img-fluid" />
                </div>


            </div>


        <br>
        <br>
        <br>
        <div class="rows center-block text-center" style="background-color: #e9ebee; border-style: solid; border-color: grey">
        <form method="post" action="PhpServer.php" enctype="multipart/form-data" id="formulaire" class="text-center img-fluid col-12 border">
          <br>
            <textarea rows="5" cols="50" form="formulaire" name="textPost" class="img-fluid"></textarea>
            <br>
            <br>
              <input type="file" accept="image/*" multiple name="filePictures[]"/>
              <br>
              <br>
              <input type="submit" name="btnEnvoyer" value="Choisir un fichier" class="btn btn-outline-secondary" />
        </form>
      </div>
      </div>


    </body>

</html>

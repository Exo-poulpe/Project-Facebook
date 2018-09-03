<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="BootStrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="CssPhp.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div class="container">

            <div class="row">
                <div class="col-3">
                    <img src="images/CFPT_logo.png"  alt="CFPT_logo" class="border "/>
                </div>
                <div class="col-9">
                <img src="images/Code_image.jpg"  alt="Code_image" class=" img-fluid " />
                </div>
            </div>

        </div>

        <form method="post" action="PhpServer.php" enctype="multipart/form-data" id="formulaire">

            <textarea rows="5" cols="50" form="formulaire" name="textPost"></textarea>
            <br>
            <br>
              <input type="file" name="filePictures" accept="image/*"/>
              <br>
              <br>
              <input type="submit" name="btnEnvoyer" value="Choisir un fichier" class="btn btn-outline-secondary" />
        </form>


    </body>

</html>

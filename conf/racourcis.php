
<?php
    require('NavBar.php');

    $user = $_SESSION['username'];

    $sql = $bdd->query("SELECT * FROM users WHERE username = '$user'");
    $donnees = $sql->fetch();
    $userid = $donnees['id'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Web</title>

    <link rel="icon" href="images/jr.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <?php
            $sql2 = $bdd->query("SELECT * FROM dashboard WHERE iduser = '$userid'");
            $donnees2 = $sql2->fetch();  

                if(!empty($donnees2)){
                    ?>
                        <div class="positionbtn">
                            <span class="vertical-line"></span>

                                <div class="dropdown">
                                    <button class="btn btnview" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/drag-list-down.png"/>
                                </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a href="config/listview.php?id=<?= $userid;?>" class="dropdown-item">Vue liste</a>
                                        <a href="config/gridview.php?id=<?= $userid;?>" class="dropdown-item">Vue grille</a>
                                    </div>
                                </div>
                        </div>
                    <?php
                

                    if($donnees['view'] == "gridview"){
                        ?>
                            <table class="center">
                                <tr>
                                    <?php
                                        $sql3 = $bdd->query("SELECT * FROM dashboard WHERE iduser = '$userid'");
                                        foreach($sql3 as $row){
                                    ?>
                                        <td>
                                            <div class="container">
                                                <div class="polaroid">
                                                    <a href="<?= $row['urlredirect']; ?>" target="_blank"><img src="<?= $row['urlimg']; ?>" alt="Avatar" class="image"></a>
                                                </div>
                                            </div>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        <?php
                    }elseif($donnees['view'] == "listview"){
                        ?>
                            <style>
                                th, td {
                                    padding: 1em;
                                    background: #e6e6e6;
                                }
                            </style>
                            <div class="container2">     
                                <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">URL Titre</th>
                                        <th scope="col">Icone</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                    <?php
                                        $sql3 = $bdd->query("SELECT * FROM dashboard WHERE iduser = '$userid'");
                                        foreach($sql3 as $row){
                                            $id = $row['id'];
                                            ?>
                                        <style>
                                            .table th, .table td { 
                                                border-top: none !important;
                                                border-left: none !important;
                                            }
                                        </style>
                                                <tbody>
                                                    <tr>
                                                        <th style="vertical-align: middle;" scope="row"><?= $id?></th>
                                                            <td><a href="<?= $row['urlredirect']; ?>" style="color:black; text-decoration: none;" target="_blank"><?= $row['urlname']; ?></a></td>
                                                            <td style="padding: 0%; padding-left: 8px;"><a href="<?= $row['urlredirect']; ?>" style="color:black; text-decoration: none;" target="_blank"><img src="<?= $row['urlimg']; ?>" alt="Avatar" style="width: 5%; padding: 0%;"></a></td>

                                                        <td>
                                                            <div class="positionbtn">
                                                                <div class="dropdown">
                                                                    <button class="btn btnview" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAoklEQVRIie2UsQ2DQAxF30fXJCMkGYNjiezBTGGS7HBCLBGkbEDF4VQgqlDcKSngVbZsPRe2DAcbaA7atr0DDXBNdPZmVnvvnwDFqvDIIAe4SWrmpPjWmYNlgJnVQJ/B+ZJUZ/DsheVMu667TNNUmdkpReicG2KMoSzLN6yWLMmnygHGcTybWTXnvzvTGGNwzg0ZnIOkkMGzF45vusnxTf/PBxCnPweldgyGAAAAAElFTkSuQmCC">
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                                        <a href="config/editurl.php?id=<?= $id;?>" class='dropdown-item'>Modifier</a>
                                                                        <!-- <a href='#Addurl' data-toggle='modal' class='dropdown-item'>Ajouté</a> -->
                                                                        <a href='#deleteurl' data-toggle='modal' data-id="<?= $id;?>" class='dropdown-item open-deleteurl'>Supprimer</a>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                        }
                                    ?>
                                </table>
                            </div>

                            </div></div></div>
                        <?php
                    }
                }else{
                    ?>
                        <h2 style="margin-top:-50px;"><center>Aucun raccourci</center></h2>
                    <?php
                }
            ?>

            
        <!-- Modal delete -->
        <form class="box" action="config/deleteurl.php" method="post" name="deleteurl">     
            <div style="margin-top:100px;" class="modal fade" id="deleteurl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <script> 
                        $(document).on("click", ".open-deleteurl", function () {
                            var myBookId = $(this).data('id');
                            $(".modal-body #bookId").val( myBookId );
                            });
                    </script>

                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADyElEQVRoge2Zy08bZxTFz7ljYxMIKWnCQ1EJRAEllELBC2ThRlZbqaVA1I27q9RV/g7+i7ZS1eybXaUuImUR9bFrFiy6yoJGiIeNYJOWYuOZ00WaFjQzeF5pNv5JXvj77nfPPZ7H9zDQpUuXLq8TvoqkAthYqUyA3jAAHMvqYz/8vElAWWtlbuC7Ws2589deFdTQmQ6x8WPvyOPPHjxws9SzLJMBQOV4b85XPABQQ5Xjvbms9TI1cLC8OGDiZFi/PEwd1kqXstTM1EDLyS+AXmhOx8Rms7iQpWZmBrZWy9dIjHaKoziytVq+lpVuJga0DsvTmY8u6ixofT0T7UySHDwpTwG4GDXeIfp3nzycykI7tYHNarV4otxM3HFUbkbVajGtfmoDxX53llQ+7jhS+b1+dzatfioDz1YqgxRuJB1P4cbWR+XLaWpIZaBALsAUOJtLWJLw9T+fpWB10QpWSlNDYgOHa5WxwBkXgAxFEvfw4sG+SOKegYWgWEe8srNWGUtaRyIDqtWclqd3wwNwWcK/z4WEvEu9GVqE682rVnOS1JLIQP1o+zaMfaEBMv9tFdT2Escu1I+2byepJbaBrVq5V7BEYuchcXpnrXQh7rjYBuwoP09DLu64TtCh46g/9mo1loGdteoVmHc9rkhU2nTHd5ffuxpnTGQDAuigtZDoSYuIA0BUSTE2WpENNFYqE4KFvkmywhwMNlYqE5HjowT9WirlYUw97UfFJeZUKkVankQy8NZo77Sg3sgV0PNv3oPawooiio3R3ulIsZ0CGtVqv6BbUcUBwBEPALT+a2ET8g7i5BDs1v7dpY5L9I4G2n0n8yBjva08qEngSwKHBA4FfUVYM04O0LMTF+Gz/cuw8zrrdz8YlprvxxLOmOMWH48//Gk3rD/0lxVAT8eZbsCTUMh78+e9VkMNbH9SmST4Rip1A2HpDs9IXtpfvXMzXCKA32pv9xgVe5t4Ggkfy8V9ufwWwodpcrWp2afLNwOX44EGBo8G3zELXr9HwtMwhM8B9AAqCPrCDLGWCGeLVE+fjQT+oD4DB8uLA0YLvWTRFO06ePrWoXltjadKCU5uflr13dI+A20rzJx3uhYFB94znD6JFmQ5/p4mJ0zsOfF8k5uvUNfU8XStEy5YJ3Af4B8AnpP8xvOwnzZvDhgJaDsLdfbiJ4Z4ROjRiy8Z/S0QcIDguwKSV89GLXsI+WrzGfjTa29IPPl/SooOwRapDX97AE+XFwf6LDfnmA0J6nn15YVDsEWoTmrj6ve/PH+dtXTp0qWLn78B9KoYYdTKaTQAAAAASUVORK5CYII=">                        
                        Voulez-vous supprimer le lien ?
                        <input type="hidden" name="bookId" id="bookId">
                        
                </div>
                <div class="modal-footer">
                    <input type="submit" name="deleteurl" value="Supprimer" class="btn btn-danger"/>
                </div>
                </div>
            </div>
            </div>
        </form>

        <!-- Modal add url-->
        <form class="box" action="" method="post" name="favoris">
            <div class="modal fade" id="Addurl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>

                    <h3 class="modal-title" id="exampleModalLabel"><img src="https://img.icons8.com/plumpy/48/000000/add-image.png"/></h3>
                </div>

                <div class="modal-body">
                    <div class="modal-dialog modal-login modaladduser">

                        <label for="color">URL Image</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlimg" type="text" class="form-control" placeholder="URL Image" >
                            </div>

                        <label for="color">URL Redirection</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlredirect" type="text" class="form-control" placeholder="URL Redirection" >
                            </div>
                        
                        <label for="color">Titre</label>
                            <div class="form-group">
                                <i class="fa fa-user"></i>
                                <input name="urlname" type="text" class="form-control" placeholder="Titre" >
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                    <input type="submit" name="favori" value="Ajouter" class="btn btncolor"/>
                </div>
                </div>
            </div>
            </div>
        </form>

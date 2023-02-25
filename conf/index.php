<?php
    require('NavBar.php');
    //require('../verif_session.php');
    //require('bdd.php');

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
      
    <!-- ---------------------------- jQuery Modal console---------------------------- 
        <script>
            !function(o){
                "object"==typeof module&&"object"==typeof module.exports?o(require("jquery"),window,document):o(jQuery,window,document)
            }
            (function(o,t,i,e){var s=[],l=function(){return s.length?s[s.length-1]:null},n=function(){
                var o,t=!1;for(o=s.length-1;o>=0;o--)s[o].$blocker&&(s[o].$blocker.toggleClass("current",!t).toggleClass("behind",t),t=!0)
            };
            o.modal=function(t,i){
                var e,n;
            if(this.$body=o("body"),this.options=o.extend({},o.modal.defaults,i),this.options.doFade=!isNaN(parseInt(this.options.fadeDuration,10)),this.$blocker=null,this.options.closeExisting)for(;o.modal.isActive();)o.modal.close();
                if(s.push(this),t.is("a"))if(n=t.attr("href"),this.anchor=t,/^#/.test(n)){if(this.$elm=o(n),1!==this.$elm.length)return null;
                this.$body.append(this.$elm),this.open()
            }else this.$elm=o("<div>"),this.$body.append(this.$elm),e=function(o,t){
                t.elm.remove()},this.showSpinner(),t.trigger(o.modal.AJAX_SEND),o.get(n).done(function(i){if(o.modal.isActive()){t.trigger(o.modal.AJAX_SUCCESS);
            var s=l();s.$elm.empty().append(i).on(o.modal.CLOSE,e),s.hideSpinner(),s.open(),t.trigger(o.modal.AJAX_COMPLETE)
            }}).fail(function(){
                t.trigger(o.modal.AJAX_FAIL);var i=l();i.hideSpinner(),s.pop(),t.trigger(o.modal.AJAX_COMPLETE)
                });else 
                this.$elm=t,this.anchor=t,this.$body.append(this.$elm),this.open()},o.modal.prototype={
                    constructor:o.modal,open:function(){var t=this;this.block(),this.anchor.blur(),this.options.doFade?setTimeout(function(){t.show()
            },
            this.options.fadeDuration*this.options.fadeDelay):this.show(),o(i).off("keydown.modal").on("keydown.modal",function(o){
                var t=l();27===o.which&&t.options.escapeClose&&t.close()
            }),
            this.options.clickClose&&this.$blocker.click(function(t){
                t.target===this&&o.modal.close()})
            },close:function(){s.pop(),this.unblock(),this.hide(),o.modal.isActive()||o(i).off("keydown.modal")
            },block:function(){
                this.$elm.trigger(o.modal.BEFORE_BLOCK,[this._ctx()]),this.$body.css("overflow","hidden"),
                this.$blocker=o('<div class="'+this.options.blockerClass+' blocker current"></div>').appendTo(this.$body),n(),
                this.options.doFade&&this.$blocker.css("opacity",0).animate({opacity:1},this.options.fadeDuration),this.$elm.trigger(o.modal.BLOCK,[this._ctx()])
            },unblock:function(t){
                !t&&this.options.doFade?this.$blocker.fadeOut(this.options.fadeDuration,this.unblock.bind(this,!0)):(this.$blocker.children().appendTo(this.$body),
                this.$blocker.remove(),this.$blocker=null,n(),o.modal.isActive()||this.$body.css("overflow",""))
            },show:function(){this.$elm.trigger(o.modal.BEFORE_OPEN,[this._ctx()]),this.options.showClose&&(this.closeButton=o('<a href="#close-modal" rel="modal:close" class="close-modal '+this.options.closeClass+'">'+"</a>"),
            this.$elm.append(this.closeButton)),this.$elm.addClass(this.options.modalClass).appendTo(this.$blocker),
            this.options.doFade?this.$elm.css({opacity:0,display:"inline-block"}).animate({opacity:1},
            this.options.fadeDuration):this.$elm.css("display","inline-block"),this.$elm.trigger(o.modal.OPEN,[this._ctx()])},hide:function(){this.$elm.trigger(o.modal.BEFORE_CLOSE,[this._ctx()]),
            this.closeButton&&this.closeButton.remove();var t=this;this.options.doFade?this.$elm.fadeOut(this.options.fadeDuration,
            function(){t.$elm.trigger(o.modal.AFTER_CLOSE,[t._ctx()])}):this.$elm.hide(0,function(){
                t.$elm.trigger(o.modal.AFTER_CLOSE,[t._ctx()])}),this.$elm.trigger(o.modal.CLOSE,[this._ctx()])
            },showSpinner:function(){this.options.showSpinner&&(this.spinner=this.spinner||o('<div class="'+this.options.modalClass+'-spinner"></div>').append(this.options.spinnerHtml),
            this.$body.append(this.spinner),this.spinner.show())},hideSpinner:function(){this.spinner&&this.spinner.remove()},_ctx:function(){
                return{elm:this.$elm,$elm:this.$elm,$blocker:this.$blocker,options:this.options}}},o.modal.close=function(t){if(o.modal.isActive()){t&&t.preventDefault();var i=l();
                return i.close(),i.$elm}},o.modal.isActive=function(){
                    return s.length>0},o.modal.getCurrent=l,o.modal.defaults={
                        closeExisting:!0,escapeClose:!0,clickClose:!0,closeClass:"",modalClass:"modal",blockerClass:"jquery-modal",
                        spinnerHtml:'<div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div>',
                        showSpinner:!0,showClose:!0,fadeDuration:null,fadeDelay:1},o.modal.BEFORE_BLOCK="modal:before-block",o.modal.BLOCK="modal:block",
                        o.modal.BEFORE_OPEN="modal:before-open",o.modal.OPEN="modal:open",o.modal.BEFORE_CLOSE="modal:before-close",o.modal.CLOSE="modal:close",
                        o.modal.AFTER_CLOSE="modal:after-close",o.modal.AJAX_SEND="modal:ajax:send",o.modal.AJAX_SUCCESS="modal:ajax:success",o.modal.AJAX_FAIL="modal:ajax:fail",
                        o.modal.AJAX_COMPLETE="modal:ajax:complete",o.fn.modal=function(t){return 1===this.length&&new o.modal(this,t),this},o(i).on("click.modal",'a[rel~="modal:close"]',
                        o.modal.close),o(i).on("click.modal",'a[rel~="modal:open"]',function(t){t.preventDefault(),o(this).modal()
                    })
                });
        </script>
    ---------------------------- jQuery Modal ---------------------------- -->

</head>
    <body>
        

	<!-- Modal Console 
        <div class="modal right" id="console">
            <div class="modal-dialog" role="dialog">
                <div class="modal-content contentconsole">

                    <div class="modal-header headerconsole">
                        <a href="http://plex.zerobug-57.fr:4200" target="_blank"><img src="https://img.icons8.com/plumpy/32/000000/toggle-full-screen.png"/></a>
                        <a href="#" rel="modal:close" class="close"><span aria-hidden="true">&times;</span></a>
                    </div>

                    <div class="modal-body">
                        <iframe src="http://plex.zerobug-57.fr:4200" width = "100%" height = "100%"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <label class="label_index">Nom d'utilisateur</label>
        <span class="vertical-line"></span>-->
    <!-- Modal Console -->

            <table class="center" style="margin-top: 70px;">
                <tr>
                    <?php
                    if($donnees['admin'] != 3){?>  
                        <td>
                            <div class="container">
                                <div class="polaroid">
                                    <a href="https://adguard.jr.zerobug-57.fr" target="_blank"><img src="images/adguard.png" alt="Avatar" class="image"></a>
                                </div>
                            </div>
                        </td>
                    <?php
                    }
                    if($_SESSION['SEC_EMBY_ACCESS'] == 'true'){
                    ?>  
                        <td>
                            <div class="container">
                                <div class="polaroid">
                                    <a href="http://jr.zerobug-57.fr:8096/web/index.html" target="_blank"><img src="images/embyname.png" alt="Avatar" class="image"></a>
                                </div>
                            </div>
                        </td>
                    <?php
                    }
                    if($_SESSION['SEC_CLOUD_ACCESS'] == 'true'){
                    ?>  
                        <td>
                            <div class="container">
                                <div class="polaroid">
                                    <a href="http://jr.zerobug-57.fr/owncloud" target="_blank"><img src="images/owncloud.png" alt="Avatar" class="image"></a>
                                </div>
                            </div>
                        </td>
                    <?php
                    }
                    if($_SESSION['SEC_FORTIGATE_ACCESS'] == 'true'){
                    ?>  
                        <td>
                            <div class="container">
                                <div class="polaroid">
                                    <a href="https://jr.zerobug-57.fr:43443" target="_blank"><img src="images/fortinet.png" alt="Avatar" class="image"></a>
                                </div>
                            </div>
                        </td>
                    <?php
                    }
                    if($_SESSION['SEC_VPN_ACCESS'] == 'true'){
                    ?>  
                        <td>
                            <div class="container">
                                <div class="polaroid">
                                    <a href="https://jr.zerobug-57.fr:4443" target="_blank"><img src="images/vpn.png" alt="Avatar" class="image"></a>
                                </div>
                            </div>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            </table>   

        <footer class="footer card-footer text-muted">
            <span class="gauche">Copyright by Joris</span>
            <span class="droite">V2.0.1</span>
        </footer>

    </body>
</html>

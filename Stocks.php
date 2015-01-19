<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Text boxes with jQuery and PHP | Jesin&#39;s Blog</title>
    <link rel="author" href="https://plus.google.com/+JesinA/posts"/>
    <meta charset="UTF-8" />
    <!-- Loading jQuery framework -->
    <script src="//code.jquery.com/jquery-latest.js" type="text/javascript"></script>
     
    <!-- The following styles are scripts are for styling this page and are not required to make this script function -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <style type="text/css">
    
    </style>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript"></script>
    <script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js"></script>
    <script type="text/javascript" src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushXml.js"></script>
    <script type="text/javascript" src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushPhp.js"></script>
    <link href="http://alexgorbatchev.com/pub/sh/current/styles/shCore.css" rel="stylesheet" type="text/css" />
    <link href="http://alexgorbatchev.com/pub/sh/current/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
    <!-- END Additional Styles/Scripts -->
</head>
<body>
    <div id="wrap">
        <div class="container">
        <div class="page-header"><h1 style="text-align: center">Dynamic Text boxes with jQuery and PHP</h1></div>
        <p class="lead"><a href="/dynamic-textbox-jquery-php/">&laquo; Back to Article</a></p>
        <?php
            if( isset( $_POST['boxes'] ) && !empty( $_POST['boxes'] ) ) :
                $data = serialize( $_POST['boxes'] );
            else:
                $data='a:2:{i:0;s:15:"http://jesin.tk";i:1;s:10:"Second Box";}';
            endif;
        ?>
            <form class="form-horizontal" role="form" method="post">
            <?php
            if( !empty( $data ) )
            {
                foreach( unserialize($data) as $key => $value ) :
            ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txtbox<?php echo $key + 1; ?>">Box <span class="label-numbers"><?php echo $key + 1; ?></span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="boxes[]" id="txtbox<?php echo $key + 1; ?>" value="<?php echo htmlentities( $value ); ?>" />
                        <?php echo ( 0 == $key ? '<a href="#" class="btn btn-success btn-xs add-txt">Add More</a>' : '<a href="#" class="btn btn-danger btn-xs remove-txt">Remove</a>' ); ?>
                    </div>
                </div>
            <?php
                endforeach;
            }
            else
            {
            ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txtbox1">Box <span class="label-numbers">1</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="boxes[]" id="txtbox1" />
                        <a href="#" class="btn btn-success btn-xs add-txt">Add More</a>
                    </div>
                </div>
            <?php
            }
            ?>
                <input style="margin: 0 auto; width: 200px;" class="btn btn-primary btn-block" type="submit" value="Submit" />
            </form>
            <p><?php
                if( isset($_POST['boxes']) && is_array($_POST['boxes']) )
                {
                    if( 5 < count( $_POST['boxes'] ) ) :
                        echo 'Cheating Huh!';
                    else :
                        print 'Serialized String<br>' . htmlentities( serialize( $_POST['boxes'] ) );
                    endif;
                }
            ?></p>
        </div>
    </div>
    <script type="text/javascript">
        SyntaxHighlighter.all();
        jQuery(document).ready(function($){
             
            //Add More
            $(".form-horizontal .add-txt").click(function(){
                var no = $(".form-group").length + 1;
                if( 6 < no ) {
                    alert('Stop it!');
                    return false;
                }
                var more_textbox = $('<div class="form-group">' +
                '<label class="col-sm-2 control-label" for="txtbox' + no + '">Box <span class="label-numbers">' + no + '</span></label>' +
                '<div class="col-sm-10"><input class="form-control" type="text" name="boxes[]" id="txtbox' + no + '" />' +
                '<a href="#" class="btn btn-danger btn-xs remove-txt">Remove</a>' +
                '</div></div>');
                more_textbox.hide();
                $(".form-group:last").after(more_textbox);
                more_textbox.fadeIn("slow");
                return false;
            });
             
            //Remove
            $('.form-horizontal').on('click', '.remove-txt', function(){
                $(this).parent().parent().css( 'background-color', '#FF6C6C' );
                $(this).parent().parent().fadeOut("slow", function() {
                    $(this).parent().parent().css( 'background-color', '#FFFFFF' );
                    $(this).remove();
                    $('.label-numbers').each(function( index ){
                        $(this).text( index + 1 );
                    });
                });
                return false;
            });
        });
    </script>
</body>
</html>
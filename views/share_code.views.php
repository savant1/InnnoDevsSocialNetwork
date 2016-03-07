<?php $title = 'Partage des codes sources';?>
<?php include ('partials/_header.php');?>

        <div id="main-content">
            <div class="main-content-share-code">
                <form method="post" autocomplete="off">
                    <textarea name="code" class="prettyprint linenums" id="code" placeholder=<?= $menu['textareashare'][$_SESSION['locale']]; ?>
                              required="required"><?php isset($code) ?  e($code) : $menu['textareashare'][$_SESSION['locale']] ?></textarea>
                    <div class="btn-group navi">
                        <a href="#" class="btn btn-danger"><?= $menu['efface'][$_SESSION['locale']]; ?></a>
                        <input type="submit" class="btn btn-success" name="save" value="<?= $menu['enrei'][$_SESSION['locale']]; ?>">
                    </div>
                </form>
            </div>
        </div><!-- /.container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="assets/js/tabby.min.js"></script>
<script src="assets/js/prettify.js"></script>
<script>
    $(document).ready(function(){
        $("#code").tabby();
        $("#code").Height( $(window).Height() - 50 );
    )};
</script>
</body>
</html>
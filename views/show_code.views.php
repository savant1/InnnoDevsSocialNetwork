<?php $title = 'Affichage du code Source';?>
<?php include ('partials/_header.php');?>

    <div id="main-content">
        <div class="main-content-share-code">
            <pre class="prettyprint linenums">
                <?= nl2br(e($data->code)); ?>
            </pre>

            <div class="btn-group navi">
                <a href="share_code.php?id=<?= $_GET['id'] ?>" class="btn btn-warning"><?= $menu['cloner'][$_SESSION['locale']]; ?></a>
                <a href="share_code.php" class="btn btn-success"><?= $menu['nouveau'][$_SESSION['locale']]; ?></a>
            </div>
        </div>
    </div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="assets/js/prettify.js"></script>
<script>
    PrettyPrint();
</script>
</body>
</html>
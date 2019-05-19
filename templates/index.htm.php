<!doctype html>
<html lang="en">
<head>
    <title>MVC-GIBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <script src="../jquery/jquery-3.3.1.js"></script>
    <script src="../popper/popper.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    
    <div class="container">
        <div class="card text-left bg-light">
            <div class="row align-items-center">
                <div class="col">
                    <h1>MVC GIBS - Kontakte</h1>
                </div>
                <div class="col">
                    <p class="text-right"><?php $this->content('datum'); ?></p>
                </div>
            </div>
        </div>
        <div class="card text-left">
            <div <?php if(!isset($_SESSION["currentUser"])){ ?>>
                <?php $this->content('login'); ?>
            </div>
            <?php }?>
        </div>
        <div class="card text-left">
        	<div <?php if(isset($_SESSION["currentUser"])){ ?> >
                <?php echo $this->menu_bootstrap(config::MENU_TEMPLATE);?>
                <div class="row m-3">
                    <div class="col-12" style="overflow: auto">
                        <?php $this->content(); ?>
                    </div>
                </div>
        	</div>
            <?php }?>
        </div>
        <div class="card text-center bg-light">
            <span class="small">&copy; Copyright GIBS Solothurn</span>
            <div <?php if(isset($_SESSION["currentUser"])){ ?>>
                <form action="index.php?id=logout" method="post">
                	<input class="btn btn-outline-secondary" type="submit" name="logout" value="logout">
                </form>
            </div>
            <?php }?>
        </div>
    </div>
</body>
</html>
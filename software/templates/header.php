<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>The Fixxer: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>The Fixxer</title>
        <?php endif ?>

        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
        
       
    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/"><img alt="The fixxer" src="/img/logo.png"/></a>
            </div>

            <div id="middle">
            <?php if (isset($_SESSION["username"])): ?>
            <p class="text-center"><strong>Logged User:</strong> <?php echo htmlentities($_SESSION["username"]); ?> <strong>Date:</strong> <?php echo (new \DateTime())->format('Y-m-d'); ?> </p>
            <?php else: ?>
            <p class="text-center">Logged User: none</p>
            <?php endif ?>
            
            <div class="row">
            <div class="centered-pills">
            <ul class="nav nav-pills">
                <li><a href="index.php">Taglist</a></li>
                <li><a href="serials.php">Serials</a></li>
                <li><a href="master.php">Master list</a></li>
                <li><a href="equipment.php">Equipment types</a></li>
                <li><a href="service.php">Service calls</a></li>
                <li><a href="today.php">Daily activities</a></li>
                <li><a href="help.php">Instructions</a></li>
                <li><a href="logout.php"><strong>Log Out</strong></a></li>
            </ul>
            </div>
            </div>


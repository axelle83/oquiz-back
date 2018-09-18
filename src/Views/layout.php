<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Oquiz</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
        <!-- css -->
        <link rel="stylesheet" href="<?=$baseUrl?>/public/css/style.css">
    </head>
    <body>

        <!-- en-tête de l'application -->
        <?php $this->insert('partials/header') ?>

        <!-- là où sera injecté le code du template -->
        <?=$this->section('content')?>

        <!-- footer de l'application -->
        <?php $this->insert('partials/footer') ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- bootstrap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- app.js -->
          <script type="text/javascript">
            var BASE_PATH = "<?=$baseUrl?>";
        </script>
        <script type="text/javascript" src="<?=$baseUrl?>/public/js/app.js"></script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Interview project</title>
    <!-- Bootstrap core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Zadanie rekrutacyjne PHP</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        <h1>Zadanie rekrutacyjne PHP</h1>
        <?php if(isset($flashMessage)) : ?>
        <div class="alert alert-info" role="alert"><?php echo $flashMessage; ?></div>
        <?php endif; ?>
        <form class="form-inline" method="POST" action="#">
            <div class="form-group">
                <label for="exampleInputName2">Wyślij powiadomienie do</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">jeśli spełniony jest warunek</label>
                <select class="form-control" name="currency">
                    <?php foreach($data as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $key ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName2">jest</label>
                <select class="form-control" name="condition">
                    <option value="gt">></option>
                    <option value="lt"><</option>
                    <option value="eq">=</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName2">niż</label>
                <input type="text" class="form-control" name="value">
            </div>
            <input type="submit" class="btn btn-default" value="Wyślij">
        </form>

        <h3>Aktualne ceny skupu</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Waluta</th>
                <th>Cena skupu</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($data as $key => $value) : ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Contacts</title>
    <style>
        table.contacts{
            width: 100%;
        }

        table.contacts head{
            background-color: #eee;
            text-align :left;
        }

        table.contacts thead th{
            border : 1px solid #fff;
            padding : 3px;
        }

        table.contacts tbody td{
            border : 1px solid #eee;
            padding : 3px;
        }

        a, a:hover, a:active, a:visited{
            color: bleu;
            text-decoration : underline;
        }
    </style>

</head>
<body>

    <header class="d-flex justify-content-center py-3 bg-dark">
      <ul class="nav">
        <li class="nav-item"><a href="?op=list" class="nav-link text-white" aria-current="page">Tous les salairiés</a></li>
        <li class="nav-item"><a href="?op=new" class="nav-link text-white">Formulaire</a></li>

      </ul>
    </header>

  <div class="container">


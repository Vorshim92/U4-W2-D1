<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php


try {
    $query = "SELECT * FROM libri";
    $statement = $pdo->prepare($query);
    $statement -> execute();
} catch (PDOException $e) {
    die("Errore durante l'esecuzione della query: " . $e->getMessage());
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>

    </style>
</head>

<body>
    <div class="container">
    <h1>GESTIONE LIBRERIA </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">TITOLO</th>
          <th scope="col">AUTOREE</th>
          <th scope="col">ANNO</th>
          <th scope="col">GENERE</th>
          <th scope="col">ACTIONS</th>
        </tr>
      </thead>
    <?php
    // Visualizzazione dei dati all'interno di una tabella HTML
   
          foreach ($statement as $row) {
        echo "<tr><td>{$row['id']}</td><td>{$row['titolo']}</td><td>{$row['autore']}</td><td>{$row['anno_pubblicazione']}</td><td>{$row['genere']}</td><td id='btn-td'>
        <a href='http://localhost/U4-W2-D1/delete.php?id={$row['id']}'><button class='btn btn-danger'>Cancella</button></a>
        <a href='http://localhost/U4-W2-D1/form.php?id={$row['id']}'><button class='btn btn-warning'>Modifica</button></a>
        </td></tr>";

    }
    ?>
    </table> 
    
    <a href='http://localhost/U4-W2-D1/form.php' class='btn btn-primary'>ADD BOOK</a> 

</div >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

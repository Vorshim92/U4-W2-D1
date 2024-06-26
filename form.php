<?php include __DIR__ . '/includes/pdo.php'; ?>
<?php
$titolo = "";
$autore = "";
$anno = "";
$genere = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $query = "SELECT * FROM libri WHERE id=?";
        $statement = $pdo->prepare($query);
        $statement -> execute([$id]);
        $row = $statement->fetch();
        $titolo = $row['titolo'];
        $autore = $row['autore'];
        $anno = $row['anno_pubblicazione'];
        $genere = $row['genere'];

    } catch (PDOException $e) {
        die("Errore durante l'esecuzione della query: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validazione dei campi
    if (empty($_POST['titolo']) || empty($_POST['autore']) || empty($_POST['anno_pubblicazione']) || empty($_POST['genere'])) {
        $errors[] = "Tutti i campi sono obbligatori.";
    } 
    if  (!is_numeric($_POST['anno_pubblicazione']) || $_POST['anno_pubblicazione'] <= 0) 
    {
            $errors[] = "L'anno di pubblicazione deve essere un numero positivo.";
    }

    // Se ci sono errori, mostra un messaggio di errore
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        try {
            if (isset($_GET['id'])) {
                // Se è presente l'id, esegui l'aggiornamento
                $query = "UPDATE libri SET titolo = :titolo, autore= :autore , anno_pubblicazione= :anno_pubblicazione, genere =:genere WHERE id = :id";
                $statement = $pdo->prepare($query);
                $statement -> execute( ['id'=>$id, 
                'titolo'=>$_POST['titolo'],
                'autore'=>$_POST['autore'],
                'anno_pubblicazione'=>$_POST['anno_pubblicazione'],
                'genere'=>$_POST['genere'],]);
            } else {
                // Altrimenti, esegui l'inserimento di un nuovo record
                $query = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) VALUES (:titolo, :autore, :anno_pubblicazione, :genere)";
                $statement = $pdo->prepare($query);
                $statement -> execute( [ 
                'titolo'=>$_POST['titolo'],
                'autore'=>$_POST['autore'],
                'anno_pubblicazione'=>$_POST['anno_pubblicazione'],
                'genere'=>$_POST['genere'],]);
            }
            // Dopo aver eseguito l'azione, reindirizza a index.php
            header('Location:index.php');
        } catch (PDOException $e) {
            die("Errore durante l'esecuzione della query: " . $e->getMessage());
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <form class="text-center"  method="post">
        <h1><?php echo isset($id) ? 'Modifica Libro': 'Aggiungi Libro'; ?></h1>
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="titolo" aria-describedby="nameHelp" value="<?= ($titolo)?>">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Autore</label>
            <input type="text" class="form-control" id="author" name="autore" value="<?= ($autore)?>">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Anno</label>
            <input type="number" class="form-control" id="year" name="anno_pubblicazione" value="<?= ($anno)?>">
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genere</label>
            <input type="text" class="form-control" id="genre" name="genere" value="<?= ($genere)?>">
        </div>
        <button type="submit" class="btn btn-primary"><?php echo isset($id) ? 'Modifica': 'Aggiungi'; ?></button>
    </form>
    <div class="mt-3">
        <a href="http://localhost/U4-W2-D1/index.php" class="btn btn-info">Vai alla Home</a>
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
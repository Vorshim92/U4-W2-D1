<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {

        $titolo=$_POST['titolo'];
        $autore=$_POST['autore'];
        $anno_pubblicazione=$_POST['anno_pubblicazione'];
        $genere=$_POST['genere'];
     
        $query = "UPDATE libri SET titolo = :titolo, autore= :autore , anno_pubblicazione= :anno_pubblicazione, genere =:genere WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement -> execute( ['id'=>$id, 
        'titolo'=>$titolo,
        'autore'=>$autore,
        'anno_pubblicazione'=>$anno_pubblicazione,
        'genere'=>$genere,]);
        header('Location:index.php');
    } catch (PDOException $e) {
        die("Errore durante l'esecuzione della query: " . $e->getMessage());
    }
} else {
    $titolo=$_POST['titolo'];
    $autore=$_POST['autore'];
    $anno_pubblicazione=$_POST['anno_pubblicazione'];
    $genere=$_POST['genere'];
   
    $query = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) VALUES (:titolo, :autore, :anno_pubblicazione, :genere)";
    $statement = $pdo->prepare($query);
    $statement -> execute( [ 
    'titolo'=>$titolo,
    'autore'=>$autore,
    'anno_pubblicazione'=>$anno_pubblicazione,
    'genere'=>$genere,]);
    header('Location:index.php');

}
 



?>
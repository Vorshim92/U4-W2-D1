<?php include __DIR__ . '/includes/pdo.php'; ?>

<?php
$id=$_GET['id'];
 
try {
    $query = "DELETE FROM libri WHERE id=?";
    $statement = $pdo->prepare($query);
    $statement -> execute([$id]);
} catch (PDOException $e) {
    die("Errore durante l'esecuzione della query: " . $e->getMessage());
}

 header('Location:index.php')

?>
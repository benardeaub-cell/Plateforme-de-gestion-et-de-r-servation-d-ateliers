
<h1>Inscription à l'atelier</h1>

<?php 
// Afficher les détails de l'atelier pour confirmation
if (isset($workshop)) {
    echo "<h2>" . htmlspecialchars($workshop['title']) . "</h2>";
    echo "<p>" . htmlspecialchars($workshop['description']) . "</p>";
    echo "<p><strong>Date :</strong> " . htmlspecialchars($workshop['event_date']) . "</p>";
    echo "<p><strong>Places disponibles :</strong> " . $workshop['available_places'] . " / " . $workshop['total_places'] . "</p>";
}
?>

<form action="index.php?controller=reservations&action=store" method="POST">
    <input type="hidden" name="workshop_id" value="<?= htmlspecialchars($workshop['id_workshop']) ?>">
    
    <p>Confirmer votre inscription à cet atelier ?</p>
    
    <button type="submit" class="btn btn-primary">Confirmer l'inscription</button>
    <a href="index.php?controller=workshops&action=index" class="btn btn-secondary">Annuler</a>
</form>
<?php 

//affichage de la liste de ses propres réservations si connecté en user

?>
<h1>Détails de la Réservation</h1>
<div class="card">
    <div class="card-body">
        <h2 class="card-title"><?= htmlspecialchars($workshop['title'] ?? 'Atelier') ?></h2>
        <p class="card-text"><strong>Description :</strong> <?= htmlspecialchars($workshop['description'] ?? '') ?></p>
        <p class="card-text"><strong>Date de l'atelier :</strong> <?= htmlspecialchars($workshop['event_date'] ?? '') ?></p>
        <p class="card-text"><strong>Date de la réservation :</strong> <?= htmlspecialchars($reservation['reservation_date'] ?? '') ?></p>

        <a href="index.php?controller=reservations&action=cancel&id=<?= htmlspecialchars($reservation['id_reservation'] ?? '') ?>" class="btn btn-danger" onclick="return confirm('Annuler cette réservation ?')">Annuler la réservation</a>
        <a href="index.php?controller=reservations&action=index" class="btn btn-secondary">Retour à mes réservations</a>
    </div>
</div>
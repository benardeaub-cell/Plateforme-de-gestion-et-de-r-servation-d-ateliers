<?= 
$title = "Mes Reservations - Ajout d'une Réservation";

?>

<h1>Ajouter une Réservation</h1>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" id="date" name="date">
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">ID Utilisateur</label>
        <input type="text" class="form-control" id="user_id" name="user_id">
    </div>
    <div class="mb-3">
        <label for="workshop_id" class="form-label">ID Atelier</label>
        <input type="text" class="form-control" id="workshop_id" name="workshop_id">
    </div>
        
    
    <input type="text" hidden id="hidden" name="hidden">
    <button type="submit" class="btn btn-primary">Ajouter</button>

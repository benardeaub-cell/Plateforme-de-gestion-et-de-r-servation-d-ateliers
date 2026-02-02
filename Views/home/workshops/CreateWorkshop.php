<?= 
$title = "Mes Ateliers - Ajout d'un Atelier";

?>

<h1>Ajouter un Atelier</h1>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" id="date" name="date">
    </div>

    <div class="mb-3">
        <label for="total_places" class="form-label">Total Places</label>
        <input type="text" class="form-control" id="total_places" name="total_places">
    </div>

    <div class="mb-3">
        <label for="available_places" class="form-label">Available Places</label>
        <input type="text" class="form-control" id="available_places" name="available_places">
    </div>

    <input type="text" hidden id="hidden" name="hidden">
    <button type="submit" class="btn btn-primary">Ajouter</button>

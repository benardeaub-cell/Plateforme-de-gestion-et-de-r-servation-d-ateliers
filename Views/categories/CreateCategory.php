<?= 
$title = "Mes Catégories - Ajout d'une Catégorie";

?>

<h1>Ajouter une Catégorie</h1>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
       
    
    <input type="text" hidden id="hidden" name="hidden">
    <button type="submit" class="btn btn-primary">Ajouter</button>

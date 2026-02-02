<?php 

$title = "Mes Ateliers - Modification d'un Atelier";

?>

<h1>Modification d'un Atelier</h1>
<?php
if(!empty($erreur)){
?>  
<div class="alert alert-danger" role="alert">
  <?php echo $erreur; ?>
</div>
<?php
}
?>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $workshop->getTitle(); ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="<?php echo $workshop->getDescription(); ?>"> 
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" id="date" name="date" value="<?php echo $workshop->getDate(); ?>"> 
    </div>

    <div class="mb-3">
        <label for="total_places" class="form-label">Total Places</label>
        <input type="text" class="form-control" id="total_places" name="total_places" value="<?php echo $workshop->getTotal_places(); ?>"> 
    </div>

    <div class="mb-3">
        <label for="available_places" class="form-label">Available Places</label>
        <input type="text" class="form-control" id="available_places" name="available_places" value="<?php echo $workshop->getAvailable_places(); ?>"> 
    </div>

    <input type="hidden" name="id_category" value="<?php echo $user->getId_category(); ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

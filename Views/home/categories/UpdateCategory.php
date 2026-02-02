<?php 

$title = "Mes Catégories - Modification d'une Catégorie";

?>

<h1>Modification d'une Catégorie</h1>
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
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $category->getName(); ?>">
    </div>

    <input type="hidden" name="id_category" value="<?php echo $category->getId_category(); ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

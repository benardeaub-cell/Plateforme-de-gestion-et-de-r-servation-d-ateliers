<?php $Title = "Mes Catégories - Supprimer une Catégorie"; ?>

<h1>Supprimer une Catégorie</h1>
<p>Êtes-vous sûr de vouloir supprimer la catégorie "<?php echo $category->getName(); ?>" ?</p>
<form action="#" method="POST">
    <input class="btn btn-danger" type="submit" name="true" value="Oui, supprimer">
    <input class="btn btn-primary" type="submit" name="false" value="Non, annuler"> 
</form>

<?php $Title = "Mes Ateliers - Supprimer un Atelier"; ?>

<h1>Supprimer un Atelier</h1>
<p>Êtes-vous sûr de vouloir supprimer l'atelier "<?php echo $workshop->getTitle(); ?>" ?</p>
<form action="#" method="POST">
    <input class="btn btn-danger" type="submit" name="true" value="Oui, supprimer">
    <input class="btn btn-primary" type="submit" name="false" value="Non, annuler"> 
</form>

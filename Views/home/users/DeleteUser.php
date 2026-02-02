<?php $Title = "Mes Projets - Supprimer un Utilisateur"; ?>

<h1>Supprimer un Utilisateur</h1>
<p>Êtes-vous sûr de vouloir supprimer l'utilisateur "<?php echo $user->getName(); ?>" ?</p>
<form action="#" method="POST">
    <input class="btn btn-danger" type="submit" name="true" value="Oui, supprimer">
    <input class="btn btn-primary" type="submit" name="false" value="Non, annuler"> 
</form>


<h1>Modification d'une Réservation</h1>
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
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" id="date" name="date" value="<?php echo $reservation->getDate(); ?>">
    </div>

    <div class="mb-3">
        <label for="id_user" class="form-label">ID Utilisateur</label>
        <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $reservation->getUser_id(); ?>"> 
    </div>
    <div class="mb-3">
        <label for="id_workshop" class="form-label">ID Atelier</label>
        <input type="text" class="form-control" id="id_workshop" name="id_workshop" value="<?php echo $reservation->getWorkshop_id(); ?>">
    </div>

    <input type="hidden" name="id_user" value="<?php echo $user->getId_user(); ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

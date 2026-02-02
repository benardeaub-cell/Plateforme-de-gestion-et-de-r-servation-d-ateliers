<?php 

$title = "Mes Projets - Modification d'un Utilisateur";

?>

<h1>Modification d'un Utilisateur</h1>
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
        <label for="name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->getName(); ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->getEmail(); ?>"> 
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->getPassword(); ?>">
    </div>
    <input type="hidden" name="id_user" value="<?php echo $user->getId_user(); ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

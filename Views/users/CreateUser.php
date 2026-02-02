<?= 
$title = "Mes Utilisateurs - Ajout d'un Utilisateur";

?>

<h1>Ajouter un Utilisateur</h1>
<form action="#" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"> 
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password"> 
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">date d'inscription</label>
        <input type="date" class="form-control" id="date" name="date"> 
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rôle</label>
        <input type="text" class="form-control" id="role" name="role"> 
    </div>
    
    <input type="text" hidden id="hidden" name="hidden">
    <button type="submit" class="btn btn-primary">Ajouter</button>

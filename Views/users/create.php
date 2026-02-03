<h1>Ajouter un Utilisateur</h1>
<form action="index.php?controller=users&action=store" method="POST">

    <div class="mb-3">
        <label for="name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required> 
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required> 
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
    <a href="index.php?controller=users&action=index" class="btn btn-secondary">Annuler</a>
</form>

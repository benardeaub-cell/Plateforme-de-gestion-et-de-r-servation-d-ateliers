
    <h1>Créer un compte</h1>
      
    <form action="index.php?controller=auth&action=store" method="POST" class="needs-validation" id="registerForm" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
                Veuillez entrer votre nom.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                Veuillez entrer une adresse email valide.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">
                Veuillez entrer un mot de passe.
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    
    <p>Déjà un compte ? <a href="index.php?controller=auth&action=login">Se connecter</a></p>
</body>
</html>
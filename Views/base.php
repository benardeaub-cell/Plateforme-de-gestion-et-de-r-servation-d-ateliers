
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Affichage dynamique de la variable $title -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'Workshop Platform' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Lien vers votre fichier CSS personnalisé -->
    <link rel="stylesheet" href="/cours-CEFii/cours-poo/workshop_platform/public/assets/css/style.css">

    <!-- Lien vers fichier JavaScript personnalisé -->
    <script defer src="/cours-CEFii/cours-poo/workshop_platform/public/assets/js/addModal.js"></script>
    <script defer src="/cours-CEFii/cours-poo/workshop_platform/public/assets/js/editModal.js"></script>
    <!-- <script defer src="/cours-CEFii/cours-poo/workshop_platform/public/assets/js/script-2.js"></script> -->
    
    <script src="https://kit.fontawesome.com/cff33ecd93.js" crossorigin="anonymous"></script>
</head>


<body>
    <div class="container">
        <header class="text-center">
            <h1><?= isset($title) ? htmlspecialchars($title) : 'Workshop Platform' ?></h1>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php"><?= isset($title) ? htmlspecialchars($title) : 'Workshop Platform' ?></a>
                <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=home&action=index">Home</a>
                        </li>
                        <li class="nav-item">
                            <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3): ?>
                            <a class="nav-link" href="index.php?controller=users&action=index">Users</a>
                        <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=categories&action=index">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=workshops&action=index">Workshops</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=reservations&action=index">Reservations</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=auth&action=logout">Logout (<?= htmlspecialchars($_SESSION['name']) ?>)</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=auth&action=login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cours-CEFii/cours-poo/workshop_platform/public/index.php?controller=auth&action=register">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>    
        <main>
        <!-- Affichage dynamique de la variable $content -->
            <?= $content ?>
        </main>
        
        <footer class="text-center">
            <p><?= isset($title) ? htmlspecialchars($title) : 'Workshop Platform' ?> Copyrights &copy; 2026</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>
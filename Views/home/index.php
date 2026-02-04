<h1>Bienvenue sur la page d'accueil</h1>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            
        <?php // Message pour les utilisateurs non connectés ?>
        <?php if (!isset($_SESSION['user_id'])): ?>

            <h4>Inscrivez vous ou connectez vous pour participer aux ateliers</h4>
        <?php endif; ?>

            <?php if (!empty($upcomingWorkshops)): ?>
                <h2>Ateliers à venir</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Places</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($upcomingWorkshops as $workshop): ?>
                            <tr>
                                <td><?= htmlspecialchars($workshop['title']) ?></td>
                                <td><?= date('d-m-Y H:i', strtotime($workshop['event_date'])) ?></td>
                                <td><?= htmlspecialchars($workshop['description']) ?></td>
                                <td><?= intval($workshop['available_places']) ?> / <?= intval($workshop['total_places']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
                





            <div class="mt-4">
                <a href="index.php?controller=categories&action=index" class="btn btn-secondary">Voir les Catégories</a>
                <a href="index.php?controller=workshops&action=index" class="btn btn-secondary">Voir les Ateliers</a>
            </div>
        </div>
    </div>
</div>

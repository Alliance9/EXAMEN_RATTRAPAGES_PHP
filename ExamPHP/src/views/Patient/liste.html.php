<!DOCTYPE html>
<html>
<head>
    <title>Liste des patients</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des patients :</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Numéro Patient</th>
                    <th>Nom Complet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?php echo $patient['numPatient']; ?></td>
                        <td><?php echo $patient['nomCompet']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

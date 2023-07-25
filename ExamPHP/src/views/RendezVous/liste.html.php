<!DOCTYPE html>
<html>
<head>
    <title>Liste des rendez-vous</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des rendez-vous :</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>État</th>
                    <th>Numéro Patient</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rendezVous as $rv) : ?>
                    <tr>
                        <td><?php echo $rv['id']; ?></td>
                        <td><?php echo $rv['date']; ?></td>
                        <td><?php echo $rv['etat']; ?></td>
                        <td><?php echo $rv['patient_numPatient']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

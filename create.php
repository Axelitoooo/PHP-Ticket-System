<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$msg = '';
// verifie si l'utilisateur a envoyé le formulaire
if (isset($_POST['nom'], $_POST['prénom'], $_POST['email'], $_POST['sujet'], $_POST['type'], $_POST['salle'], $_POST['msg'])) {
    // verifie que les champs ne sont pas vides
    if (empty($_POST['nom']) || empty($_POST['prénom']) || empty($_POST['email']) || empty($_POST['sujet']) || empty($_POST['type']) || empty($_POST['salle']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please provide a valid email address!';
    } else {
        // insere les nouvelles infos dans la bdd
        $stmt = $pdo->prepare('INSERT INTO tickets (nom, prénom, email, sujet, type, salle, msg) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([ $_POST['nom'], $_POST['prénom'], $_POST['email'], $_POST['sujet'], $_POST['type'], $_POST['salle'], $_POST['msg'] ]);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        header('Location: createsuccess.php?id=' . $pdo->lastInsertId());
    }
}
?>

<?=template_headercon('Create Ticket')?>


<div class="content create">
    <h2>Création du ticket</h2>
    <form action="create.php" method="post">

        <label for="nom">Nom</label>
        <input type="text" name="nom" placeholder="nom..." id="nom" required>

        <label for="prénom">Prénom</label>
        <input type="text" name="prénom" placeholder="prénom..." id="prénom" required>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="jean.dupont@exemple.com" id="email" required>

        <label for="sujet">Sujet</label>
        <input type="text" name="sujet" placeholder="sujet..." id="sujet" required>

        <label for="type">Type de problème</label>
        <select name='type'>
            <option value="" disabled selected>Type de problème...</option>
            <option value="Matériel">Matériel</option>
            <option value="Electrique">Electrique</option>
            <option value="Infrastructure">Infrastructure</option>
            <option value="Autre">Autre</option>
        </select>
        <br>
        <label for="salle">Salle</label>
        <input type="text" name="salle" placeholder="salle..." id="salle" required>

        <label for="msg">Description</label>
        <textarea name="msg" placeholder="Ecrivez votre description..." id="msg" required></textarea>

        <input type="submit" value="Envoyer">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>


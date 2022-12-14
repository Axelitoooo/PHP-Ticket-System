<?php
include 'functions.php';
include 'Maill.php';
// Connexion a mysql
$pdo = pdo_connect_mysql();
// verifie que l'id existe
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
//selectionne le ticket par l'id de la colonne
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

// Maj du statut
if (isset($_GET['statut']) && in_array($_GET['statut'], array('en attente', 'non traité', 'résolu'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET statut = ? WHERE id = ?');
    $stmt->execute([ $_GET['statut'], $_GET['id'] ]);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}

// verifie si un commentaire a ete envoyé
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // insere le nouveau commentaire dans la bdd
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (ticket_id, msg) VALUES (?, ?)');
    $stmt->execute([ $_GET['id'], $_POST['msg'] ]);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM tickets_comments WHERE ticket_id = ? ORDER BY dates DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Ticket')?>

<div class="content view">

    <h2><?=htmlspecialchars($ticket['sujet'], ENT_QUOTES)?> <span class="<?=$ticket['statut']?>">(<?=$ticket['statut']?>) - Salle : <?=htmlspecialchars($ticket['salle'], ENT_QUOTES)?> <br> Type : <?=htmlspecialchars($ticket['type'], ENT_QUOTES)?> </span></h2>

    <div class="ticket">
        <p class="msg"><?=nl2br(htmlspecialchars($ticket['msg'], ENT_QUOTES))?></p>
        <p class="dates"><?=date('d/m/Y, H:i', strtotime($ticket['dates']))?></p>
    </div>

    <div class="btns">
        <a href="view.php?id=<?=$_GET['id']?>&statut=non traité" class="btn red">Clore le ticket</a>
        <a href="view.php?id=<?=$_GET['id'];
        if( $ticket['statut'] == 'résolu' && $ticket['statut_email'] == 0){
            email($ticket['email'],'Resolution ticket','Votre ticket à bien été résolu. Cordialement.');
            $stmt = $pdo->prepare('UPDATE tickets SET statut_email=1 WHERE id = ?');
            $stmt->execute([ $_GET['id']]);
        }

        ?>&statut=résolu" class="btn on">Problème résolu</a>
    </div>

    <div class="comments">
        <?php foreach($comments as $comment): ?>
        <div class="comment">
            <div>
                <i class="fas fa-comment fa-2x"></i>
            </div>
            <p>
                <span><?=date('d/m/Y, H:i', strtotime($comment['dates']))?></span>
                <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
            </p>
        </div>
        <?php endforeach; ?>
        <form action="" method="post">
            <textarea name="msg" placeholder="Ecrivez ici votre commentaire..."></textarea>
            <input type="submit" value="Poster le commentaire">
        </form>
    </div>

</div>

<?=template_footer()?>
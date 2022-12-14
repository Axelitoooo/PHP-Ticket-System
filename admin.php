<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// MySQL query that retrieves  all the tickets from the databse
$stmt = $pdo->prepare('SELECT * FROM tickets ORDER BY dates DESC');
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Tickets')?>

<div class="content home">

	<h2>Tickets</h2>

	<p>Bienvenue sur le site de support ! Voici la liste des tickets.</p>

	<div class="tickets-list">
		<?php 
			foreach ($tickets as $ticket): ?>
		<a href="view.php?id=<?=$ticket['id']?>" class="ticket">
			<span class="con">
				<?php if ($ticket['statut'] == 'en attente'): ?>
				<i class="far fa-clock fa-2x"></i>
				<?php elseif ($ticket['statut'] == 'résolu'): ?>
				<i class="fas fa-check fa-2x"style="color:#38b673;"></i>
				<?php elseif ($ticket['statut'] == 'non traité'): ?>
				<i class="fas fa-times fa-2x"style="color:#b63838;"></i>
				<?php endif; ?>
			</span>
			<span class="con">
				<span class="sujet"><?=htmlspecialchars($ticket['sujet'], ENT_QUOTES)?></span>
				<span class="msg"><?=htmlspecialchars($ticket['msg'], ENT_QUOTES)?></span>
			</span>
			<span class="con dates"><?=date('d/m/Y, H:i', strtotime($ticket['dates']))?></span>
		</a>
		<?php endforeach; ?>
	</div>

</div>

<?=template_footer()?>
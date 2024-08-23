<?php 
require_once 'DAO.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['auta'])) {
    $auta = $_SESSION['auta'];

    include './partials/header.php'; 
?>
<div class="row" style="margin-left:1rem ;">
    <div class="col-12">
        <?php if (!empty($auta)) { ?>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Marka</th>
                <th>Cena</th>
            </tr>
            <?php foreach ($auta as $auto) { ?>
            <tr>
                <td><?= htmlspecialchars($auto['id']) ?></td>
                <td><?= htmlspecialchars($auto['marka']) ?></td>
                <td><?= htmlspecialchars($auto['cena']) ?> €</td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
        <p>Nema automobila koji ispunjavaju kriterijume.</p>
        <?php } ?>
        <a href="controller.php?action=logout">LOGOUT</a>
        <a href="./index.php">Index</a>
    </div>
</div>
<?php 
    include './partials/footer.php'; 
} else {
    header('Location:index.php'); 
}
?>

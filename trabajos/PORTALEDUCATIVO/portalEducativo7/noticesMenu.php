<?php
include './CRUDNotice.php';

echo '<div class="content">';
echo "<h1>Anuncios</h1><br /><hr>";
?>
<form action="#" method="post">
    <input type="submit" name="newNotice" value="Crear Anuncio" />
</form>
<?php
$notices = getNotices($_GET["subjectId"]);
for ($i = 0; $i < count($notices); $i++) {
    echo "<h2>" . $notices[$i]["title"] . "</h2>";
    echo "<p>" . $notices[$i]["text"] . "</p>";
    echo "<hr>";
}
if (isset($_POST['newNotice'])) {
    ?>
    <form action="#" method="post">
        <label>Titulo:</label><br /><input type="text" name="noticeTitle" required="required" placeholder="Obligatorio" /><br /><br />
        <label>Texto:</label><br /><textarea name="noticeContent" placeholder="Escribe aqu&iacute; el anuncio" rows="10" cols="40"></textarea><br /><br />
        <input type="submit" name="submitNewNotice" value="Enviar" />
    </form>
    <?php
}

if (isset($_POST['submitNewNotice'])) {
    if (createNotice($_GET['subjectId'], $_POST['noticeTitle'], $_POST['noticeContent'])) {
        header("Refresh:0");
    }
}
echo "</div>";

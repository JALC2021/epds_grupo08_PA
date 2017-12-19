<?php
include './CRUDMessage.php';
?>
<h2>Mensajería</h2>

<?php
?>
<div class="content">
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Mensaje</legend>
            <label>T&iacute;tulo:</label><input type="text" name="title" required="required"/><br />
            <label>Mensaje:</label><input type="text" name="message" required="required"/><br />
            <input type="hidden" name="subjectId" value="<?php echo $_GET['subjectId']; ?>"/>
            <input type="submit" name="submitMessage" value="Enviar" />
        </fieldset>
    </form>
</div>
<?php
if (isset($_POST['submitMessage'])) {

    $subjectId = $_POST['subjectId'];
    $title = $_POST['title'];
    $text = $_POST['message'];

    if (createMessage($subjectId, $_SESSION['userid'], $title, $text)) {
        echo "<script type='text/javascript'>alert('Mensaje enviado con éxito');</script>";
    } else {
        echo "<script type='text/javascript'>alert('El mensaje no ha sido enviado');</script>";
    }
}
?>

<hr>

<div class="content">
    <?php
    $messages = array_reverse(getMessages($_GET['subjectId'], $_SESSION['userid']));

    for ($i = 0; $i < count($messages); $i++) {
        if (isset($messages[$i]["teacherId"])) {
            echo "<h2>{Profesor} " . $messages[$i]["title"] . "</h2>";
        } else {
            echo "<h2>{T&uacute;} " . $messages[$i]["title"] . "</h2>";
        }
        echo "<p>" . $messages[$i]["text"] . "</p>";
        echo "<hr>";
    }
    ?>
</div>

<hr>

<?php
include './bodyToHtml.php';
?>
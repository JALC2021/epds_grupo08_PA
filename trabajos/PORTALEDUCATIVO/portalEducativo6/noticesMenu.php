<?php

include './CRUDNotice.php';

echo '<div class="content">';
echo "<h1>Anuncios</h1><br /><hr>";
$notices = getNotices($_GET["subjectId"]);
for ($i = 0; $i < count($notices); $i++) {
    echo "<h2>" . $notices[$i]["title"] . "</h2>";
    echo "<p>" . $notices[$i]["text"] . "</p>";
    echo "<hr>";
}
echo "</div>";
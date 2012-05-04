<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        Kategorie
        <nav>
            <?php
            $link = mysql_connect('localhost:3306', 'root');
            if (!$link) {
                echo 'no link';
            }
            mysql_set_charset('utf8');
            $result = mysql_query("SELECT DISTINCT category FROM bookexpress.item");
            if (!$result) {
                echo '-1';
            } else {
                while ($row = mysql_fetch_array($result)) {
                    ?>
                    <div>
                        <a href="genre.php?category=<?php echo $row[0]; ?>"><?php echo $row[0]; ?></a>
                    </div>
                    <?php
                }
            }
            ?>
        </nav>
    </body>
</html>

<?php ?>

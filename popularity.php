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
        <?php
        if (isset($_GET['popular'])) {
            $link = mysql_connect('localhost:3306', 'root');
            if (!$link) {
                echo 'no link';
            }
            mysql_set_charset('utf8');
            $query = 'SELECT title, isbn FROM bookexpress.item ORDER BY popularity';
            if ($_GET['popular']) {
                $query .= ' DESC';
            }
            $result = mysql_query($query);
            if (!$result) {
                echo '-1';
            } else {
                while ($row = mysql_fetch_row($result)) {
                    ?>
                    <div>
                        <a href="item.php?isbn=<?php echo $row[1]; ?>"><?php echo $row[0]; ?></a>
                    </div>
                    <?php
                }
            }
        } else {
            ?>
            <div>
                <a href="popularity.php?popular=true">Beliebteste Medien</a>
            </div>
            <div>
                <a href="popularity.php?popular=false">Unbeliebteste Medien</a>
            </div>
            <?php
        }
        ?>
    </body>
</html>

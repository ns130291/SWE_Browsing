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
        $link = mysql_connect('localhost:3306', 'root');
        if (!$link) {
            echo 'no link';
        }
        mysql_set_charset('utf8');
        $query = 'SELECT DISTINCT LEFT(title, 1) FROM bookexpress.item';
        if (isset($_GET['category'])) {
            $query .= ' WHERE category="' . $_GET['category'] . '"';
        }
        $query .= ' ORDER BY title';
        $result = mysql_query($query);
        if (!$result) {
            echo '-1';
        } else {
            while ($row = mysql_fetch_row($result)) {
                echo $row[0];
                $query = 'SELECT title, isbn FROM bookexpress.item WHERE title LIKE "' . $row[0] . '%"';
                if (isset($_GET['category'])) {
                    $query .= ' AND category="' . $_GET['category'] . '"';
                }
                $query .= ' ORDER BY title';
                $result2 = mysql_query($query);
                if (!$result2) {
                    echo '-1';
                } else {
                    while ($row2 = mysql_fetch_row($result2)) {
                        ?>
                        <div>
                            <a href="item.php?isbn=<?php echo $row2[1]; ?>"><?php echo $row2[0]; ?></a>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>
    </body>
</html>

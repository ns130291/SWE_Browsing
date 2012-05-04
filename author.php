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
        if (isset($_GET['author'])) {
            $query = 'SELECT title, isbn FROM bookexpress.item WHERE author="'.$_GET['author'].'" ORDER BY title';
            $result = mysql_query($query);
            echo $_GET['author'];
            if (!$result) {
                echo '-1';
            } else {
                while ($row = mysql_fetch_array($result)) {
                    ?>
                    <div>
                        <a href="item.php?isbn=<?php echo $row[1]; ?>"><?php echo $row[0]; ?></a>
                    </div>
                    <?php
                }
            }
        } else {
            $query = 'SELECT DISTINCT LEFT(author, 1) FROM bookexpress.item ORDER BY author';
            $result = mysql_query($query);
            if (!$result) {
                echo '-1';
            } else {
                while ($row = mysql_fetch_row($result)) {
                    echo $row[0];
                    $query = 'SELECT DISTINCT author FROM bookexpress.item WHERE author LIKE "' . $row[0] . '%" ORDER BY author';
                    $result2 = mysql_query($query);
                    if (!$result2) {
                        echo '-1';
                    } else {
                        while ($row2 = mysql_fetch_row($result2)) {
                            ?>
                            <div>
                                <a href="author.php?author=<?php echo $row2[0]; ?>"><?php echo $row2[0]; ?></a>
                            </div>
                            <?php
                        }
                    }
                }
            }
        }
        ?>
    </body>
</html>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head><?php ?>
    <body>
        <?php
        if (isset($_GET['genre'])) {
            $link = mysql_connect('localhost:3306', 'root');
            if (!$link) {
                echo 'no link';
            }
            mysql_set_charset('utf8');
            if ($_GET['genre'] == "NULL") {
                $query = 'SELECT title, isbn FROM bookexpress.item WHERE genre IS NULL';
            } else {
                $query = 'SELECT title, isbn FROM bookexpress.item WHERE genre="' . $_GET['genre'] . '"';
            }
            if (isset($_GET['category'])) {
                $query .= ' AND category="' . $_GET['category'] . '"';
            }
            $result = mysql_query($query);
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
            ?>

            <?php
        } else {
            ?>
            Genres
            <?php
            if (isset($_GET['category'])) {
                echo ' in Kategorie ' . $_GET['category'];
            }
            ?>
            <nav>
                <?php
                if (isset($_GET['category'])) {
                    ?>
                    <div>
                        <a href="alphabetical.php?category=<?php echo $_GET['category']; ?>">alle</a>
                    </div>
                    <?php
                }
                $link = mysql_connect('localhost:3306', 'root');
                if (!$link) {
                    echo 'no link';
                }
                mysql_set_charset('utf8');
                if (isset($_GET['category'])) {
                    $result = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE category="' . $_GET['category'] . '"');
                    $result2 = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE genre IS NULL AND category="' . $_GET['category'] . '"');
                } else {
                    $result = mysql_query('SELECT DISTINCT genre FROM bookexpress.item');
                    $result2 = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE genre IS NULL');
                }
                if (!$result2) {
                    echo '-1';
                } else {
                    $row = mysql_fetch_array($result2);
                    if ($row) {
                        ?>
                        <div>
                            <a href="genre.php?genre=NULL
                            <?php
                            if (isset($_GET['category'])) {
                                echo '&category=' . $_GET['category'];
                            }
                            ?>
                               ">ohne Genre</a>
                        </div>
                        <?php
                    }
                }
                if (!$result) {
                    echo '-1';
                } else {
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <div>
                            <a href="genre.php?genre=<?php echo $row[0]; ?>
                            <?php
                            if (isset($_GET['category'])) {
                                echo '&category=' . $_GET['category'];
                            }
                            ?>
                               "><?php echo $row[0]; ?></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </nav>
            <?php
        }
        ?>
    </body>
</html>

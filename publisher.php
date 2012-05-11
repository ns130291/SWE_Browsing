<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BookExpress</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="header">BookExpress</div>
        <div id="main">
            <div id="breadcrumb">
                <a href="index.php">Home</a>
                <?php
                $link = mysql_connect('localhost:3306', 'root');
                if (!$link) {
                    echo 'no link';
                }
                mysql_set_charset('utf8');
                if (isset($_GET['publisher'])) {
                    $result3 = mysql_query('SELECT name FROM bookexpress.publisher WHERE `PIN`="' . $_GET['publisher'].'"');
                    if (!$result3) {
                        echo '-1';
                    } else {
                        $row3 = mysql_fetch_array($result3);
                        if ($row3) {
                            echo ' &gt; <a href="publisher.php">Verlag</a> &gt; ' . $row3[0];
                            $breadcrumb = ' &gt; <a href="publisher.php">Verlag</a> &gt; <a href="publisher.php?publisher=' . $_GET['publisher'] . '">' . $row3[0] . '</a>';
                        }
                    }
                } else {
                    echo ' &gt; Verlag';
                }
                ?>
            </div>
            <nav>
                <h3>Sortieren nach...</h3>
                <div>
                    <a href="category.php">Kategorie</a>
                </div>
                <div>
                    <a href="genre.php">Genre</a>
                </div>
                <div>
                    <a href="author.php">Autor</a>
                </div>
                <div>
                    <a href="publisher.php">Verlag</a>
                </div>
                <div>
                    <a href="year.php">Erscheinungsjahr</a>
                </div>
                <div>
                    <a href="popularity.php">Beliebtheit</a>
                </div>
                <div>
                    <a href="rating.php">Bewertungen</a>
                </div>
                <div>
                    <a href="alphabetical.php">Alphabetisch</a>
                </div>
                <div>
                    <a href="isbn.php">ISBN</a>
                </div>
            </nav>
            <section>
                <h2>Verlag</h2>
                <?php
                if (isset($_GET['publisher'])) {
                    $query = 'SELECT title, isbn FROM bookexpress.item WHERE publisher="' . $_GET['publisher'] . '" ORDER BY title';
                    $result = mysql_query($query);
                    echo $row3[0];
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <div>
                                <a href="item.php?isbn=<?php echo $row[1]; ?>&breadcrumb=<?php echo urlencode($breadcrumb) ?>"><?php echo $row[0]; ?></a>
                            </div>
                            <?php
                        }
                    }
                } else {
                    $query = 'SELECT LEFT(pub.`name`, 1) FROM (SELECT DISTINCT publisher FROM bookexpress.item) AS title, bookexpress.publisher AS pub WHERE title.publisher = pub.`PIN` ORDER BY pub.`name`';
                    $result = mysql_query($query);
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_row($result)) {
                            ?>
                            <div class="bigchar"><?php echo $row[0]; ?></div>
                            <?php
                            $query = 'SELECT pub.`name`, pub.`PIN` FROM (SELECT DISTINCT publisher FROM bookexpress.item) AS title, bookexpress.publisher AS pub WHERE title.publisher = pub.`PIN` AND `name` LIKE "' . $row[0] . '%" ORDER BY pub.`name`';
                            $result2 = mysql_query($query);
                            if (!$result2) {
                                echo '-1';
                            } else {
                                while ($row2 = mysql_fetch_row($result2)) {
                                    ?>
                                    <div>
                                        <a href="publisher.php?publisher=<?php echo $row2[1]; ?>"><?php echo $row2[0]; ?></a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                }
                ?>
            </section>
        </div>
        <footer>
            Credits to Nico and Anja
        </footer>
    </body>
</html>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
$link = mysql_connect('localhost:3306', 'root');
if (!$link) {
    echo 'no link';
}
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM bookexpress.item WHERE isbn="' . $_GET['isbn'] . '"');
mysql_query('UPDATE bookexpress.item SET popularity=popularity+1 WHERE `ISBN`="' . $_GET['isbn'] . '"');
if (!$result) {
    echo '-1';
} else {
    $row = mysql_fetch_row($result);
    if ($row) {
        $result2 = mysql_query('SELECT `name` FROM bookexpress.publisher WHERE `PIN`="' . $row[6] . '"');
        if (!$result2) {
            echo '-1';
        } else {
            $row2 = mysql_fetch_row($result2);
            if ($row2) {
                ?>
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                        <title><?php echo $row[3]; ?> - BookExpress</title>
                        <link rel="stylesheet" type="text/css" href="style.css">
                    </head>
                    <body>
                        <div id="header">BookExpress</div>
                        <div id="main">
                            <div id="breadcrumb">
                                <a href="index.php">Home</a>
                                <?php
                                echo $_GET['breadcrumb'];
                                echo ' &gt; ' . $row[3];
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
                                    <a href="rating.php">Bewertung</a>
                                </div>
                                <div>
                                    <a href="alphabetical.php">Alphabetisch</a>
                                </div>
                                <div>
                                    <a href="isbn.php">ISBN</a>
                                </div>
                            </nav>

                            <section id="item">
                                <h2>Details</h2>
                                <div id="available_container">
                                    <div id="item_category"><?php echo $row[1]; ?></div>
                                    <div id="item_available">
                                        <?php
                                        if ($row[7] > 0) {
                                            echo '<img src="pics/stack_yes.png" alt="in stock" title="in stock">';
                                        } else {
                                            echo '<img src="pics/stack_no.png" alt="not in stock" title="not in stock">';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div style="margin-left: 70px;">
                                    <div>
                                        <span id="item_title"><?php echo $row[3]; ?></span><span id="item_year">( <?php echo $row[5]; ?> )</span>
                                    </div>
                                    <div id="item_author"><?php echo $row[4]; ?></div>
                                    <div>
                                        <div id="item_picture"><img src="pics/<?php echo $row[0]; ?>.jpg" alt="picture"></div>
                                        <div id="item_container">
                                            <div id="item_publisher"><?php echo $row2[0]; ?></div>
                                            <div id="item_isbn"><?php echo $row[0]; ?></div>
                                            <div id="item_genre"><?php echo $row[2]; ?></div>
                                            <div id="item_rating"><div class="rating" data-rating="<?php echo $row[8]; ?>"></div></div>
                                            <div id="item_popularity">
                                                <?php
                                                echo $row[9];
                                                if ($row[9] == 1) {
                                                    echo ' Klick';
                                                } else {
                                                    echo ' Klicks';
                                                }
                                                ?>
                                            </div>	
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <footer>
                            Credits to Nico and Anja
                        </footer>
                    </body>
                </html>
                <?php
            }
        }
    }
}
?>

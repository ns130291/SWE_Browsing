<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">
            .rating{
                background-size: contain;
                background-repeat: no-repeat;
                width: 150px;
                height: 35px;
            }
            .rating[data-rating="0"]{
                background-image: url(pics/0star.png);
            }
            .rating[data-rating="1"]{
                background-image: url(pics/1star.png);
            }
            .rating[data-rating="2"]{
                background-image: url(pics/2star.png);
            }
            .rating[data-rating="3"]{
                background-image: url(pics/3star.png);
            }
            .rating[data-rating="4"]{
                background-image: url(pics/4star.png);
            }
            .rating[data-rating="5"]{
                background-image: url(pics/5star.png);
            }
        </style>
    </head>
    <body>
        <?php
        $link = mysql_connect('localhost:3306', 'root');
        if (!$link) {
            echo 'no link';
        }
        mysql_set_charset('utf8');
        $result = mysql_query('SELECT * FROM bookexpress.item WHERE isbn="' . $_GET['isbn'] . '"');
        if (!$result) {
            echo '-1';
        } else {
            $row = mysql_fetch_row($result);
            if ($row) {
                foreach ($row as $value) {
                    echo $value . "<br>";
                }
                ?>
                <div class="rating" data-rating="<?php echo $row[8]; ?>"></div>
                <?php
            }
        }
        ?>
    </body>
</html>

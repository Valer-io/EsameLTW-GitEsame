<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP example</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        /*td {
            border: 1px solid black;
        }*/
    </style>
</head>
<body>
    <?php
    $a = 1;
    $first = true;
    echo "<h1 class=\"text-center my-3 bg-primary text-white\">ciao mondo</h1>";
        $dbconn = pg_connect("host=localhost password=biar user=postgres port=5432 dbname=EsempioConnessionePHP")
        or die("Could not connect: " . pg_last_error());
        $query = "SELECT * FROM citta";
        $result = pg_query($dbconn, $query);

        echo "<div class=\"container my-3\">
                <table class=\"table\">";

        while ($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)) {
            if ($first) {
                echo "<thead>
                        <tr>
                        <th scope=\"col\">#</th>";
                foreach ($tuple as $colname => $value) {
                    echo " <th scope=\"col\">";
                    print $colname;
                    echo "</th>";
                }
                echo "</tr>
                      </thead>
                      <tbody>";
                $first = false;
            }
            echo "      <tr>
                            <th scope=\"row\">$a</th>";
            foreach ($tuple as $colname => $value) {
                echo "<td>";
                print $value;
                echo "</td>";
            }
            $a++;
            echo "</tr>";
        }
        echo        "</tbody>
            </table>";
    ?>
<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
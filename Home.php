<?php

            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', '');
            define('DB_NAME', 'Bettosanderi');
             
            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
             
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HomePage</title>

    <style>
        body{ 
            font: 14px sans-serif; 
            text-align: center; 
            background-color: coral;
            }
        table, th, td {
            border: 1px solid black;}
        .shadowbox {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50em;
            border: 1px solid #333;
            box-shadow: 8px 8px 5px #444;
            padding: 8px 12px;
            background-image: linear-gradient(180deg, #fff, #ddd 40%, #ccc);
        }
    </style>

</head>
<body>
    <div class="page-header">
        <h1>Ciao, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Benvenuto nel sito di Alberto Scuderi!!!</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Log out</a>
    </p>
    <br><br><br><br><br>
    <div class="shadowbox">
        <h3 align = "left"> Canzoni: </h3>
        <table>
            <tr><td>&nbspID&nbsp</td><td>&nbspNome Canzone&nbsp</td><td>&nbspAnno di pubblicazione&nbsp</td><td>&nbspDurata&nbsp</td><td>&nbspScrittore&nbsp</td><td>&nbspFeat.&nbsp</td></tr>

            <?php

                $sql = "SELECT id, Nome, Anno, DurataC, writer, Collab from Canzoni";
                $result = $link -> query($sql);
                $scri = isset($_POST["writer"]) ? htmlspecialchars($_POST["writer"]) : ''; 

                if ($result -> num_rows > 0) {

                    while ($row = $result-> fetch_assoc()){

                        echo "<tr><td>".$row["id"]."</td><td>".$row["Nome"]."</td><td>".$row["Anno"]."</td><td>".$row["DurataC"]."</td><td>".$row["writer"]."</td><td>".$row["Collab"]."</td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "0 risultati";
                }

                $sel = "SELECT id, Nome, Anno, DurataC, writer, Collab from Canzoni WHERE Collab ='Claver Gold' OR Collab ='Murubutu'";

                echo "<br><br><br>";

                echo "<h3 align='left'>Ecco di seguito tutte le canzoni in cui hanno cantato sia Murubutu che Claver Gold</h3><br>";


                echo "<table>";
                echo "<tr><td>&nbspID&nbsp</td><td>&nbspNome Canzone&nbsp</td><td>&nbspAnno di pubblicazione&nbsp</td><td>&nbspDurata&nbsp</td><td>&nbspScrittore&nbsp</td><td>&nbspFeat.&nbsp</td></tr>";
                if($res = mysqli_query($link, $sel)){ 
                    while($row = mysqli_fetch_array($res)){ 
                    echo "<tr>"; 
                    echo "<tr><td>".$row["id"]."</td><td>".$row["Nome"]."</td><td>".$row["Anno"]."</td><td>".$row["DurataC"]."</td><td>".$row["writer"]."</td><td>".$row["Collab"]."</td></tr>";
                    echo "</tr>"; 
                } 

                echo "</table>";

                echo "<br><br><br>";

        }

            ?>

    </div>

    <br><br>

    <div class = "shadowbox">
        <p> Questo sito al momento è incompleto a livello grafico a causa dell'elevato numerodi interrogazioni da dover fare. Per l'esame sarà ovviamente migliorato </p>
    </div>



</table>
</body>
</html>
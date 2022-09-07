<?php 
    $con = new mysqli("127.0.0.1:3306", "root", "", "biblioteca");
    $select_loan = "select cod from livrosemprereg";
    $response_l = $con->query($select_loan);
    $count_genre = 0;
    $genres_count = [
        0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
        0,0,0,0,0,

    ];
    $genres = [
        "Dicionários",
        "Obras gerais de referência",
        "Metodologia",
        "Jornalismo",
        "Ciência da computação",
        "Filosofia",
        "Psicologia",
        "Religião",
        "Ciências sociais",
        "Meio ambiente",
        "Matemática",
        "Astronomia",
        "Física",
        "Química",
        "Biologia",
        "Engenharia",
        "Medicina",
        "Contabilidade",
        "Nutrição",
        "Inglês",
        "Administração",
        "Geografia",
        "Espanhol",
        "Literatura",
        "História",
        "Literatura americana",
        "Literatura inglesa",
        "Literatura alemã",
        "Literatura portuguesa",
        "Literatura espanhola",
        "Literatura francesa",
        "Literatura brasileira",
        "Literatura italiana",
        "Literatura chinesa",
        "Literatura russa",
        "Artes, entretenimento e esportes",
        "Literatura japonesa",
        "Teatro",
        "Poesia",
        "Livros em inglês, francês e espanhol",
        "Crônicas",
        "Revistas",
        "TCCs",
        "Cds",
        "Apostilas",
        "Livros didáticos",
        "Biografia",
        "Estatística",
        "Marketing",
        "Artes",
        "Automação",
        "Português",
        "Gramática",
        "Eletrônica",
        "Contos",
        "Ética",
        "Contabilidade",
        "Economia",
        "Sociologia",
        "Pedagogia",
        "Direito",
        "Informática",
        "Enciclopédia",
        "Comunicação",
    ];
    $genre_lenght = count($genres);
    while($count = $response_l->fetch_assoc()){
       // echo $count["cod"]. "<br>";
       // $count_genre += 1;
       $select_book = "select * from livrosreg where cod = '".$count["cod"]."'";
       $res =  $con->query($select_book);
       while($count_again = $res->fetch_assoc()){
            $select_genre = "select * from livrosreg";
            $res_again = $con->query($select_genre);
            for($a = 0; $a < $genre_lenght; ++$a){
                if($count_again["genero"] == $genres[$a]){
                    $genres_count[$a] += 1;
                
                }
            }
            // echo mysqli_num_rows($res_again);
            
                // echo $count_again["genero"]. "= ". mysqli_num_rows($res_again). "<br>";
            
       }
       // echo $res->fetch_assoc()["genero"]. "<br>";
    }
    // for($i = 0; $i < $genre_lenght; ++$i){
    //     echo $genres[$i]."= ".$genres_count[$i];
    //     echo "<br>"; 
    // }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Genero', 'Quantidade'],
        <?php 
         for($i = 0; $i < $genre_lenght; ++$i){
            echo "['".$genres[$i]."',".$genres_count[$i]."],"; 
        } 
        ?>
        ])
        var options = {
          title: 'Gênero de livros mais vistos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
 <?php 
      for($i = 0; $i < $genre_lenght; ++$i){
        echo "['".$genres[$i]."',".$genres_count[$i]."],"; 
    } 
 ?>;
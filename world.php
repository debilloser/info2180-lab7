<?php
if($_SERVER["REQUEST_METHOD"] === "GET"){
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 if(isset($_GET['country']) && !empty($_GET['country'])){
        $country = "%".strip_tags($_GET['country'])."%";
        $query = $conn->prepare("SELECT * from countries WHERE name LIKE '%country%'");
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
		
		 if($result){
            echo  $result["name"]." is ruled by ".$result["head_of_state"];
        }else{
            echo "No Such Country";
        }
    }else if (isset($_GET['all']) && !empty($_GET['all']) && $_GET['all'] == "true"){

         $stmt = $conn->query("SELECT * FROM countries");

         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

         echo '<ul>';
         foreach ($results as $row) {
        echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';
    }
echo '</ul>';
}
}else {
	
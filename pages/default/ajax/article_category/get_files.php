<?php session_start();

$core = $_SESSION["CORE"];
$host = $_SESSION["HOST"];
$statics = $_SESSION["STATICS"];
$upload_folder = $_SESSION["UPLOAD_FOLDER"];

$dS = DIRECTORY_SEPARATOR;

$filesDirectory = $upload_folder.'category'.$dS.$_POST['id_produit'].$dS;


$nbr = 0;

if(file_exists($filesDirectory)){
	$images = "";
	
	foreach(scandir($filesDirectory) as $k=>$v){
		
		if($v <> "." and $v <> ".." and strpos($v, '.') !== false){
			
			$watermark = "<button class='btn btn-small btn-blue watermark category' value='". $filesDirectory.$v."'><i class='fas fa-sync'></i> Watermark</button>";
			if (strpos($v, 'watermark') !== false) { $watermark = ""; }
			
			$images .= "<div style='display:inline-block; margin:5px; text-align:center'>";
			$images .= "<img class='showImage' style='width:350px; height:auto; display:block' src='http://".$statics."category/".$_POST['id_produit']."/".$v."'>";	
			$images .= "<div class='btn-group'><button class='btn btn-small btn-default'><i class='fas fa-thumbtack'></i> Default</button><button class='btn btn-small btn-red delete_file category' value='". $filesDirectory.$v."'><i class='fas fa-trash-alt'></i> Supp.</button><button class='btn btn-small btn-orange rotate category' value='". $filesDirectory.$v."'><i class='fas fa-sync'></i> Rotate</button>".$watermark."</div>";
			$images .= "</div>";
			$nbr++;
		}

		

	}	
	echo $images;
}


if($nbr==0){
	
	echo '<div class="info info-success"><div class="info-success-icon"><i class="fas fa-info-circle"></i></div><div class="info-message">Aucun image pour ce produit ...</div></div>';
}
//var_dump(scandir($filesDirectory,1));



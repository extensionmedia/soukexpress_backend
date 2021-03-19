<?php session_start();

if(!isset($_SESSION['CORE'])){die();}
if(!isset($_POST['data'])){die();}


$table_name = $_POST['data']['t_n'];
$core = $_SESSION['CORE'];

if(file_exists($core.$table_name.".php")){
	require_once($core.$table_name.".php");
	$ob = new $table_name();
	
	$p_p = $_POST['data']['p_p'];
	$sort_by = $_POST['data']['sort_by'];
	$temp = explode(" ", $sort_by );
	
	$order = "";
	
	if(count( $temp ) > 1 ){ $order =  $temp[1]; }else{ $sort_by .= " DESC"; }

	$current = $p_p *  $_POST['data']['current'];
	$request =  $_POST['data']['request'];

	$conditions = array();
//var_dump($_POST['data']['filter']);
	if($request !== ""){$conditions["username like "] = "%".$request."%";}
	if(isset($_POST['data']['filter'])){
		foreach($_POST['data']['filter'] as $k=>$v){
			if($k === "category") $conditions["id_user_category ="] = $v;
			if($k === "course") $conditions["id_course ="] = $v;
			if($k === "status") $conditions["id_user_status ="] = $v;
		}
	}
//var_dump($conditions);
	
	if(empty($conditions)){
		$values = $ob->find(null,array("order"=>$sort_by,"limit"=>array($current,$p_p)),"v_user");
		$totalItems = $ob->getTotalItems();
	}else{
		if(count($conditions)>1){
			$totalItems = count($ob->find(null,array("conditions AND"=>$conditions,"order"=>$sort_by),"v_user"));
			$values = $ob->find(null,array("conditions AND"=>$conditions,"order"=>$sort_by,"limit"=>array($current,$p_p)),"v_user");			
		}else{
			$totalItems = count($ob->find(null,array("conditions"=>$conditions,"order"=>$sort_by),"v_user"));
			$values = $ob->find(null,array("conditions"=>$conditions,"order"=>$sort_by,"limit"=>array($current,$p_p)),"v_user");			
		}

	}
	
	
	
	
	$values = (is_null($values)? array(): $values);

	$returned = "<div class='info info-error'>Error DATA </div>";

	$returned = '<div class="col_12" style="padding: 0">';

	$returned .= '	<div style="display: flex; flex-direction: row">';
	$returned .= '		<div style="flex: auto; padding: 15px 0 10px 5px; margin: 0; color: rgba(118,17,18,1.00)">';
	$returned .= '			Total : ('.count($values).' / '.$totalItems.') <span class="current hide">'.$_POST['data']['current'].'</span>';
	$returned .= '		</div>';
	$returned .= '		<div style="width: 10rem">';
	$returned .= '		<div style="flex-direction: row; display: flex">';
	$returned .= '			<div style="flex: 1">';
	$returned .= '				<select id="showPerPage">';
	$returned .= '					<option value="20" ' . ( $p_p == 20 ? "selected" : "") .'>20</option>';
	$returned .= '					<option value="50" ' . ( $p_p == 50 ? "selected" : "") .'>50</option>';
	$returned .= '					<option value="100" ' . ( $p_p == 100 ? "selected" : "") .'>100</option>';
	$returned .= '					<option value="200" ' . ( $p_p == 200 ? "selected" : "") .'>200</option>';
	$returned .= '					<option value="500" ' . ( $p_p == 500 ? "selected" : "") .'>500</option>';
	$returned .= '				</select>';
	$returned .= '					<span class="hide ' . $order . '" id="sort_by">'.$sort_by.'</span>';
	$returned .= '			</div>';
	$returned .= '			<div style="flex: 1; text-align: center">';
	$returned .= '				<div class="btn-group">';
	$returned .= '					<a style="padding: 12px 12px" id="btn_passive_preview"  title="Précédent"><i class="fa fa-chevron-left"></i></a>';
	$returned .= '					<a style="padding: 12px 12px" id="btn_passive_next" title="Suivant"><i class="fa fa-chevron-right"></i></a>';
	$returned .= '				</div>';
	$returned .= '			</div>';
	$returned .= '		</div>';
	$returned .= '		</div>';
	$returned .= '	</div>';	

	$returned .= '	<div class="panel" style="overflow: auto;">';
	$returned .= '		<div class="panel-content" style="padding: 0">';

	$returned .= '			<table class="table">';
	$returned .= '				<thead>';
	$returned .= '					<tr>';

	$columns = $ob->getColumns();
	foreach($columns as $key=>$value){

		//$returned .=  "<th class='sort_by' data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
		if(isset($value["width"])){
			if($value["column"] === "facilities"){
				$returned .=  "<th style='width:" . $value["width"] . "' data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
			}elseif($value["column"] === "is_default"){
				$returned .= ($v[ $columns[$key]["column"] ] == 0)? "<td>-</td>": "<td>Par Défaut</td>";
			}else{
				$returned .=  "<th style='width:" . $value["width"] . "' class='sort_by' data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
			}

		}else{
			if($value["column"] === "facilities"){
				$returned .=  "<th data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
			}elseif($value["column"] === "contact"){
				$returned .=  "<th data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
			}else{
				$returned .=  "<th class='sort_by' data-sort='" . $value["column"] . "'>" . $value["label"] . "</th>";
			}

		}
	}
	$returned .= '					<th style="width:55px"></th>';
	$returned .= '					</tr>';
	$returned .= '				</thead>';
	$returned .= '				<tbody>';


	$content = '<div class="info info-success"><div class="info-success-icon"><i class="fa fa-info" aria-hidden="true"></i> </div><div class="info-message">Liste vide ...</div></div>';
	$i = 0;
	foreach($values as $k=>$v){
		
		$color = "";
			if($v["reste"] < 0){
				$color = "style='background-color:#FFCDD2'";
		}
			
		
		$returned .= '					<tr '.$color.' class="edit_ligne" data-page="'.$table_name.'">';
								foreach($columns as $key=>$value){
									if(isset($v[ $columns[$key]["column"] ])){

										if($columns[$key]["column"] == "id"){
											$returned .= "<td><span class='id-ligne'>" . $v[ $columns[$key]["column"] ] . "</span></td>";
										}elseif($columns[$key]["column"] == "user_status"){
											if($v[ $columns[$key]["column"] ] == "Activé"){
												$returned .= "<td><div class='label label-green'>Activé</div></td>";
											}else{
												$returned .= "<td><div class='label label-red'>".$v[ $columns[$key]["column"] ]."</div></td>";
											}
												
										}elseif($columns[$key]["column"] == "first_name"){
												if( ! empty($v["notes"]) ){
													$returned .= "<td>" . $v[ $columns[$key]["column"] ] . " <span style='color:blue; font-size:12px'><i class='fas fa-info-circle'></i></span></td>";
												}else{
													$returned .= "<td>" . $v[ $columns[$key]["column"] ] . "</td>";
												}
										}elseif($columns[$key]["column"] == "course_name"){
												if($v["course_name"] !== "null"){
													$returned .= "<td><span style='font-size:16px'>" . $v["course_name"] . "</span></td>";
												}else{
													$returned .= "<td>aucun!</td>";
												}
										}else{

											$returned .= "<td>" . $v[ $columns[$key]["column"] ] . "</td>";
										}											
									}else{
										if($columns[$key]["column"] == "options"){
											$dataa = $ob->find(null,array("conditions"=>array("id_propriete="=>$v["id"])),"v_options_in_propriete"); 
											$returned .= "<td>";
											foreach($dataa as $m=>$n){
												$returned .= "<div style='margin:5px' class='label label-default'>" . $n["propriete_options"] . "</div>";
											}
											$returned .= "</td>";
										}elseif($columns[$key]["column"] == "contact"){
											$returned .= "<td>".$v['phone_1']."<br>".$v['phone_2']."</td>";
										}else{
											$returned .=  "<td></td>";
										}

									}


								}
		$returned .= "<td><button style='padding:3px 10px' data-page='".$table_name."' class='btn btn-red remove_ligne' value='".$v["id"]."'><i class='fas fa-trash-alt'></i></button></td>";
		$returned .= '					</tr>';
	$i++	;
	}
	if($i == 0){
		$returned .= "<tr><td colspan='" . (count($columns)+1) . "'>".$content."</td></tr>";
	}


	$returned .= '				</tbody>';
	$returned .= '			</table>';
	$returned .= '		</div>';
	$returned .= '	</div">';
	$returned .= '</div>';
	echo $returned;
}else{
	echo -1;
}
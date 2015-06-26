<!-- 
<?php
include_once '../../include_DBA.php';
include_once 'statistikTermine_const.php';
session_start();
$db = new DB_Con(DB_DEFAULT_CONF_FILE, true);
//var_dump($_SESSION);
try{
	$ma=$db->getMitarbeiter($_SESSION[SVNR]);
	if($ma != null){
		$admin = $ma->getAdmin();
		if($admin)
			$svnr=isset($_GET[SVNR])?$_GET[SVNR]:ALL_MA;
		else
			$svnr = $ma->getSvnr();
	}
	else
		throw new DB_Exception(401, "Kein Mitarbeiter zu Svnr ".$_SESSION[SVNR]." gefunden!", DB_ERR_VIEW_BAD_LOGIN);
}catch(DB_Exception $e){
	$output = "Fehler:asdf ".$e->getViewmsg();
}
//$svnr="1713270187";
if(isset($svnr)){
	if(isset($_GET[VON])&&$_GET[VON]!=""){
		try{
			$von = new DateTime($_GET[VON]);
			if(isset($_GET[BIS])&&$_GET[BIS]!="")
				$bis = new DateTime($_GET[BIS]);
			else{
				$bis = clone $von;
				$bis->modify("+".STD_DAYS." days");
			}
		}catch(Exception $e){
			$output = "Fehler: Falsches Datumformat!";
		}
	}
	else{
		if(isset($_GET[BIS])&&$_GET[BIS]!=""){
			try{
				$bis = new DateTime($_GET[BIS]);
				$von = clone $bis;
				$von->modify("-".STD_DAYS." days");
			}catch(Exceptin $e){
				$output = "Fehler: Falsches Datumformat!";
			}
		}
		else{
			$von=new DateTime();
			$von->setTimestamp(strtotime("monday this week"));
			$bis = clone $von;
			$bis->modify("+".STD_DAYS." days");
		}
	}
	
	if($svnr==ALL_MA)
		$abf = $db->selectQuery(DB_TB_ZEITTABELLE, DB_F_ZEITTABELLE_PK_ZEITSTEMPEL.", ".DB_F_ZEITTABELLE_DIENSTLEISTUNG.", ".DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP, DB_F_ZEITTABELLE_PK_ZEITSTEMPEL." BETWEEN \"".$von->format(DB_FORMAT_DATETIME)."\" AND \"".$bis->format(DB_FORMAT_DATETIME)."\"");
	else
		$abf = $db->selectQuery(DB_TB_ZEITTABELLE, DB_F_ZEITTABELLE_PK_ZEITSTEMPEL.", ".DB_F_ZEITTABELLE_DIENSTLEISTUNG.", ".DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP, DB_F_ZEITTABELLE_PK_MITARBEITER."=".$svnr." AND ".DB_F_ZEITTABELLE_PK_ZEITSTEMPEL." BETWEEN \"".$von->format(DB_FORMAT_DATETIME)."\" AND \"".$bis->format(DB_FORMAT_DATETIME)."\"");
	
	if($abf===false)
		$output = "Fehler: ".DB_ERR_VIEW_DB_FAIL;
	else{
		$auslastung = array();
		$gewohnheiten = array();
		$termine = array();
		// für debugging:
		//$lines = array();
		// --------------
		// erfrage anzeige und zähle auslastung und gewohnheiten
		// Wochentag:
		if(isset($_GET[ANZAUSLASTUNG])&&$_GET[ANZAUSLASTUNG]==ANZAUSLASTUNG_WEEK){
			while($row=mysqli_fetch_assoc($abf)){
				//array_push($lines, $row);
				$timestamp = new DateTime($row[DB_F_ZEITTABELLE_PK_ZEITSTEMPEL]);
	// 			if(!isset($termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]))
	// 				$termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]] = array();
	// 			array_push($termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]], $timestamp);
				$day = $timestamp->format(FORMAT_WEEK);
				if(!isset($auslastung[$day]))
					$auslastung[$day]=1;
				else 
					$auslastung[$day]++;
				if(!isset($gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]))
					$gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]=1;
				else
					$gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]++;				
			}
		}
		// Datum:
		else{
			while($row=mysqli_fetch_assoc($abf)){
				//array_push($lines, $row);
				$timestamp = new DateTime($row[DB_F_ZEITTABELLE_PK_ZEITSTEMPEL]);
				// 			if(!isset($termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]))
					// 				$termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]] = array();
					// 			array_push($termine[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG]."|".$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]], $timestamp);
				$day = $timestamp->format(FORMAT_DAY);
				if(!isset($auslastung[$day]))
					$auslastung[$day]=1;
				else
					$auslastung[$day]++;
				if(!isset($gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]))
					$gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]=1;
				else
					$gewohnheiten[$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG].CONCAT.$row[DB_F_ZEITTABELLE_DIENSTLEISTUNG_HAARTYP]]++;
			}
		}
		// errechne stunden von auslastung + mache fertiges anzeigearray
		foreach ($auslastung as $key=>$val)
			$auslastung[$key]=$val / 4;
			
		// errechne terminanzahl von gewohnheiten + mache fertiges anzeigearray
		$gewohnheiten_anz = array();
		foreach ($gewohnheiten as $key=>$val){
			$dlids = explode(CONCAT, $key);
			$dl = $db->getDienstleistung($dlids[0], $db->getHaartyp($dlids[1]));
			$gewohnheiten_anz[$dl->getName().ANZ_DIENSTLEISTUNG_HAARTYP_CONCAT.$dl->getHaartyp()->getBezeichnung()] = $val/($dl->getBenoetigteEinheiten()+$dl->getPausenEinheiten()); 
		}
		$var_dump_gewohnheiten = $gewohnheiten;
		$gewohnheiten = $gewohnheiten_anz;
// 		echo "\n\n\n\n";
// 		var_dump($auslastung);
// 		echo "\n\n\n\n";
// 		var_dump($gewohnheiten);
// 		echo "\n\n\n\n";
	}
	echo $output;
}
if($svnr != ALL_MA){
	$ma = $db->getMitarbeiter($svnr);
	$maName = $ma->getVorname()." ".$ma->getNachname();
}
?>
 -->
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
			<?php 
			$gewohnheiten_out = "";
			foreach ($gewohnheiten as $key=>$val)
				$gewohnheiten_out=$gewohnheiten_out."['".$key."', ".$val."],";
			$gewohnheiten_out = utf8_encode($gewohnheiten_out);
			echo substr($gewohnheiten_out, 0, strlen($gewohnheiten_out)-1);
			?>
                      
//          ['Mushrooms', 3],
//          ['Onions', 1],
//          ['Olives', 1],
//          ['Zucchini', 1],
//          ['Pepperoni', 2]
        ]);

        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Topping');
        data2.addColumn('number', 'Slices');
        data2.addRows([
			<?php 
			$auslastung_out = "";
			foreach ($auslastung as $key=>$val)
				$auslastung_out=$auslastung_out."['".$key."', ".$val."],";
			$auslastung_out = utf8_encode($auslastung_out);
			echo substr($auslastung_out, 0, strlen($auslastung_out)-1);
			?>
        ]);
        // Set chart options
        var options = {'title':<?php echo "'Kundengewohnheiten von ".$von->format(FORMAT_DAY)." bis ".$bis->format(FORMAT_DAY)."'";?>};
        var options2 = {legend: {position: 'none'}, 'title':<?php echo utf8_encode("'Auslastung ".($svnr==ALL_MA?ANZ_ALL_MA:"für ".$maName)." von ".$von->format(FORMAT_DAY)." bis ".$bis->format(FORMAT_DAY)."'");?>};
        
        //'width':400,
                       //'height':300
		var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_auslastung'));
        var chart = new google.visualization.PieChart(document.getElementById('chart_kundengewohnheiten'));
         
        chart.draw(data, options);
        chart2.draw(data2, options2);
      }
    </script>
  </head>
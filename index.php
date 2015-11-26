<?php

require_once 'DiskStatus.class.php';

try {
	$diskStatus = new DiskStatus('/');

	$freeSpace = $diskStatus->freeSpace();
	$totalSpace = $diskStatus->totalSpace();
	$usedSpace = $diskStatus->usedSpace();
	
	$freeSpaceRaw = $diskStatus->freeSpace(true);
	$totalSpaceRaw = $diskStatus->totalSpace(true);
	$usedSpaceRaw = $diskStatus->usedSpace(true);
	
	$barWidth = ($usedSpaceRaw*100)/$totalSpaceRaw;
	
	/////////////////////
	
	$wwwSpace = $diskStatus->getfolderSize("/var/www/html");
	

} catch (Exception $e) {
	echo 'Error ('.$e->getMessage().')';
	exit();
}

?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="assets/css/style.css" />
		<title>Disk Status</title>
	</head>
	<body>	
<div class="wrapper">	
					
			<img id="ssdLogo" src="assets/images/ssd-icon.png" alt="ssd-icon" width="" height="" />
			<div id="totalSpaceText">
				<div id="totalSpaceTitle">Spazio totale</div>
				<div id="totalSpaceValue"><?= $totalSpace ?></div>				
			</div>
						
			<div id="diskBar">
				<div id="usedBar" style="width: <?= $barWidth ?>%"></div>
			</div>  			  
			<div class="diskData" id="usedSpace">					
				<span class="dot" id="dotUsed"></span>
				<span class="diskDataTesto">
					<span class="diskDataTestoNome" >Usato</span>
					<span class="diskDataTestoValore"><?= $usedSpace ?></span>
				</span>					    
			</div>
			<div class="diskData" id="freeSpace">
				<span class="dot" id="dotFree"></span>
				<span class="diskDataTesto">
					<span class="diskDataTestoNome" >Disponibile</span>
					<span class="diskDataTestoValore"><?= $freeSpace ?></span>
				</span>				
			</div>
			
			
			<div style="height: 100px; clear: both"></div>

					
			<img id="ssdLogo" src="assets/images/www-icon.png" alt="ssd-icon" width="" height="" />
			<div id="totalSpaceText">
				<div id="totalSpaceTitle">Spazio /var/www</div>
				<div id="totalSpaceValue"><?= $wwwSpace ?></div>				
			</div>
						
			<div id="diskBar">
				<div id="usedBar" style="width: <?= $barWidth ?>%"></div>
			</div>  			  
			<div class="diskData" id="usedSpace">					
				<span class="dot" id="dotUsed"></span>
				<span class="diskDataTesto">
					<span class="diskDataTestoNome" >Usato</span>
					<span class="diskDataTestoValore"><?= $usedSpace ?></span>
				</span>					    
			</div>
			<div class="diskData" id="freeSpace">
				<span class="dot" id="dotFree"></span>
				<span class="diskDataTesto">
					<span class="diskDataTestoNome" >Disponibile</span>
					<span class="diskDataTestoValore"><?= $freeSpace ?></span>
				</span>				
			</div>
			
		</div>
	</body>
</html>
      
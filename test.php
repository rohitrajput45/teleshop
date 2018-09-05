function truckAgainstOrder($unitType, $quantity, $officeId, $ProductYD3Tonnage=0){
	
		
		if($unitType == TON){
			return getTrucksByTonnage($quantity, $officeId," `maxLoad_ton` ASC");
		}else{
			
			$objT = new Truck();
			$trucks = $objT->getTruckList(1, $officeId,0,0,0," `maxYD3Bed` ASC");
			//print_r($trucks);
			$deliveryTrucks = array();
			$maxYD3 = end($trucks)->maxYD3Bed;
			$trucks_required = ceil($quantity/$maxYD3);
			
			$temp_trucks = array();
			$newArray = array();
			//echo "<br>Total Tonnage = " . ($ProductYD3Tonnage*$quantity) . "<br>";
			
			for ($i = 1; $i <= $trucks_required; $i++){
				
				if ($i == $trucks_required) {
					//$deliveryYD3 = $quantity;
					$deliveryQuantity = $quantity;
					$deliveryWeight = ($ProductYD3Tonnage*$quantity);
					//array_push($temp_trucks, getTrucksByTonnage(($ProductYD3Tonnage*$quantity), $officeId));
					
				} else {
					$quantity = $quantity - $maxYD3;
					$deliveryQuantity = $maxYD3;
					$deliveryWeight = $maxYD3*$ProductYD3Tonnage;
					
					//array_push($temp_trucks, getTrucksByTonnage(($ProductYD3Tonnage*$deliveryWeight), $officeId));
				}
				
				foreach($trucks as $truck){
					//echo $deliveryWeight . " <=  " . $truck->maxLoad_ton ." && ". $deliveryQuantity . "<= " . $truck->maxYD3Bed . "<br>";
					
					if($deliveryQuantity<=$truck->maxYD3Bed ){
						
						if ($deliveryWeight <= $truck->maxLoad_ton ) {
							$temp_trucks[0] = $truck;
						} else {
							$temp_trucks = getTrucksByTonnage($deliveryWeight,$officeId, " `maxYD3Bed` ASC, `maxLoad_ton` ASC");
						}
						if (count($temp_trucks>0)){
							
							foreach($temp_trucks as $objtruck){
								array_push($deliveryTrucks, $objtruck);
							}
							
							break;
						}
					}
				}
				
				// print_r(array_slice($deliveryTrucks,0, count($deliveryTrucks)));
				
				
			}
			//print_r($deliveryTrucks);
			
			return  $deliveryTrucks;
		}
		
		//return $deliveryTrucks;
	
 }  // End of function
 
 function getTrucksByTonnage($weight, $officeId, $sortOrder){
	 	
		$objT = new Truck();
		
	 	$trucks = $objT->getTruckList(1, $officeId,0,0,0,$sortOrder);
			
			$deliveryTrucks = array();
			$maxTonnage = end($trucks)->maxLoad_ton;
			$trucks_required = ceil($weight/$maxTonnage);
			
			for ($i = 1; $i <= $trucks_required; $i++){
				
				if ($i == $trucks_required) {
					$deliveryWeight = $weight;
				} else {
					$weight = $weight - $maxTonnage;
					$deliveryWeight = $maxTonnage;
				}
				
				
				foreach($trucks as $truck){
					
					if($deliveryWeight <= $truck->maxLoad_ton){
						array_push($deliveryTrucks, $truck);
						break;
					}
				}
				
			}
		
		return $deliveryTrucks;
			
  }
  <!-- get truck -->
  function getTruckList($status=-1, $officeId=0, $truckSizeId=0,  $sysUserId=0, $limit=0, $orderBy=' `id` DESC'){
		
		if($status != -1) 	$andClause 	= " AND status = '$status' ";
		if($truckSizeId) 	$andClause	.=	" AND `truckSizeId` = $truckSizeId ";
		if($officeId) 		$andClause	.=	" AND `officeId` = $officeId ";
		if($sysUserId) 		$andClause	.=	" AND `sysUserId` = $sysUserId ";
		if($limit) 			$limitClause = " LIMIT $limit" ; 
		
		$query 	= "SELECT `id` FROM  `w_truck` WHERE 1  $andClause  ORDER BY $orderBy $limitClause;";
		$sql	=	mysql_query($query);
		
		$Arr	=	array();
		
		while($res	=	mysql_fetch_assoc($sql)){
				
			$obj	=	new Truck($res['id']);	
			array_push($Arr, $obj);	
		}
		
		return $Arr;
		
	} // End of function
  <!-- get truck -->
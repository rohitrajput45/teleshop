<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Truck_model extends CI_Model {

    public function __construct() {
        parent::__construct();  
    }
	function truckAgainstOrder($unitType, $quantity, $officeId, $ProductYD3Tonnage=0,$areaId){
		/*echo "<pre>";
		echo $unitType;
		echo "<br>";
		echo $quantity;
		echo "<br>";
		echo $officeId;
		echo "<br>";
		echo $ProductYD3Tonnage;
		echo "<br>";
		die("truck");*/
		if($unitType != 10){
			return $this->getTrucksByTonnage($quantity, $officeId," maxLoad_ton","asc",$areaId);
		}else{
			$trucks = $this->getTruckList($officeId,"maxYD3Bed","asc",$areaId);
			
	/*	echo "<br>";
		print_r($trucks);
		echo "<br>";*/
		//die("truck");
			$deliveryTrucks 	= array();
			$maxYD3 			= end($trucks)->maxYD3Bed;
			$trucks_required 	= ceil($quantity/$maxYD3);
/*print_r($trucks_required);
		echo "<br>";
		die("truck");*/
			$temp_trucks 		= array();
			$newArray 			= array();
			for ($i = 1; $i <= $trucks_required; $i++){

				if ($i == $trucks_required) {
					//$deliveryYD3 = $quantity;
					$deliveryQuantity 	= $quantity;
					$deliveryWeight 	= ($ProductYD3Tonnage*$quantity);
					//array_push($temp_trucks, getTrucksByTonnage(($ProductYD3Tonnage*$quantity), $officeId));

				} else {
					$quantity 			= $quantity - $maxYD3;
					$deliveryQuantity 	= $maxYD3;
					$deliveryWeight 	= $maxYD3*$ProductYD3Tonnage;

				    //array_push($temp_trucks, getTrucksByTonnage(($ProductYD3Tonnage*$deliveryWeight), $officeId));
				}

				foreach($trucks as $truck){
					//echo $deliveryWeight . " <=  " . $truck->maxLoad_ton ." && ". $deliveryQuantity . "<= " . $truck->maxYD3Bed . "<br>";

					if($deliveryQuantity<=$truck->maxYD3Bed ){

						if ($deliveryWeight <= $truck->maxLoad_ton ) {
							$temp_trucks[0] = $truck;
						} else {
							$temp_trucks = $this->getTrucksByTonnage($deliveryWeight,$officeId, "maxYD3Bed","asc",$areaId);
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

	function getTrucksByTonnage($quantity, $officeId,$keyBy,$sortOrder,$areaId){
		
		$trucks = $this->getTruckList($officeId,$keyBy,$sortOrder,$areaId);
		
		$deliveryTrucks = array();
		$maxTonnage = end($trucks)->maxLoad_ton;
	
		$trucks_required = ceil($quantity/$maxTonnage);

		for ($i = 1; $i <= $trucks_required; $i++){

			if ($i == $trucks_required) {
				$deliveryWeight = $quantity;
			} else {
				$quantity = $quantity - $maxTonnage;
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
	} //End FUnction
 
	function getTruckList($officeId,$keyBy,$sortOrder,$areaId){ 
		$this->db->select('trucks.id as truckId,trucks.maxLoad_ton,trucks.truckClassId,trucks.maxYD3Bed')->from('trucks');
		$this->db->join('truckClass','truckClass.id =trucks.truckClassId');
		$this->db->join('deliveryManage','deliveryManage.truckClassId =truckClass.id');
		$this->db->where(array('trucks.status'=>1,'deliveryManage.status'=>1,'deliveryManage.areaId'=>$areaId,'deliveryManage.approval'=>1,'trucks.officeId'=>$officeId,'deliveryManage.officeId'=>$officeId));
		$this->db->order_by($keyBy,$sortOrder);
		$sql = $this->db->get();
	//echo $this->db->last_query();die;
		$Arr	=	array();
		if($sql->num_rows()):
			$Arr	= $sql->result();
		endif;
		return $Arr;

	} // End of function
	function costTruck($truckClassId,$distance,$officeId,$areaId){
		$total = 0;
		$dDistance 		= $this->deliveryDistance($truckClassId,$areaId,$officeId);
		$minDistance 	= $dDistance->minDistance;
		$maxDistance 	= $dDistance->maxDistance;
		$regularCost 	= $dDistance->regularCost;
		$extraMileCost 	= $dDistance->extraMileCost;
		if($distance <= $maxDistance){
			$total = $regularCost;
		}else{
			$exta 	= $distance-$maxDistance;
			$extraP = $exta*$extraMileCost;
			$total 	= $regularCost + $extraP;
		} 
		return $total;   
	}//ENd Function
	function deliveryDistance($classId,$areaId,$officeId){
        return $this->db->select('*')->where(array('areaId'=>$areaId,'truckClassId'=>$classId,'officeId'=>$officeId))->get('deliveryManage')->row();
    }//End Function
  
} //End CLass
/* End of file truck_model.php */
/* Location: ./application/models/truck_model.php */

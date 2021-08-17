<?php if (isset($data) && is_array($data) && count($data)>0 ):?>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


<?php 
$options=$options[$name];

//map field required options
$api_key=$options['api_key'];
$field_lat=$options['latitude'];
$field_lng=$options['longitude'];
$field_info=$options['loc_info'];

$location_info='';

$map_lat_lng=array();
foreach($data as $row){
  if(isset($row[$field_lat])){
    $map_lat_lng['lat']=$row[$field_lat];
  }
  if(isset($row[$field_lng])){
    $map_lat_lng['lng']=$row[$field_lng];
  }

  $location_info=$row[$field_info];
}

$field_name=str_replace(".","_",$name);

?>

<style>
.map{
			width: 100%;
			height: 400px;
}
</style>


<div class="field-map-container mt-2">
    <div class="xsl-caption field-caption"><?php echo t($name);?></div>
    <div class="map" id="<?php echo $field_name;?>" style="height:300px;background:gainsboro;"></div>
    <?php echo render_field('array',$name,$data,$options=array('hide_field_title'=>true));?>
</div>


<script>
  var map = L.map('<?php echo $field_name;?>').setView([<?php echo $map_lat_lng['lat'];?>, <?php echo $map_lat_lng['lng'];?>], 13);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);
	
	L.marker([<?php echo $map_lat_lng['lat'];?>, <?php echo $map_lat_lng['lng'];?>]).bindPopup('<?php echo $location_info;?>').addTo(map);
    
</script>


<?php endif;?>
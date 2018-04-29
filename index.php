<!--/////////////////////////////
// Written by: Ilan Patao //
// ilan@dangerstudio.com //
//////////////////////////-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AutoTrader REST API Example - Ilan Patao (2018)</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://autotrader-api.herokuapp.com/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://autotrader-api.herokuapp.com/css/mdb.min.css" rel="stylesheet">
    <!-- BST core CSS -->
    <link href="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.css" rel="stylesheet">
</head>

<body>


    <div class="container" style="margin-top:25px;">
        <div class="flex-center flex-column">
            <h1 class="animated fadeIn mb-4">AutoTrader REST API Example</h1>

            <h5 class="animated fadeIn mb-3">Written by: <a href="mailto:ilan@dangerstudio.com" style="text-decoration:none;">Ilan Patao</a> - 09/16/2017 (Updated 04/29/2018)</h5>

            <p class="animated fadeIn text-muted">AutoTrader updated their EP, with that the previous API code has been broken; thanks to tips from the community I went ahead and updated my code; this sample is a simple pull for 'Ford'; you can emulate any search with this code and up to every vehicle listing on AutoTrader in real-time. (includes owner, owner type, owner e-mails and contact number).</p>	
			

		<div class="table-responsive" id="results">
			<div class="sm-form" style="display:none;">
				<form name="vupdate" id="vupdate" method="post" enctype="multipart/form-data" action="">
				  <div class="form-row">
					<div class="col-auto">
					  <label class="sr-only" for="inlineFormInput">Make</label>
					  <input type="text" class="form-control mb-2 mb-sm-0" name="make" placeholder="Vehicle Make" value="">
					</div>
					<div class="col-auto">
					  <label class="sr-only" for="inlineFormInput">Modal</label>
					  <input type="text" class="form-control mb-2 mb-sm-0" name="model" placeholder="Vehicle Model" value="">
					</div>
					<div class="col-auto">
					  <label class="sr-only" for="inlineFormInput">Zipcode</label>
					  <input type="text" class="form-control mb-2 mb-sm-0" name="zipcode" placeholder="Zipcode" value="">
					</div>
					<div class="col-auto">
					  <button type="submit" class="btn btn-success">Update Vehicle</button>
					</div>
				  </div>
				</form>
			</div>
        <table id="table"
               data-toggle="table"
			   data-height="625"
			   data-page-size="100"
               data-show-columns="true"
               data-pagination="true"
               data-search="true" style="display:block;">
            <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="year" data-sortable="true">Year</th>
				<th data-field="make" data-sortable="true">Make</th>
				<th data-field="model" data-sortable="true">Model</th>
				<th data-field="trim" data-sortable="true">Trim</th>
				<th data-field="color" data-sortable="true">Color</th>
				<th data-field="miles" data-sortable="true">Miles</th>
				<th data-field="type" data-sortable="true">Type</th>
				<th data-field="vin" data-sortable="true">VIN</th>
				<th data-field="price" data-sortable="true">Price</th>
				<th data-field="owner" data-sortable="true">Owner</th>
				<th data-field="phone" data-sortable="true">Phone</th>
				<th data-field="email" data-sortable="true" data-visible="false">E-Mail</th>
            </tr>
            </thead>
				
			<?PHP
			// Get form info
			$make = strtoupper($_POST['make']);
			$model = strtoupper($_POST['model']);
			$zip = strtoupper($_POST['zipcode']);
			
			if (empty($make) || empty($model) || empty($zip)){
				$make = "NISSAN";
				$model = "LEAF";
				$zip = "11229";
			}
			// Make and loop through the request
			while($i <= 100) {
				$x = 0;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.autotrader.com/rest/searchresults/sunset/base?zip=11234&startYear=1981&numRecords=100000&sortBy=relevance&firstRecord=0&endYear=2019&modelCodeList=&makeCodeList=FORD&searchRadius=1000",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: c4df7277-e7dd-41d3-b110-c5d9f66203c6",
    "accept: */*",
    "accept-encoding: gzip, deflate, br",
    "accept-language: en-US,en;q=0.9",
    "authority: www.autotrader.com",
    "referer: https://www.autotrader.com/cars-for-sale/searchresults.xhtml?makeCodeList=FORD&modelCodeList=&zip=11229",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36"
  ),
));

$results = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
				// Decode json response and assign variables
				$jdata = json_decode($results);
				$avgprice = $jdata->averagePrice;
				$highprice = $jdata->highestPrice;
				$lowprice = $jdata->lowestPrice;
				$listcount = $jdata->matchListingCount;
				// Build the table rows
				foreach ($jdata->listings as $key){
					$color = $jdata->listings[$x]->colorExteriorSimple;
					$trim = $jdata->listings[$x]->trim;
					$price = $jdata->listings[$x]->derivedPrice;
					$image = $jdata->listings[$x]->imageURL;
					$id = $jdata->listings[$x]->listingId;
					$type = $jdata->listings[$x]->listingType;
					$miles = $jdata->listings[$x]->maxMileage;
					$oname = $jdata->listings[$x]->ownerName;
					$ophone = $jdata->listings[$x]->ownerPhone;
					$title = $jdata->listings[$x]->title;
					$vin = $jdata->listings[$x]->vin;
					$email = $jdata->listings[$x]->contactEmail;
					$ymm = explode(" ",$title);
					$year = $ymm[1];
					$make = $ymm[2];
					$model = $ymm[3];
					$x = $x + 1;
					
					echo "<tr>";
					echo "<td>" . $id . "</td>";
					echo "<td>" . $year . "</td>";
					echo "<td>" . $make . "</td>";
					echo "<td>" . $model . "</td>";
					echo "<td>" . $trim . "</td>";
					echo "<td>" . $color . "</td>";
					echo "<td>" . $miles . "</td>";
					echo "<td>" . $type . "</td>";
					echo "<td>" . $vin . "</td>";
					echo "<td>" . $price . "</td>";
					echo "<td>" . $oname . "</td>";
					echo "<td>" . $ophone . "</td>";
					echo "<td>" . $email . "</td>";
					echo "</tr>";
				}
				$i = $i + 100;
			}	
			
			?>

        </table>
		</div>
		

		
		<center>
				<p class="animated fadeIn text-muted">
					Discovered <b><?PHP echo $listcount; ?></b> vehicles for sale with the highest price of <b><?PHP echo $highprice; ?></b>, the lowest price of <b><?PHP echo $lowprice; ?></b> and the average vehicle is priced at <b><?PHP echo $avgprice; ?></b>.
				</p>
							
			<br>Written by: <a href="mailto:ilan@dangerstudio.com" style="text-decoration:none;">Ilan Patao</a> - 09/16/2017 (Updated 04/29/2018)
			
		</center>
        </div>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/mdb.min.js"></script>
    <!-- BST core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.js"></script>
</body>
<script>
$(document).ready(function(){
});
</script>
</html>

<!--/////////////////////////////
// Written by: Ilan Patao //
// ilan@dangerstudio.com //
//////////////////////////-->

<?PHP

require __DIR__ . '/vendor/autoload.php';

// Load Twig Template
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);
$template = $twig->load('index.html');

// Get form info
$make = strtoupper($_POST['make']);
$model = strtoupper($_POST['model']);
$zip = strtoupper($_POST['zipcode']);
$content = [];

if (empty($make) || empty($model) || empty($zip)) {
    $make = "NISSAN";
    $model = "LEAF";
    $zip = "11229";
}
// Make and loop through the request
while ($i <= 100) {
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
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36",
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
    foreach ($jdata->listings as $key) {
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
        $ymm = explode(" ", $title);
        $year = $ymm[1];
        $make = $ymm[2];
        $model = $ymm[3];
        $x = $x + 1;

        $entry = [
            "id" => $id,
            "year" => $year,
            "make" => $make,
            "model" => $model,
            "trim" => $trim,
            "color" => $color,
            "miles" => $miles,
            "type" => $type,
            "vin" => $vim,
            "price" => $price,
            "owner" => $oname,
            "phone" => $ophone,
            "email" => $email,
        ];

        array_push($content, $entry);
    }

    $i = $i + 100;

}

echo $twig->render('index.html', array('output' => $content));

?>

<?php
ini_set('max_execution_time', 6000);

require_once('vendor/autoload.php');
require_once('config.dist.php');



//Solr Configurations

// check solarium version available
/*
echo 'Solarium library version: ' . Solarium\Client::VERSION . ' - ';

// create a client instance
$client = new Solarium\Client($config);

// create a ping query
$ping = $client->createPing();

// execute the ping query
try {
    $result = $client->ping($ping);
    echo 'Ping query successful';
    echo '<br/><pre>';
    var_dump($result->getData());
    echo '</pre>';
} catch (Solarium\Exception $e) {
    echo 'Ping query failed';
}

//Add Documents
// get an update query instance
/*
$update = $client->createUpdate();
$doc = $update->createDocument();
$doc->id = 'TestID2';
$doc->name = 'JianWei2';

// add the document and a commit command to the update query
$update->addDocument($doc);
$update->addCommit();

    // this executes the query and returns the result
$result = $client->update($update);

echo '<b>Update query executed</b><br/>';
echo 'Query status: ' . $result->getStatus(). '<br/>';
echo 'Query time: ' . $result->getQueryTime();

*/

//Search Documents

////////////////////////////////////////////////////


//Crawler

$instagram = new InstagramScraper\Instagram();
  
	

	
$fp = fopen('outputRE.csv','a');
$data = [];


//Loop through ListOfRestaurant.xlsx and crawl data from Instagram Web
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("ListOfRestaurants.xlsx");

$worksheet = $spreadsheet->getActiveSheet();

$igAccount = [];
$noOfFollowers = [];
$restaurantType = [];
$count =0;
foreach ($worksheet->getRowIterator() as $row) {
	$count =0;

    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); 
    foreach ($cellIterator as $cell) {
		if($count==0){
			$igAccount[] = $cell;
		}
		if($count==1){
			$noOfFollowers[] = $cell;
		}
		if($count==2){
			$restaurantType[] = $cell;
		}	
			 $count++;
    }
}

for($counter=0;$counter<count($igAccount);$counter++){
$medias = $instagram->getMedias($igAccount[$counter],100);
$data = [];
foreach ($medias as $value) {
	$update = $client->createUpdate();
	$doc = $update->createDocument();
	
    $url = $value->getLink();							//Post Url
	$media = $instagram->getMediaByUrl($url);			//Post Image
    $media = $media->getImageHighResolutionUrl();
	$noOfLikes = $value->getLikesCount(); 				//No. Of Likes for the Post
	$noOfComments = $value->getCommentsCount();			//No. Of Comments
	$createTime = $value->getCreatedTime();				//DateTime of Post	
	$caption = $value->getCaption();					//Caption of the Post
	$caption = str_replace(",","-",$caption);
	$category = $restaurantType[$counter];				//Cuisine Category
	$account = $igAccount[$counter];					//Owner of the Instagram post
	$followers = $noOfFollowers[$counter];			
    $data[] = $url.','.$media.','.$noOfLikes.','.$noOfComments.','.$createTime.','
	.$caption.','.$category.','.$account.','.$followers;//Data of each Post

}
foreach ($data as $value) {
fputcsv($fp,explode(',', $value));
}

	}



fclose($fp);


echo "Done";
?>
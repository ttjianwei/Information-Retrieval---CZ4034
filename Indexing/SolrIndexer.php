<?php
ini_set('max_execution_time', 6000);

require_once('vendor/autoload.php');
require_once('config.dist.php');



//Solr Configurations

// check solarium version available

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


$row = 0;
$count = 0;

$handle = fopen("output.csv", "r");
while (($data = fgetcsv($handle, 10000, ","))
 !== FALSE) {
	$num = count($data);
	$update = $client->createUpdate();
	$doc = $update->createDocument();

      $row++;
     $doc->id = $count;
		 if($data[0]){
			 $doc->IGPost = $data[0]; 		//URL of Post
		 } 
		 if($data[1]){
			 $doc->IGPicture = $data[1];	//URL of Photo
		 }
		 if($data[2]){
			 $doc->Likes = $data[2];		//No. Of Likes of photo
		 }
		 if($data[3]){
			$doc->NoOfComments = $data[3]; 	//No. Of Comments for photo
			}
		if($data[4]){
			$doc->dateTime = $data[4];		//Date Time of Post
			}
		if($data[5]){
		$doc->Caption = $data[5];			//Caption of the photo
			}
		if($data[6]){
			$doc->Category = $data[6];		//Category of Cusine
		}
		if($data[7]){
			$doc->Account = $data[7];		//Restaurant's IG account username
		}
		if($data[8]){
			$doc->Followers = $data[8];		//Restaurant's IG account no. of followers
		}
        $update->addDocument($doc);
		$update->addCommit();

    // this executes the query and returns the result
		$result = $client->update($update);
		
		$count++;
      
}
echo 'Query status: ' . $result->getStatus(). '<br/>';
echo 'Query time: ' . $result->getQueryTime();
fclose($handle);


  
	


?>
<?php

ini_set('max_execution_time', 6000);

require_once('../vendor/autoload.php');
require_once('../config.dist.php');

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


$instagram = new InstagramScraper\Instagram();

//$fp = fopen('outputRE.csv','a');
$data = [];

$igAccount = $_POST["igAcc"];
$noOfPost = $_POST["igNumber"];



$query = $client->createQuery($client::QUERY_SELECT);

// this executes the query and returns the result
$resultset = $client->execute($query);



$count = ($resultset->getNumFound())+1;

$medias = $instagram->getMedias($igAccount,(int)$noOfPost);

echo "Added: <br>";

foreach ($medias as $value) {
	
	$update = $client->createUpdate();
	$doc = $update->createDocument();
	
	
    $url = $value->getLink();
	$media = $instagram->getMediaByUrl($url);
    $media = $media->getImageHighResolutionUrl();
	$noOfLikes = $value->getLikesCount();//filter 
	$noOfComments = $value->getCommentsCount();//filter by most comments
	$createTime = $value->getCreatedTime();
	$caption = $value->getCaption();
	$caption = str_replace(",","-",$caption);
	
		
		
		//echo $media.'<br>';
	
	$doc->id = $count;
	$doc->IGPost = $url;
	$doc->IGPhoto = $media;
	$doc->Likes = (int)$noOfLikes;
	$doc->NoOfComments =$noOfComments;
	$doc->dateTime = $createTime;
	$doc->Caption =$caption;
	$doc->Account = $igAccount;
    echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo $count;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $url;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $media;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $noOfLikes;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $noOfComments;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $createTime;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $caption;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $igAccount;
	echo '</td>';
	echo '</tr>';
	echo '</table><br>';	
		$update->addDocument($doc);
		$update->addCommit();

    // this executes the query and returns the result
		$result = $client->update($update);
		$count++;
	
}


?>
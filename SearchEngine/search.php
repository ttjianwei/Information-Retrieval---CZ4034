<?php
ini_set('max_execution_time', 6000);

require_once('../vendor/autoload.php');
require_once('../config.dist.php');



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

//Search Documents

$query = $client->createQuery($client::QUERY_SELECT);
$query->setQuery('Caption:(egg)');

// this executes the query and returns the result
$resultset = $client->select($query);

// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();
foreach ($resultset as $document) {

    echo '<hr/><table>';
    // the documents are also iterable, to get all fields
    foreach ($document as $field => $value) {
        // this converts multivalue fields to a comma-separated string
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
	if(($field!='_version_') && ($field!='name_str')){
        echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
	}
    }

    echo '</table>';
}

?>
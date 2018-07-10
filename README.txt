CZ4034 Information Retrieval 
Group 17

Author:
Huang Jian Wei
Ivan Teo Wei Jing
Lim Zi Yang
Yong Guo Jun
See Xin Yee

Note: 
Internet connection must be available to view images from the search engine.
If libraries does not work, install it using "composer install" with the composer.lock file
Crawling-> Indexing -> Classification should be performed sequentially.

Requirement:
PHP7
Apache Solr

Crawling set up:

Inside Xampp\htdocs folder, copy and paste these files:

In "Crawling" folder,
crawler.php
ListOfRestaurant.xlsx
outputFile.csv
config.dist.php

and 
"vendor" Folder.

Run crawler.php from localhost:portnumber/crawler.php. May take 2hr.
Result: outputFileRE.csv


Indexing:
Ensure that Apache Solr is installed and started up.
Create a core name "collection" and setup as required.
Once the core has been set up, replace "managed-schema.xml" from xampp\htdocs\solr-7.2.1\server\solr\collection\conf with the "managed-schema.xml" file in dropbox.
In addition, replace "stopwords.txt" from xampp\htdocs\solr-7.2.1\server\solr\collection with the "stopwords.txt" file in dropbox

Copy and paste outputFileRe.csv into xampp\htdocs and run "SolrIndexer.php" from localhost:portnumber/SolrIndexer.php
Result: Solr should be populated with documents


Run Search engine: 
Copy and paste out all files and folder in "SearchEngine" folder in dropbox and place them, in xampp/htdocs

Normal Search Engine 
Go to localhost:portnumber/index.php

Incremental Indexer
localhost:portnumber/incrementalIndex.php

Classification:
Open weka and load outputWeka(Category).csv and outputWeka(review).csv file respectively.


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>IG Search</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet prefetch' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
      <link rel="stylesheet" href="css/style.css">

<!--	<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			document.querySelectorAll('img').forEach(function(img){
				img.onerror = function(){this.src='https://upload.wikimedia.org/wikipedia/commons/e/e0/Deleted_photo.png';};
			})
		});
	</script>-->
</head>

<body>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<header class="mainH">
    <h1><i class="ion-social-instagram-outline"></i>Food Search <br> <span>[ Inspiration For Your Next Meal ]</span></h1>

	<div class="cover">
		<form class="flex-form" action="index.php" method="post">
			<label><i class="ion-search" style="color:black"></i></label>
		<input type="search" id="sv" name="sv" placeholder="Search Your Favorite Food!" >
		<input type="submit" id="sb">	
	</div>
	
			<center>
  <section class="filters">
	  <i class="ion-funnel"></i><label>&nbsp;Filters</label><br>	
	  
	  <div class="l1"><label><b>Type of Cuisine:</b></label><br>
	  
		  <input type="checkbox" name="cuisine[]" value="American" id="cbAmerican"><label for="cbAmerican">American</label>
		  <input type="checkbox" name="cuisine[]" value="Argentinian" id="cbArgentinian"><label for="cbArgentinian">Argentinian</label>
		  <input type="checkbox" name="cuisine[]" value="Asian" id="cbAsian"><label for="cbAsian">Asian</label>
		  <input type="checkbox" name="cuisine[]" value="Australian" id="cbAustralian"><label for="cbAustralian">Australian</label>
		  <input type="checkbox" name="cuisine[]" value="British" id="cbBritish"><label for="cbBritish">British</label>
		  <input type="checkbox" name="cuisine[]" value="Chinese" id="cbChinese"><label for="cbChinese">Chinese</label>
		  <input type="checkbox" name="cuisine[]" value="European" id="cbEuropean"><label for="cbEuropean">European</label><br>
		  <input type="checkbox" name="cuisine[]" value="French" id="cbFrench"><label for="cbFrench">French</label>
		  <input type="checkbox" name="cuisine[]" value="Greek" id="cbGreek"><label for="cbGreek">Greek</label>
		  <input type="checkbox" name="cuisine[]" value="Italian" id="cbItalian"><label for="cbItalian">Italian</label>
		  <input type="checkbox" name="cuisine[]" value="Japanese" id="cbJapanese"><label for="cbJapanese">Japanese</label>
		  <input type="checkbox" name="cuisine[]" value="Korean" id="cbKorean"><label for="cbKorean">Korean</label>
		  <input type="checkbox" name="cuisine[]" value="Mediterranean" id="cbMediterranean"><label for="cbMediterranean">Mediterranean</label>
		  <input type="checkbox" name="cuisine[]" value="Western" id="cbWestern"><label for="cbWestern">Western</label>
	  </div>


	  <div class="l1"><label >Minimum Likes:</label><br>
		  <input type="radio" name="numLikes" value="0" id="r0"><label for="r50">None</label>
		  <input type="radio" name="numLikes" value="50" id="r50"><label for="r50">50</label>
		  <input type="radio" name="numLikes" value="100" id="r100"><label for="r100">100</label>
		  <input type="radio" name="numLikes" value="150" id="r150"><label for="r150">150</label>
		  <input type="radio" name="numLikes" value="200" id="r200"><label for="r200">> 200</label>
	  </div>
	  
	  <div class="l1"><label >Sort by:</label><br>
	  <input type="radio" name="sortBy" value="date" id="sbDate"><label for="sbDate">Date (Most Recent to Least Recent)</label>
	  <input type="radio" name="sortBy" value="like" id="sbLike"><label for="sbLike">Popularity (Most Likes to Least Likes)</label>
	  </div>
	  
	  <div class="l1"><label>Results Returned:</label><br>
	  <select name="numResReturn">
	  <option value="20">20</option>
	  <option value="30">30</option>
	  <option value="40">40</option>
	  <option value="50">50</option>
	  </select>
	 
	  </div>
	  	  
  </section></form>
  </center>
</header>

  <?php
error_reporting(E_ALL ^ E_NOTICE); 
require 'process.inc';
require_once('../vendor/autoload.php');
require_once('config.dist.php');
ini_set('memory_limit','-1');
require_once('spell.php');
//echo $_POST["sv"];
$text = porterstemmer_process($_POST["sv"]);

/*$spell = new Spell();

$text=Spell::create()->check($text);*/

/*echo $text;*/




//$stopwords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
//$stopwords = array('a','the','more','than','their');
/*
foreach($stopwords as $stopword){
	
	$text = str_replace($stopword,"",$text);
}
echo $text;*/

function removeCommonWords($text){
 
 	// EEEEEEK Stop words
	$commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
 
	return preg_replace('/\b('.implode('|',$commonWords).')\s\b/','',$text);
}

$text = removeCommonWords($text);


if(!empty($_POST['cuisine'])) {
    foreach($_POST['cuisine'] as $checkCuisine) {
            //echo $checkCuisine; //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
						 
		$text= $text . ' ' . $checkCuisine;		 
    }
}

//split
$textArrays=explode(" ",$text);
//echo count($textArrays);
$queryBuilder = "";
$counter =0;

if (count($textArrays)>1){
	if(count($textArrays)!=2){
foreach($textArrays as $textArray){

	if($counter>0){
	$queryBuilder = $queryBuilder ." AND " . $textArray;
		}else{
			$queryBuilder  = $textArrays[0];
		}
	
		$counter++;
	
}
}
else {
	$queryBuilder = $textArrays[0] . " AND " . $textArrays[1];
}
}
else{
	$queryBuilder = $textArrays[0];
}

?>


<div id="searchHeader" style="background-color:#E5E5E5;visibility:hidden;text-align:center;">
<h2>Search Result for</h2><h1 id="searchValHeader"></h1>
<h4>Query executed in &nbsp;</h4><h4 class="p4" id="queryTime"><h4>&nbsp;seconds.</h4>
</div>

<script type="text/javascript">
var searchStr="<?php echo $text;?>";

if(searchStr){
document.getElementById("searchHeader").style.visibility="visible";

document.getElementById("searchValHeader").innerHTML=searchStr;

window.location.hash='searchHeader';
}

</script>

  <!--DISPLAY RESULT-->
<section class="gallery">


	<div class="row" id="resultGallery">
		<ul id="result">
			<a href="#" class="close"></a>
			<?php			
		
			if($queryBuilder){
			$client = new Solarium\Client($config);
			$query = $client->createSelect();
			
			$likes = 1;
			
			if (isset($_POST['numLikes'])) {

				// Show the radio button value, i.e. which one was checked when the form was sent
			$likes = (int)$_POST['numLikes'];	
			
			}
			
			$query->setQuery('Caption:('.$queryBuilder.') AND Likes:['.$likes.' TO 10000]');
			//$query->setQuery('Likes:['.(int)$_POST['numLikes'].' TO 10000]');
			//retrieve data
			$rows =$_POST['numResReturn'];
					
			$query->setRows($rows);
			if (isset($_POST['sortBy'])) {
				if($_POST['sortBy']=='like'){
					$query->addSort('Likes', $query::SORT_DESC);
				}else if
				($_POST['sortBy']=='date'){
					$query->addSort('dateTime', $query::SORT_DESC);
				}
  // Show the radio button value, i.e. which one was checked when the form was sent
			//$text2= $text2 . ' ' . $_POST['sortBy'];	
				}
			$executionStartTime = microtime(true);
			$resultset = $client->execute($query);
			$executionEndTime = microtime(true);
			$seconds = $executionEndTime - $executionStartTime;
			
			
			//$resultset = $client->select($query);
			//$mlt = $resultset->getMoreLikeThis();

			$likes = [];
			$cusines = [];
			$captions =[];
			$accounts = [];
			
		$countx = 0;
		
			// display the total number of documents found by solr
		//echo 'NumFound: '.$resultset->getNumFound();
		

		foreach ($resultset as $document) {

    // the documents are also iterable, to get all fields
	

    // the documents are also iterable, to get all fields
    foreach ($document as $field => $value) {
	
        // this converts multivalue fields to a comma-separated string
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
			
		if(($field=='Caption')){
			$captions[] = $value;
		}
		if(($field=='Account')){
			$accounts[] = $value;
		}
		if(($field=='Likes')){
			$likes[] = $value;
		}
		if(($field=='Category')){
			$cusines[] = $value;
		}
		
	if(($field=='IGphoto')){
		
        echo '<li><a href="#item01"><img height="200" width="200" id="'.$countx.'" class="imgRes" onerror="this.src=\'https://upload.wikimedia.org/wikipedia/commons/e/e0/Deleted_photo.png\';" src="' . $value . '"></a></li>';
		$countx++;
	}
	
    }   
			}
	
	$js_likes = json_encode($likes);
	$js_cuisines = json_encode($cusines);
	$js_captions = json_encode($captions);
	$js_accounts = json_encode($accounts);
	
	echo '<script type="text/javascript">';
	echo "var javascript_LikeArray = ". $js_likes . ";\n";
	echo "var javascript_CuisineArray = ". $js_cuisines . ";\n";
	echo "var javascript_CaptionArray = ". $js_captions . ";\n";
	echo "var javascript_AccountArray = ". $js_accounts . ";\n";
	echo "</script>";
			}
			?>
	<script type="text/javascript">
	document.getElementById("queryTime").innerHTML=<?php echo $seconds?>;
	
	</script>		
			
	</ul>

	</div> <!-- / row -->

	<div id="item01" class="port">

		<div class="row">
			<div class="description">
				<h1 id="detailIgName">Item 01</h1>
				<!--<div><p style="display: inline-block">Number of Likes:</p><p id="detailLike" style="display: inline-block">Number of likes</p></div>-->

				<p style="font-weight:bold">Number of Likes:</p><p id="detailLike"></p><br>
				<p style="font-weight:bold">Cuisine Type:</p><p id="detailCuisine"></p><br>
				<p style="font-weight:bold">Caption:</p><p id="detailCaption"></p>
			</div>
			<img id="imgResult">
		</div>
	</div>



	<!-- Item 01 -->
	<!--	<div id="item01" class="port">
	
		<div class="row">
			<div class="description">
				<h1>Item 01</h1>
				<p>Number of likes</p><p>Cuisine Type</p><p>Caption</p><p>#hashtag</p>
			</div>

				<img src="http://d13yacurqjgara.cloudfront.net/users/22177/screenshots/1379781/winterletters-jeremiahbritton-dribbble.png" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Image_deleted_logo.png/800px-Image_deleted_logo.png'">
			</div>
		</div> &lt;!&ndash; / row &ndash;&gt;-->

	<!-- Item 02 -->
	<!--<div id="item02" class="port">
	
		<div class="row">
			<div class="description">
				<h1>Item 02</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis libero erat. Integer ac purus est. Proin erat mi, pulvinar ut magna eget, consectetur auctor turpis.</p>
			</div>
			<img src="http://d13yacurqjgara.cloudfront.net/users/22177/screenshots/404704/wontstopblue-womens-jeremiahbritton.jpg" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Image_deleted_logo.png/800px-Image_deleted_logo.png'">
		</div> &lt;!&ndash; / row &ndash;&gt;

	</div> --><!-- / Item 02 -->

</section> <!-- / projects -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>

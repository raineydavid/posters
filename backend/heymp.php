<?php
$urlname = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Basic syntax checking
if((strlen($urlname)<5) || (substr(strtolower($urlname), 0, 5) != "/hey/")){
	header("HTTP/1.0 404 Not Found");
	echo "Not found.\n";
	die();
}
$urlname = substr($urlname, 5);  // For example, input will be "/hey/person-name"

// Check this is a valid MP
$mps = json_decode(file_get_contents(dirname(__FILE__) . '/mp-lookup-data-from-mp-postcards-without-member_name-titles.json'));
$thismp = null;
foreach ($mps as $mp){
	$checkname = preg_replace('/[^a-z]/', '-', strtolower(utf8_decode($mp->member_name)));
	if($checkname == $urlname){
		$thismp = $mp;
		break;
	}
}
if(is_null($thismp)){
	header("HTTP/1.0 404 Not Found");
	echo "Not found.\n";
	die();
}

list($firstname, $junk) = explode(" ", utf8_decode($thismp->member_name));
$fullname = utf8_decode($thismp->full_title);
$city = utf8_decode($thismp->constituency_name);
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-98374795-4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-98374795-4');
    </script>
    <title>Hey <?php echo $firstname?>! 🙋 from Best for Britain</title>
    <meta name="description" content="<?php echo $fullname?> needs to let us vote for Britain's future in Europe." />
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Hey <?php echo $firstname?>! 🙋 from Best for Britain">
    <meta itemprop="description" content="<?php echo $fullname?> needs to let us vote for Britain's future in Europe.">
    <meta itemprop="image" content="https://heymp.uk/heyimg/<?php echo $urlname;?>.png?t">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BestForBritain">
    <meta name="twitter:title" content="Hey <?php echo $firstname?>! 🙋 from Best for Britain">
    <meta name="twitter:description" content="<?php echo $fullname?> needs to let us vote for Britain's future in Europe.">
    <meta name="twitter:creator" content="@BestForBritain">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="https://heymp.uk/heyimg/<?php echo $urlname;?>.png?t">

    <!-- Open Graph data -->
    <meta property="og:title" content="Hey <?php echo $firstname?>! 🙋 from Best for Britain" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="https://heymp.uk/heyimg/<?php echo $urlname;?>.png?t" />
    <meta property="og:description" content="<?php echo $fullname?> needs to let us vote for Britain's future in Europe." />
    <meta property="og:site_name" content="Best For Britain" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/brands.css" integrity="sha384-BKw0P+CQz9xmby+uplDwp82Py8x1xtYPK3ORn/ZSoe6Dk3ETP59WCDnX+fI1XCKK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.9/jquery.autocomplete.js" integrity="sha384-eLQ7KKJ6W0gEOT57aZs0ADX6Wjdz0QEvkm8UsytG7G3IkJbSm6ovnpSeCpTsmV6u" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Staatliches|Roboto:300" rel="stylesheet" crossorigin="anonymous">
    <meta name="viewport" content="width=440,initial-scale=0.73,min-scale=0.73,max-scale=0.73,user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        font-family: 'Roboto', Arial, Sans;
        margin: 0;
        padding: 0;
        padding-top: 20px;
        text-align: center;
      }
      html{
        height: 100%;
        background-position: bottom right;
        background-repeat: no-repeat;
      } 
      h1, h2 {
        width: 330px;
        margin-left: auto;
        margin-right: auto;
      }
      h1 {
        font-family: 'Staatliches', cursive;
        font-size: 80px;
        margin-bottom: 10px;
      }
      h2 {
        font-weight: 300;
        color: #5d5d5d;
        margin-bottom: 40px;
      }
      input {
        font-family: 'Roboto', Arial, Sans;
        font-size: 26px;
        width: 300px;
        height: 40px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #f2f2f2;
      }
      a {
        text-decoration: none;
        color: black;
      }
      #container {
        width: 480px;
        margin-left: auto;
        margin-right: auto;
      }
      #mainImage {
      	width: 430px;
      	height: 304px;
      	box-shadow: 0 0 9px rgba(0, 0, 0, 0.4);
        border: none;
        border-radius: 6px;
      }
      .actionBtn {
      	font-size: 20px;
      	padding: 10px 20px;
      	border-radius: 28px;
      	border: 1px solid gray;
      	margin: 7px;
      	display: inline-block;
      	width: 350px;
      	text-align: left;
      }
      .actionBtn i {
      	width: 26px;
      }
      #elsewhere, #actions {
      	margin-top: 24px;
      }
      #elsewhere {
      	color: #525252;
      }
      #actionBtnDownload {
        color: white;
        background-color: red;
        border-color: red;
      }
      #actionBtnEmail {
        background-color: #e5e5e5;
      }
      #actionBtnTwitter {
        color: white;
      	background-color: #1da1f2;
      	border-color: #1da1f2;
      }
      #actionBtnFacebook {
      	color: white;
      	border-color: #3b5998;
        background-color: #3b5998;
      }
      #actionBtnFinalsay {
      	color: rgb(72, 72, 72);
      }
      #actionBtnFinalsay i {
      	color: rgb(237, 80, 81);
      }
      #actionBtnWhatsapp {
        color: white;
      	background-color: rgb(30, 190, 165);
      	border-color: rgb(30, 190, 165);
      }
      #actionBtnNew {
      	border-color: gray;
      	color: #525252;
      }
      .actionBtn:hover {
        opacity: 0.8;
      }
      #footer {
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
        width: 330px;
        color: #b4b4b4;
        font-size: 11px;
        padding: 10px;
        text-align: center;
      }
      #footer img {
        display: inline-block;
        margin-bottom: 10px;
        width: 90px;
        height: 31px;
        border: none;
      }
      #footer a {
        color: gray;
      }
    </style>
  </head>
  <body>
    <div id="container">
      <a href="/heyimg/<?php echo $urlname;?>.pdf?t"><img src="/heyimg/<?php echo $urlname;?>.jpg?t" id="mainImage"></a>
      <div id="actions">
	      <a class="actionBtn" href="/heyimg/<?php echo $urlname;?>.pdf?t" id="actionBtnDownload"><i class="fas fa-file-pdf"></i> Download &amp; print this as a poster</a><br>
<?php
if((isset($thismp->member_twitter)) && (strlen($thismp->member_twitter) > 1)){
	echo '<a class="actionBtn share" href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fheymp.uk%2Fhey%2F'.$urlname.'&hashtags=FBPE%2CHeyMP&text=Hey+%40'.$thismp->member_twitter.'+%F0%9F%99%8B+please+let+us+vote+on+Britain%27s+future+in+Europe%21" id="actionBtnTwitter"><i class="fab fa-twitter"></i> Tweet this to '.$firstname.'</a><br>';
} else {
	echo '<a class="actionBtn share" href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fheymp.uk%2Fhey%2F'.$urlname.'&hashtags=FBPE%2CHeyMP&text=Hey+'.$firstname.'+%F0%9F%99%8B+please+let+us+vote+on+Britain%27s+future+in+Europe%21" id="actionBtnTwitter"><i class="fab fa-twitter"></i> Share this on Twitter</a><br>';
}
?>
      <a class="actionBtn" href="mailto:<?php echo rawurlencode($thismp->member_email);?>?subject=Hey%20<?php echo rawurlencode($firstname);?>%20%F0%9F%99%8B...&body=Hey%20<?php echo rawurlencode($firstname);?>%2C%20please%20let%20me%20and%20everyone%20else%20in%20<?php echo rawurlencode($thismp->constituency_name);?>%20vote%20on%20Britain%27s%20future%20in%20Europe%21%20Many%20thanks%2C" id="actionBtnEmail"><i class="fas fa-envelope-open-text"></i> Send <?php echo $firstname;?> an email</a><br>
      <a class="actionBtn" href="https://finalsay.app" id="actionBtnFinalsay" target="_blank"><i class="fas fa-phone"></i> Voice message <?php echo $firstname;?> via Finalsay</a><br>
		  <a class="actionBtn share" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fheymp.uk%2Fhey%2F<?php echo $urlname;?>" id="actionBtnFacebook"><i class="fab fa-facebook"></i> Share this via Facebook</a><br>
      <a class="actionBtn share" href="https://wa.me/?text=Encourage+our+MP+<?php echo urlencode($firstname);?>+to+let+us+vote+%F0%9F%99%8B+on+Britain%27s+future+in+Europe%21+https%3A%2F%2Fheymp.uk%2Fhey%2F<?php echo $urlname;?>" id="actionBtnWhatsapp"><i class="fab fa-whatsapp"></i> Share this via Whatsapp</a><br>
		</div>
	  	<div id="elsewhere">
	  	Not living in <?php echo $thismp->constituency_name; ?>?<br>
		  <a class="actionBtn" href="/" id="actionBtnNew"><i class="fas fa-undo-alt"></i> Make one for your own MP now</a>
		</div>
    </div>
    <div id="footer"><a href="https://www.bestforbritain.org" target="_blank"><img src="/static/b4b.png" alt="Best for Britain"></a><br>
      A project by <a href="https://techforuk.com/" target="_blank">Tech For UK</a> for <a href="https://www.bestforbritain.org" target="_blank">Best For Britain</a>, promoted by Eloise Todd on behalf of Best for Britain, the campaign name of UK-EU OPEN POLICY LIMITED registered at International House, 24 Holborn Viaduct, London, EC1A 2BN. MP portrait images used under Creative Commons Attribution 3.0 Unported (CC BY 3.0) <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank">license</a>, retrieved from <a href="https://beta.parliament.uk/" target="_blank">beta.parliament.uk</a> and modified by removal of image background. <a href="https://www.bestforbritain.org/terms_of_use" target="_blank">Terms</a> | <a href="https://www.bestforbritain.org/privacy_policy" target="_blank">Privacy</a> | <a href="https://www.bestforbritain.org/cookies" target="_blank">Cookies</a>
    </div>
  <script type="text/javascript">
      $( document ).ready(function() {
        $('.share').click(function(e){
          e.preventDefault();
          window.open($(this).attr('href'),'Sharing...','width=555,height=400,location=no,menubar=no,toolbar=no');
        });
      });
    </script>
  </body>
</html>
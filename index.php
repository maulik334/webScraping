<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);

// // print_r(get_web_page("https://www.8commerce.com/"));
// // exit;

	use Phppot\DataSource;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
	require_once ('./vendor/autoload.php');
 	require('./simple_html_dom.php');
	require('./config.php');
    $resultStatus = false;
	function validate_phone_number($phone)
	{
		// Allow +, - and . in phone number
		$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		// Remove "-" from number
		$phone_to_check = str_replace("-", "", str_replace(".","",$filtered_phone_number));
		// Check the lenght of number
		// This can be customized if you want phone number from a specific country
		if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
			return false;
		} else {
			return true;
		}
	}

	function clear_text($s) {
		$do = true;
		while ($do) {
			$start = stripos($s,'<script');
			$stop = stripos($s,'</script>');
			if ((is_numeric($start))&&(is_numeric($stop))) {
				$s = substr($s,0,$start).substr($s,($stop+strlen('</script>')));
			} else {
				$do = false;
			}
		}
		return trim($s);
	}

	function get_web_page( $url ) {
		$res = array();
		$options = array( 
			CURLOPT_RETURNTRANSFER => true,     // return web page 
			CURLOPT_HEADER         => false,    // do not return headers 
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
			CURLOPT_USERAGENT      => "spider", // who am i 
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
			CURLOPT_TIMEOUT        => 120,      // timeout on response 
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
		); 
		$ch      = curl_init( $url ); 
		curl_setopt_array( $ch, $options ); 
		$content = curl_exec( $ch ); 
		$err     = curl_errno( $ch ); 
		$errmsg  = curl_error( $ch ); 
		$header  = curl_getinfo( $ch ); 
		curl_close( $ch ); 
		return $content; 
	} 

	if (isset($_POST["submit"])) {

        $dataType = $_POST["import"];
        if($dataType == 'true'){
        		$allowedFileType = [
        			'application/vnd.ms-excel',
        			'text/xls',
        			'text/xlsx',
        			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        		];
        	
        		if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        	
        			$targetPath = './uploads/' . $_FILES['file']['name'];
        			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        			$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        			$spreadSheet = $Reader->load($targetPath);
        			$excelSheet = $spreadSheet->getActiveSheet();
        			$spreadSheetAry = $excelSheet->toArray();
        			$sheetCount = count($spreadSheetAry);
                    
                    if($sheetCount > 1){
                        
                        unset($spreadSheetAry[0]);
                        
                        if(filter_var($spreadSheetAry[1][0], FILTER_VALIDATE_URL)) {
                            $sessionData11 = getdataFunc($spreadSheetAry);
                                
                                $sessionData = "";
                                if($sessionData11[0] != "<div class='alert alert-success'>Record updated successfully <br></div>"){
                                    $sessionData .= $sessionData11[0];
                                }
                                
                                if($sessionData11[1] != "<div class='alert alert-danger'>Record fail to add <br></div>"){
                                    $sessionData .= $sessionData11[1];
                                }
                            
                            
                            $resultStatus = true;
                            
                        }else{
                            $sessionData = "<div class='alert alert-danger'>Excel file is invalid, Please add data like below example file.</div>";
                        }
        			    
                    }else{
                        $sessionData = "<div class='alert alert-danger'>Excel file is Empty. Please upload Excel File with data.</div>";
                    }
        			unlink($targetPath);
        			
        		}else{
        			$sessionData = "<div class='alert alert-danger'>Invalid File Type. Upload Excel File.</div>";
        		} 
        }else{
            $dataLinks = $_POST['websiteLink'];
            $sessionData = getdataFunc($dataLinks);
            $sessionData = "";
            if($sessionData11[0] != "<div class='alert alert-success'>Record updated successfully <br></div>"){
                $sessionData .= $sessionData11[0];
            }
            
            if($sessionData11[1] != "<div class='alert alert-danger'>Record fail to add <br></div>"){
                $sessionData .= $sessionData11[1];
            }
            $resultStatus = true;
        }

	}

    
    function getdataFunc($linkArray){
            
            $successAlert = "<div class='alert alert-success'>Record updated successfully <br>";
            $errorAlert = "<div class='alert alert-danger'>Record fail to add <br>";
            
        	foreach($linkArray as $link){
			
						$currentlink = $link[0];

						$websiteContent = array(
							'link' => $currentlink,
							'phone' => '',
							'meta_description' => '',
							'home_html' => '',
							'meta_title' => '',
							'og_description' => '',
							'og_title' => ''
						);

						// $html = file_get_contents($link);
						$html = get_web_page($currentlink);
						
						if(@$html && $html != ''){
						    
        						libxml_use_internal_errors(true);
        						$page = new DOMDocument();
        						$page->preserveWhiteSpace = false;
        						$page->loadHTML($html);
        						$xpath = new DomXPath($page);
        
        						$websiteContent['home_html'] = $html;
        
        						$description = $xpath->evaluate('//meta[@name="description"]/@content')->item(0);
        						if(!empty(@$description)){
        							$websiteContent['meta_description'] = addslashes($description->value);
        						}
        
        						$html_title = $page->getElementsByTagName('title');
        						if ($html_title->length){
        							$websiteContent['meta_title'] = addslashes($html_title->item(0)->nodeValue);
        						}
        
        						$description = $xpath->evaluate('//meta[@property="og:description"]/@content')->item(0);
        						if(!empty(@$description)){
        							$websiteContent['og_description'] = addslashes($description->value);
        						}
        
        						$keywords = $xpath->evaluate('//meta[@property="og:title"]/@content')->item(0);
        						if(!empty(@$keywords)){
        							$websiteContent['og_title'] = addslashes($keywords->value);
        						}
        
        						$socialLinks = array();
        						$fbLinks = $xpath->query('//a[contains(@href, "facebook.com")]|//a[contains(@href, "instagram.com")]|//a[contains(@href, "youtube.com")]|//a[contains(@href, "twitter.com")]|//a[contains(@href, "linkedin.com")]');
        						
        						foreach($fbLinks as $fblink) {
        							$currentLink = rtrim($fblink->getAttribute("href"),"/"); 
        							if(!in_array($currentLink, $socialLinks)){
        								$socialLinks[] = $currentLink;	
        							}
        						}
        
        						$socialLinks = json_encode($socialLinks);
        						
        
        						$body = array();
        						preg_match("/<body[^>]*>(.*?)<\/body>/is", $html, $body);
        
        					
        						$simpleHTML = preg_replace("/<script[^>]*>(.*?)<\/script>/is", " ", $body[0]);
        						$simpleHTML = preg_replace("/<style[^>]*>(.*?)<\/style>/is", " ", $simpleHTML);
        						$simpleHTML = preg_replace("/<link[^>]*>/is", " ", $simpleHTML);
        						
        						$simpleHTML = strip_tags($simpleHTML);
        						// print_r($simpleHTML); exit;
        						$matches = $phoneNumberList = array();
        						preg_match_all('/(\+\d+)?\s*(\(\d+\))?([\s-]?\d+)+/',$simpleHTML,$matches);
        						
        						if(!empty(@$matches[0])){
        							$phonelist = $matches[0];
        							foreach($phonelist as $phoneNumber){
        								$tmpPhone = str_replace(' ', '', $phoneNumber);
        								if(validate_phone_number($tmpPhone)){
        									//check is date or not
        									$matches1 = array();
        									preg_match_all('/\d{4}\-\d{2}\-\d{2}/',$phoneNumber,$matches1);
        									if(COUNT($matches1[0]) == 0){
        										if(substr($tmpPhone,0,1) != '-'){
        											if(!in_array(trim($phoneNumber), $phoneNumberList)){
        												$phoneNumberList[] = trim($phoneNumber);
        											}
        										}
        									}
        
        								}
        							};
        						}
        
        						$telLink = $xpath->query('//a[contains(@href, "tel:")]');
        						foreach($telLink as $telNumber) {
        							if(!in_array(trim($telNumber->textContent),$phoneNumberList)){
        								$phoneNumberList[] = trim($telNumber->textContent);
        							}	
        						}
        
        
        						if(COUNT($phoneNumberList) > 0){
        							$websiteContent['phone'] = json_encode($phoneNumberList);
        						}
        
                                    
                                $currentLink = preg_replace( "#^[^:/.]*[:/]+#i", "", $websiteContent['link'] );
        						
        						$user_query_uri = $websiteContent['link'];
                                
                                $user_query_uri = trim($user_query_uri, '/');
                                if (!preg_match('#^http(s)?://#', $user_query_uri)) {
                                    $user_query_uri = 'http://' . $user_query_uri;
                                }
                                $urlParts = parse_url($user_query_uri);
                                $domain_name = preg_replace('/^www\./', '', $urlParts['host']);
        						
        						
        						$checkRecorde = "SELECT id FROM webcontent WHERE link LIKE '%".$domain_name."%' OR link='".$currentLink."' LIMIT 1";
        						$checkRecorderesult = mysqli_query($GLOBALS['connection'], $checkRecorde);
        						
        						if (mysqli_num_rows($checkRecorderesult) > 0) {
        						    
            						    $row1 = mysqli_fetch_assoc($checkRecorderesult);
            						    $linkId= $row1['id'];
            						    
            						    $sqlQuery = "UPDATE webcontent SET link='".$websiteContent['link']."',webHtml='".addslashes($websiteContent['home_html'])."',phone='".$websiteContent['phone']."',description='".$websiteContent['meta_description']."',meta_title='".$websiteContent['meta_title']."',og_description='".$websiteContent['og_description']."',og_title='".$websiteContent['og_title']."',socialLinks='".$socialLinks."' WHERE id=".$linkId;
            						     
                                        if (mysqli_query($GLOBALS['connection'], $sqlQuery)) {
                                          $successAlert .= "<div class='alert alert-success'>Old </div>";
                                        } else {
                                          $errorAlert .= $currentLink."<br/>";
                                        }
        						    
        						    
        						}else{
        						
                						$sql = "insert into webcontent (link, webHtml, phone, description, meta_title, og_description, og_title, socialLinks) VALUES ('".$websiteContent['link']."', '".addslashes($websiteContent['home_html'])."', '".$websiteContent['phone']."', '".$websiteContent['meta_description']."', '".$websiteContent['meta_title']."', '".$websiteContent['og_description']."', '".$websiteContent['og_title']."', '".$socialLinks."' )"; 
                				
                						if (mysqli_query($GLOBALS['connection'], $sql)) {
                							$successAlert .=  $currentLink."<br/>";
                						} else {
                							$errorAlert .= $currentLink."<br/>";
                						}
                						
        						}
                						
                						
			        }
						
			}
			
			$successAlert .= "</div>";
			$errorAlert .= "</div>";
			
			return [$successAlert, $errorAlert];

    }
    
    

	// if(isset($_POST['websiteLink']) && !empty(@$_POST['websiteLink'])){
	// 	$webList = $_POST['websiteLink'];
	// 	foreach($webList as $link){

	// 		$websiteContent = array(
	// 			'link' => $link,
	// 			'phone' => '',
	// 			'meta_description' => '',
	// 			'home_html' => '',
	// 			'meta_title' => '',
	// 			'og_description' => '',
	// 			'og_title' => ''
	// 		);

	// 		$html = file_get_contents($link);
	// 		libxml_use_internal_errors(true);
	// 		$page = new DOMDocument();
	// 		$page->preserveWhiteSpace = false;
	// 		$page->loadHTML($html);
	// 		$xpath = new DomXPath($page);

	// 		$websiteContent['home_html'] = $html;

	// 		// print_r($html); exit;

	// 		$description = $xpath->evaluate('//meta[@name="description"]/@content')->item(0);
	// 		if(!empty(@$description)){
	// 			$websiteContent['meta_description'] = addslashes($description->value);
	// 		}

	// 		$html_title = $page->getElementsByTagName('title');
    //         if ($html_title->length){
    //             $websiteContent['meta_title'] = addslashes($html_title->item(0)->nodeValue);
    //         }

	// 		// print_r($websiteContent['meta_title']);
	// 		// exit;

	// 		// $keywords = $xpath->evaluate('//meta[@name="keywords"]/@content')->item(0);
	// 		// if(!empty(@$keywords)){
	// 		// 	$websiteContent['meta_title'] = addslashes($keywords->value);
	// 		// }

	// 		$description = $xpath->evaluate('//meta[@property="og:description"]/@content')->item(0);
	// 		if(!empty(@$description)){
	// 			$websiteContent['og_description'] = addslashes($description->value);
	// 		}

	// 		$keywords = $xpath->evaluate('//meta[@property="og:title"]/@content')->item(0);
	// 		if(!empty(@$keywords)){
	// 			$websiteContent['og_title'] = addslashes($keywords->value);
	// 		}

	// 		$socialLinks = array();
	// 		$fbLinks = $xpath->query('//a[contains(@href, "facebook.com")]|//a[contains(@href, "instagram.com")]|//a[contains(@href, "youtube.com")]|//a[contains(@href, "twitter.com")]|//a[contains(@href, "linkedin.com")]');
			
	// 		foreach($fbLinks as $fblink) {
	// 			$currentLink = rtrim($fblink->getAttribute("href"),"/"); 
	// 			if(!in_array($currentLink, $socialLinks)){
	// 				$socialLinks[] = $currentLink;	
	// 			}
	// 		}

	// 		// if(COUNT($socialLinks) > 0){
	// 			$socialLinks = json_encode($socialLinks);
	// 		// }else{

	// 		// }

	// 		// print_r($socialLinks); 
	// 		// exit;


	// 		$body = array();
	// 		preg_match("/<body[^>]*>(.*?)<\/body>/is", $html, $body);

	// 		// $body = $page->getElementsByTagName('body')->item(0);
	// 		// $simpleHTML = $page->saveHTML($body);
	// 		// $simpleHTML = strtr($simpleHTML->nodeValue,"\"", "'");
	// 		// $simpleHTML = preg_replace('/\s+/', ' ', trim($simpleHTML));
	// 		// 
	// 		$simpleHTML = preg_replace("/<script[^>]*>(.*?)<\/script>/is", " ", $body[0]);
	// 		$simpleHTML = preg_replace("/<style[^>]*>(.*?)<\/style>/is", " ", $simpleHTML);
	// 		$simpleHTML = preg_replace("/<link[^>]*>/is", " ", $simpleHTML);
			 
	// 		$simpleHTML = strip_tags($simpleHTML);
	// 		// print_r($simpleHTML); exit;
	// 		$matches = $phoneNumberList = array();
	// 		preg_match_all('/(\+\d+)?\s*(\(\d+\))?([\s-]?\d+)+/',$simpleHTML,$matches);
			
	// 		if(!empty(@$matches[0])){
	// 			$phonelist = $matches[0];
	// 			foreach($phonelist as $phoneNumber){
	// 				$tmpPhone = str_replace(' ', '', $phoneNumber);
	// 				if(validate_phone_number($tmpPhone)){
	// 					//check is date or not
	// 					$matches1 = array();
	// 					preg_match_all('/\d{4}\-\d{2}\-\d{2}/',$phoneNumber,$matches1);
	// 					if(COUNT($matches1[0]) == 0){
	// 						if(substr($tmpPhone,0,1) != '-'){
	// 							if(!in_array(trim($phoneNumber), $phoneNumberList)){
	// 								$phoneNumberList[] = trim($phoneNumber);
	// 							}
	// 						}
	// 					}

	// 				}
	// 			};
	// 		}

	// 		$telLink = $xpath->query('//a[contains(@href, "tel:")]');
	// 		foreach($telLink as $telNumber) {
	// 			if(!in_array(trim($telNumber->textContent),$phoneNumberList)){
	// 				$phoneNumberList[] = trim($telNumber->textContent);
	// 			}	
	// 		}


	// 		if(COUNT($phoneNumberList) > 0){
	// 			$websiteContent['phone'] = json_encode($phoneNumberList);
	// 		}

			
	// 		$sql = "insert into webcontent (link, webHtml, phone, description, meta_title, og_description, og_title, socialLinks) VALUES ('".$websiteContent['link']."', '".addslashes($websiteContent['home_html'])."', '".$websiteContent['phone']."', '".$websiteContent['meta_description']."', '".$websiteContent['meta_title']."', '".$websiteContent['og_description']."', '".$websiteContent['og_title']."', '".$socialLinks."' )"; 
    
	// 		if (mysqli_query($GLOBALS['connection'], $sql)) {
	// 			$sessionData = "<div class='alert alert-success'>New record created successfully</div>";
	// 		} else {
	// 			$sessionData = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . mysqli_error($GLOBALS['connection']).'</div>';
	// 		}
			  
	// 	}

	// }

$base_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data scraper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  
body {
	font-family: Arial;
}
*:focus {
    outline: none;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
	border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
	padding: 5px 20px;
	font-size: 0.9em;
}

.tutorial-table {
	margin-top: 40px;
	font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
	background: #f0f0f0;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
	background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
	padding: 10px;
	margin-top: 10px;
	border-radius: 2px;
	display: none;
}

.success {
	background: #c7efd9;
	border: #bbe2cd 1px solid;
}

.error {
	background: #fbcfcf;
	border: #f3c6c7 1px solid;
}

div#response.display-block {
	display: block;
}

   .form-group{
	   position: relative;
   }
   .remove_button{
	   position: absolute;
	   right:-35px;
	   top:0px;
   }
   
   .input_form{
       width:calc(100% - 100px);
       margin:0px auto 15px;
   }
   
   
  .Or {
    font-family: sans-serif;
    margin: 50px auto;
    text-align: center;
    color: black;
    font-size: 20px;
    max-width: 100%;
    position: relative;
  } 
   
  .Or:before {
    content: "";
    display: block;
    width: calc(50% - 35px);;
    height: 1px;
    background: #1d1d1d;
    left: 0px;
    top: 50%;
    position: absolute;
  }
  
  .Or:after {
    content: "";
    display: block;
    width: calc(50% - 35px);
    height: 1px;
    background: #1d1d1d;
    right: 0px;
    top: 50%;
    position: absolute;
  }
   
   
   
  </style>
</head> 
<body>

<div class="">
  	<div class="col-sm-6 col-sm-offset-3">
  	     <br>
	     <h2 class="text-center">Scrape Website Data </h2>
	     <br>
	     
	     <div id="error"><?=@$sessionData; ?></div>	
	   	 <div class="outer-container">
	   	     <h4 class="text-center">Website Links</h4>
    		 <form method="post" name="filelist" action="<?=$base_url; ?>">
    			<div class="field_wrapper">
    				<input type="hidden" name="import" value="false" />
    				<div class="form-group input_form">
    					<input type="text" name="websiteLink[][]" class="form-control" required/>
    				</div>
    			</div>
    			<div class="text-center">
    				<button type="submit" name="submit" class="btn-submit">Submit</button>
    				<button type="button" class="btn-submit add_button" title="Add field">+ add field</button>
    			</div>
    		</form>
    	</div>
		
		<p style="text-align:center;" class="Or">OR</p>
		
		<h4 class="text-center">Choose Excel File</h4>
		<div class="outer-container">
			<form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
				<div style="display: flex;"> 
				    <input type="hidden" name="import" value="true" />
					<input type="file" name="file" id="file" style="width: calc(100%);" accept=".xls,.xlsx">
					<button type="submit" id="submit" name="submit" class="btn-submit">Submit</button>
				</div>
			</form>
		</div>
		<br>
		<p style="text-align:center;"><a href="./example.xlsx" download>Sample File</a></p>
	</div>
</div>


<?php if($resultStatus){ ?>
    
    <script>setTimeout(function(){
        window.location.href = "http://thepicab.com/linkedin/dataView.php"; 
    }, 1000); </script>
    
<?php } ?>

<script type="text/javascript">

$(document).ready(function(){
    var maxField = 50;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper'); 
    var fieldHTML = '<div class="form-group input_form"><input type="text" name="websiteLink[][]" class="form-control" value="" required/><a href="javascript:void(0);" class="remove_button"><img src="./sign-delete-icon.png"/></a></div>';
    var x = 1;
    
    $(addButton).click(function(){
        if(x < maxField){ 
            x++;
            $(wrapper).append(fieldHTML);
        }
    });
    
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); 
        x--;
    });
});
</script>

</body>
</html>

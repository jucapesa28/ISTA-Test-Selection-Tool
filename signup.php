<?php

//start the session
 	session_start();

//include any required libraries/classes
	require_once "Classes/Database.class.php";
	include 'library.php'; // include the library file
	
	//include email class
	require('Classes/class.phpmailer.php');
	require('Classes/class.smtp.php');

 	//check to see if already logged in, if so, re-direct to admin.php
	$error = '';	
		if (isset($_SESSION['username'])) {
		header("location: testselection.php");
		}

	//Cheking if the user is valid
	 function verifyUser($p_email)
		 {
				$db = new Database();
				$conn= $db->getConn();
				
				//$p_password = sha1($p_password);
				$stmt = $conn->prepare("select emailaddress from user where emailaddress=?");
				$stmt->bind_param("s",$p_email);
				if($stmt->execute()){
				$stmt->bind_result($v_email);
					while($stmt->fetch()){
						$status=true;
						$user=array('emailaddress'=>$v_email);		 
					}
				}
				$stmt->free_result();
				$stmt->close();
				
				if(empty($user))
				{
					$user=false;
				}
				else {
					$user=true;
				}
				
				return $user;
		 }
		 
		 //Send email confirmation to activate new user account
		function sendEmailConfirmation($se_emailaddress, $se_hash)
		 {
			 	$email = $se_emailaddress;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->SMTPAuth = true; // authentication enabled
				$mail->Host = "127.0.0.1";
				$mail->Port = 25; // or 587
				$mail->IsHTML(true);
				$mail->Username = "devtstis"; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = "knL1E1k8z0"; //Password for SMTP authentication
				$mail->SetFrom("ista@ista.org", "ISTA - Test Selection Tool"); //From address of the mail
				$mail->Subject = "ISTA | Account Activation"; //Subject od your mail
				$mail->AddAddress($email, "ISTA - New Member"); //To address who will receive this email
				$mail->MsgHTML("<b>Hello, Your ISTA account has been succesfully created.. </b><br/><br/>
				Please, go to the following link to activate your account: <a href='http://dev.tst.ista.org/login.php?key=" . $se_hash . "&email=" . $se_emailaddress . "' target='_blank'>http://dev.tst.ista.org</a><br /> Thanks!"); 
				
				$send = $mail->Send(); //Send the mails
		 }
		 
	/*Insert
		* Insert a new user by passing an array with the properties of the username
		* Ex: 
		*	$properties=array("username","email","password","user_type");
		*	add($properties)
		*/
		function register($emailaddress,$password,$companyname,$firstname,$lastname,$jobtitle,$country,$address,$city,$state,$zipcode,$phonenumber){
			$db = new Database();
			$conn= $db->getConn();
			$status = false;
			$hash = md5(uniqid(rand(), true));
			$isactive = "0";
			
			$stmt = $conn->prepare("insert into user (emailaddress,password,companyname,firstname,lastname,jobtitle,country,address,city,state,zipcode,phonenumber,isactive,hashcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssssssssss",$emailaddress,$password,$companyname,$firstname,$lastname,$jobtitle,$country,$address,$city,$state,$zipcode,$phonenumber,$isactive,$hash);			
			 if($stmt->execute()){
			 	$status = true;
			 }
			//release resources
			$stmt->free_result();
			$conn->close();
			
				//sending email confirmation to activate account
				sendEmailConfirmation($emailaddress, $hash);
				
				header("location: signupconfirmation.php");
				echo "<div class='success-validation'>*Your user account has been created succesfully.</div>";
		}

		if(isset($_POST['signup'])){
			$username = $_POST['emailaddress'];
			
			$user = verifyUser($username);
			
				//if user already exists, create error message
				if(!empty($user)){
					echo "<div class='error-validation'>*This email address is already taken. Please try a different one.</div>";
				}
				//if user doesn't exist, create new user
				else{
					
					//setting values
					$password=$_POST['password'];
					$emailaddress=$_POST['emailaddress'];
					$companyname=$_POST['companyname'];
					$firstname=$_POST['firstname'];
					$lastname=$_POST['lastname'];
					$jobtitle=$_POST['jobtitle'];
					$country=$_POST['country'];
					$address=$_POST['address'];
					$city=$_POST['city'];
					$state=$_POST['state'];
					$zipcode=$_POST['zipcode'];
					$phonenumber=$_POST['phonenumber'];
					
					//reagister user
					register($emailaddress,$password,$companyname,$firstname,$lastname,$jobtitle,$country,$address,$city,$state,$zipcode,$phonenumber);		
				}
			}
				
			//if missing information, create error message

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">

    <title>ISTA - Test Selection Tool</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure.css">

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/main-grid-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/main-grid.css">
    <!--<![endif]-->
  
  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/landing.css">
    <!--<![endif]-->
  
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

<script type="text/javascript" src="Scripts/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="Scripts/parsley.min.js"></script>
<script type="text/javascript" src="Scripts/parsley.extend.js"></script>

<style>
	.error-validation {
color: red;
border: solid 1px red;
padding: 10px;
margin-left: 160px;
margin-top: 20px;
max-width: 550px;
background: #ffd6d6;
float: right;
</style>

</head>
<body style="background: #00874f">>
	
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
    	
        <a class="pure-menu-heading" href="index.html"><img src="images/istalogo.jpg" alt="ISTA Logo" /></a>
    </div>
</div>

<div class="splash">	
		<form class="pure-form pure-form-stacked" id='signup' action='signup.php' method='post' parsley-validate>
		    <fieldset>
		    
		    <legend>	
			    <div style="color:#fff">
		    		<i class="fa fa-pencil fa-4x"></i><h2 style="color:#fff">Create your New Account</h2>
		    	</div>
		    	 <p class="splash-subhead">
	            	Use the form below to create a new account.
	        	</p>
        	</legend>
		        
		
		        <div class="pure-g">
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for="firstname">First Name*</label>
		                <input type='text' name='firstname' id='firstname' maxlength="50" parsley-required="true" placeholder="First Name" />
		            </div>
		
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for="lastname">Last Name*</label>
		                <input type='text' name='lastname' id='lastname' maxlength="50" parsley-required="true" placeholder="Last Name" />
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for="companyname">Company Name*</label>
		                <input type='text' name='companyname' id='companyname' maxlength="50" parsley-required="true" placeholder="Company Name" />
		            </div>
		
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='jobtitle'>Job Title*</label>
		                <input type='text' name='jobtitle' id='jobtitle' maxlength="50" parsley-required="true"  placeholder="Job Title"/>
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for="email">E-Mail*</label>
		                <input type='text' name='emailaddress' id='emailaddress' maxlength="50" parsley-trigger="change" parsley-required="true" parsley-type="email" placeholder="youremail@domain.com"/>
		            </div>
		
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='password'>Password*</label>
		                <input type='password' name='password' id='password' maxlength="50" parsley-required="true" parsley-trigger="keyup" parsley-rangelength="[6, 25]" placeholder="Password"/>
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='conf_password'>Confirm Password*</label>
		                <input type='password' name='conf_password' id='conf_password' maxlength="50" parsley-equalto="#password" parsley-required="true"  parsley-error-message="The password field must match the confirm password field" parsley-trigger="change" placeholder="Confirm Password" />
		            </div>
		
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='country'>Country*</label>
		                <select class="pure-input-1-2" name="country" id="country" style="width: 98%" parsley-required="true">
		                	<option value="">--Select a Country--</option>
                            <option value='Afghanistan'>Afghanistan</option>
                            <option value='Albania'>Albania</option>
                            <option value='Algeria'>Algeria</option>
                            <option value='American Samoa'>American Samoa</option>
                            <option value='Andorra'>Andorra</option>
                            <option value='Angola'>Angola</option>
                            <option value='Anguilla'>Anguilla</option>
                            <option value='Antarctica'>Antarctica</option>
                            <option value='Antigua and Barbuda'>Antigua and Barbuda</option>
                            <option value='Argentina'>Argentina</option>
                            <option value='Armenia'>Armenia</option>
                            <option value='Aruba'>Aruba</option>
                            <option value='Australia'>Australia</option>
                            <option value='Austria'>Austria</option>
                            <option value='Azerbaijan'>Azerbaijan</option>
                            <option value='Bahamas'>Bahamas</option>
                            <option value='Bahrain'>Bahrain</option>
                            <option value='Bangladesh'>Bangladesh</option>
                            <option value='Barbados'>Barbados</option>
                            <option value='Belarus'>Belarus</option>
                            <option value='Belgium'>Belgium</option>
                            <option value='Belize'>Belize</option>
                            <option value='Benin'>Benin</option>
                            <option value='Bermuda'>Bermuda</option>
                            <option value='Bhutan'>Bhutan</option>
                            <option value='Bolivia'>Bolivia</option>
                            <option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>
                            <option value='Botswana'>Botswana</option>
                            <option value='Bouvet Island'>Bouvet Island</option>
                            <option value='Brazil'>Brazil</option>
                            <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
                            <option value='Brunei Darussalam'>Brunei Darussalam</option>
                            <option value='Bulgaria'>Bulgaria</option>
                            <option value='Burkina Faso'>Burkina Faso</option>
                            <option value='Burundi'>Burundi</option>
                            <option value='Cambodia'>Cambodia</option>
                            <option value='Cameroon'>Cameroon</option>
                            <option value='Canada'>Canada</option>
                            <option value='Cape Verde'>Cape Verde</option>
                            <option value='Cayman Islands'>Cayman Islands</option>
                            <option value='Central African Republic'>Central African Republic</option>
                            <option value='Chad'>Chad</option>
                            <option value='Chile'>Chile</option>
                            <option value='China'>China</option>
                            <option value='Christmas Island'>Christmas Island</option>
                            <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
                            <option value='Colombia'>Colombia</option>
                            <option value='Comoros'>Comoros</option>
                            <option value='Congo'>Congo</option>
                            <option value='Congo, The Democratic Republic of The'>Congo, The Democratic Republic
                                of The</option>
                            <option value='Cook Islands'>Cook Islands</option>
                            <option value='Costa Rica'>Costa Rica</option>
                            <option value='Cote D Ivoire'>Cote D'ivoire</option>
                            <option value='Croatia'>Croatia</option>
                            <option value='Cuba'>Cuba</option>
                            <option value='Cyprus'>Cyprus</option>
                            <option value='Czech Republic'>Czech Republic</option>
                            <option value='Denmark'>Denmark</option>
                            <option value='Djibouti'>Djibouti</option>
                            <option value='Dominica'>Dominica</option>
                            <option value='Dominican Republic'>Dominican Republic</option>
                            <option value='Ecuador'>Ecuador</option>
                            <option value='Egypt'>Egypt</option>
                            <option value='El Salvador'>El Salvador</option>
                            <option value='Equatorial Guinea'>Equatorial Guinea</option>
                            <option value='Eritrea'>Eritrea</option>
                            <option value='Estonia'>Estonia</option>
                            <option value='Ethiopia'>Ethiopia</option>
                            <option value='Falkland Islands (Malvinas)'>Falkland Islands (Malvinas)</option>
                            <option value='Faroe Islands'>Faroe Islands</option>
                            <option value='Fiji'>Fiji</option>
                            <option value='Finland'>Finland</option>
                            <option value='France'>France</option>
                            <option value='French Guiana'>French Guiana</option>
                            <option value='French Polynesia'>French Polynesia</option>
                            <option value='French Southern Territories'>French Southern Territories</option>
                            <option value='Gabon'>Gabon</option>
                            <option value='Gambia'>Gambia</option>
                            <option value='Georgia'>Georgia</option>
                            <option value='Germany'>Germany</option>
                            <option value='Ghana'>Ghana</option>
                            <option value='Gibraltar'>Gibraltar</option>
                            <option value='Greece'>Greece</option>
                            <option value='Greenland'>Greenland</option>
                            <option value='Grenada'>Grenada</option>
                            <option value='Guadeloupe'>Guadeloupe</option>
                            <option value='Guam'>Guam</option>
                            <option value='Guatemala'>Guatemala</option>
                            <option value='Guinea'>Guinea</option>
                            <option value='Guinea-bissau'>Guinea-bissau</option>
                            <option value='Guyana'>Guyana</option>
                            <option value='Haiti'>Haiti</option>
                            <option value='Heard Island and Mcdonald Islands'>Heard Island and Mcdonald Islands</option>
                            <option value='Holy See (Vatican City State)'>Holy See (Vatican City State)</option>
                            <option value='Honduras'>Honduras</option>
                            <option value='Hong Kong'>Hong Kong</option>
                            <option value='Hungary'>Hungary</option>
                            <option value='Iceland'>Iceland</option>
                            <option value='India'>India</option>
                            <option value='Indonesia'>Indonesia</option>
                            <option value='Iran, Islamic Republic of'>Iran, Islamic Republic of</option>
                            <option value='Iraq'>Iraq</option>
                            <option value='Ireland'>Ireland</option>
                            <option value='Israel'>Israel</option>
                            <option value='Italy'>Italy</option>
                            <option value='Jamaica'>Jamaica</option>
                            <option value='Japan'>Japan</option>
                            <option value='Jordan'>Jordan</option>
                            <option value='Kazakhstan'>Kazakhstan</option>
                            <option value='Kenya'>Kenya</option>
                            <option value='Kiribati'>Kiribati</option>
                            <option value='Korea, Democratic Peoples Republic of'>Korea, Democratic People's Republic
                                of</option>
                            <option value='Korea, Republic of'>Korea, Republic of</option>
                            <option value='Kuwait'>Kuwait</option>
                            <option value='Kyrgyzstan'>Kyrgyzstan</option>
                            <option value='Lao Peoples Democratic Republic'>Lao People's Democratic Republic</option>
                            <option value='Latvia'>Latvia</option>
                            <option value='Lebanon'>Lebanon</option>
                            <option value='Lesotho'>Lesotho</option>
                            <option value='Liberia'>Liberia</option>
                            <option value='Libyan Arab Jamahiriya'>Libyan Arab Jamahiriya</option>
                            <option value='Liechtenstein'>Liechtenstein</option>
                            <option value='Lithuania'>Lithuania</option>
                            <option value='Luxembourg'>Luxembourg</option>
                            <option value='Macao'>Macao</option>
                            <option value='Macedonia, The Former Yugoslav Republic of'>Macedonia, The Former Yugoslav
                                Republic of</option>
                            <option value='Madagascar'>Madagascar</option>
                            <option value='Malawi'>Malawi</option>
                            <option value='Malaysia'>Malaysia</option>
                            <option value='Maldives'>Maldives</option>
                            <option value='Mali'>Mali</option>
                            <option value='Malta'>Malta</option>
                            <option value='Marshall Islands'>Marshall Islands</option>
                            <option value='Martinique'>Martinique</option>
                            <option value='Mauritania'>Mauritania</option>
                            <option value='Mauritius'>Mauritius</option>
                            <option value='Mayotte'>Mayotte</option>
                            <option value='Mexico'>Mexico</option>
                            <option value='Micronesia, Federated States of'>Micronesia, Federated States of</option>
                            <option value='Moldova, Republic of'>Moldova, Republic of</option>
                            <option value='Monaco'>Monaco</option>
                            <option value='Mongolia'>Mongolia</option>
                            <option value='Montserrat'>Montserrat</option>
                            <option value='Morocco'>Morocco</option>
                            <option value='Mozambique'>Mozambique</option>
                            <option value='Myanmar'>Myanmar</option>
                            <option value='Namibia'>Namibia</option>
                            <option value='Nauru'>Nauru</option>
                            <option value='Nepal'>Nepal</option>
                            <option value='Netherlands'>Netherlands</option>
                            <option value='Netherlands Antilles'>Netherlands Antilles</option>
                            <option value='New Caledonia'>New Caledonia</option>
                            <option value='New Zealand'>New Zealand</option>
                            <option value='Nicaragua'>Nicaragua</option>
                            <option value='Niger'>Niger</option>
                            <option value='Nigeria'>Nigeria</option>
                            <option value='Niue'>Niue</option>
                            <option value='Norfolk Island'>Norfolk Island</option>
                            <option value='Northern Mariana Islands'>Northern Mariana Islands</option>
                            <option value='Norway'>Norway</option>
                            <option value='Oman'>Oman</option>
                            <option value='Pakistan'>Pakistan</option>
                            <option value='Palau'>Palau</option>
                            <option value='Palestinian Territory, Occupied'>Palestinian Territory, Occupied</option>
                            <option value='Panama'>Panama</option>
                            <option value='Papua New Guinea'>Papua New Guinea</option>
                            <option value='Paraguay'>Paraguay</option>
                            <option value='Peru'>Peru</option>
                            <option value='Philippines'>Philippines</option>
                            <option value='Pitcairn'>Pitcairn</option>
                            <option value='Poland'>Poland</option>
                            <option value='Portugal'>Portugal</option>
                            <option value='Puerto Rico'>Puerto Rico</option>
                            <option value='Qatar'>Qatar</option>
                            <option value='Reunion'>Reunion</option>
                            <option value='Romania'>Romania</option>
                            <option value='Russian Federation'>Russian Federation</option>
                            <option value='Rwanda'>Rwanda</option>
                            <option value='Saint Helena'>Saint Helena</option>
                            <option value='Saint Kitts and Nevis'>Saint Kitts and Nevis</option>
                            <option value='Saint Lucia'>Saint Lucia</option>
                            <option value='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option>
                            <option value='Saint Vincent and The Grenadines'>Saint Vincent and The Grenadines</option>
                            <option value='Samoa'>Samoa</option>
                            <option value='San Marino'>San Marino</option>
                            <option value='Sao Tome and Principe'>Sao Tome and Principe</option>
                            <option value='Saudi Arabia'>Saudi Arabia</option>
                            <option value='Senegal'>Senegal</option>
                            <option value='Serbia and Montenegro'>Serbia and Montenegro</option>
                            <option value='Seychelles'>Seychelles</option>
                            <option value='Sierra Leone'>Sierra Leone</option>
                            <option value='Singapore'>Singapore</option>
                            <option value='Slovakia'>Slovakia</option>
                            <option value='Slovenia'>Slovenia</option>
                            <option value='Solomon Islands'>Solomon Islands</option>
                            <option value='Somalia'>Somalia</option>
                            <option value='South Africa'>South Africa</option>
                            <option value='South Georgia and The South Sandwich Islands'>South Georgia and The South
                                Sandwich Islands</option>
                            <option value='Spain'>Spain</option>
                            <option value='Sri Lanka'>Sri Lanka</option>
                            <option value='Sudan'>Sudan</option>
                            <option value='Suriname'>Suriname</option>
                            <option value='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option>
                            <option value='Swaziland'>Swaziland</option>
                            <option value='Sweden'>Sweden</option>
                            <option value='Switzerland'>Switzerland</option>
                            <option value='Syrian Arab Republic'>Syrian Arab Republic</option>
                            <option value='Taiwan, Province of China'>Taiwan, Province of China</option>
                            <option value='Tajikistan'>Tajikistan</option>
                            <option value='Tanzania, United Republic of'>Tanzania, United Republic of</option>
                            <option value='Thailand'>Thailand</option>
                            <option value='Timor-leste'>Timor-leste</option>
                            <option value='Togo'>Togo</option>
                            <option value='Tokelau'>Tokelau</option>
                            <option value='Tonga'>Tonga</option>
                            <option value='Trinidad and Tobago'>Trinidad and Tobago</option>
                            <option value='Tunisia'>Tunisia</option>
                            <option value='Turkey'>Turkey</option>
                            <option value='Turkmenistan'>Turkmenistan</option>
                            <option value='Turks and Caicos Islands'>Turks and Caicos Islands</option>
                            <option value='Tuvalu'>Tuvalu</option>
                            <option value='Uganda'>Uganda</option>
                            <option value='Ukraine'>Ukraine</option>
                            <option value='United Arab Emirates'>United Arab Emirates</option>
                            <option value='United Kingdom'>United Kingdom</option>
                            <option value='United States' selected="selected">United States</option>
                            <option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
                            <option value='Uruguay'>Uruguay</option>
                            <option value='Uzbekistan'>Uzbekistan</option>
                            <option value='Vanuatu'>Vanuatu</option>
                            <option value='Venezuela'>Venezuela</option>
                            <option value='Viet Nam'>Viet Nam</option>
                            <option value='Virgin Islands, British'>Virgin Islands, British</option>
                            <option value='Virgin Islands, U.S.'>Virgin Islands, U.S.</option>
                            <option value='Wallis and Futuna'>Wallis and Futuna</option>
                            <option value='Western Sahara'>Western Sahara</option>
                            <option value='Yemen'>Yemen</option>
                            <option value='Zambia'>Zambia</option>
                            <option value='Zimbabwe'>Zimbabwe</option>
                        </select>
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='address' >Address*</label>
		                <input type='text' name='address' id='address' maxlength="50" parsley-required="true" placeholder="Address"/>
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for="city" id="lblCity">City*</label>
		                <input type='text' name='city' id='city' maxlength="50" parsley-required="true" placeholder="City"/>
		            </div>
		            
		            <div id="stateContainer" class="pure-u-1 pure-u-med-1-2">
		                <label for="state">State*</label>
		                <select id="state" name="state" class="pure-input-1-2" style="width: 98%">
		                    <option value="">--Select State--</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
		                </select>
		            </div>
		
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='zipcode' id="lblZipcode">Zip Code*</label>
		                <input type='text' name='zipcode' id='zipcode' maxlength="5" parsley-required="true" parsley-trigger="change" parsley-type="digits" placeholder="Zip Code" />
		            </div>
		            
		            <div class="pure-u-1 pure-u-med-1-2">
		                <label for='phonenumber'>Phone Number*</label>
		                <input type='text' name='phonenumber' id='phonenumber' maxlength="50" parsley-required="true" parsley-trigger="change" parsley-type="phone" placeholder="555-444-1234" />
		            </div>
		            
		            
		            
		        </div>
		
		        <button type="submit" class="pure-button  pure-input-2-3 pure-button-primary btn-lg" style="margin-top: 30px; margin-bottom: 30px" name="signup">Submit</button>
		    </fieldset>
		</form>
</div>   


<div class="header" style="background: #00874f">
	
    <!--<div class="footer l-box is-center">
        View the source of this layout to learn more. Made with love by the YUI Team.
    </div>-->

</div>

<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    // This just makes sure that the href="#" attached to the <a> elements
    // don't scroll you back up the page.
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});

$( "#country" ).change(function() {
	
  var selectedCountry = $('#country :selected').text();
  
  if(selectedCountry === "United States")
  {
  	$('#lblCity').text('City*');
  	$('#city').attr("placeholder", "City");
  	$('#lblZipcode').text('Zip Code*');
  	$('#zipcode').attr("placeholder", "Zip Code");
  	$('#stateContainer').show();
  }
  else
  {
  	$('#lblCity').text('Province*');
  	$('#city').attr("placeholder", "Province");
  	$('#lblZipcode').text('Mail Code*');
  	$('#zipcode').attr("placeholder", "Mail Code");
  	$('#stateContainer').hide();
  }
});
</script>





</body>
</html>

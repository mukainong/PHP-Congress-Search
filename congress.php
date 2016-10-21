<html>
    <head>
        <title>Sample Form</title>
        
        <style>
            
            
            #phpTable {
                width:60%; 
                border-collapse: collapse;
                border: 1px solid black;
            }
            
            th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
            }
        </style>
        
        <script>
        
            function clearForm(){
                document.forms["myForm"].reset();
            
                document.getElementById("output").innerHTML = "";
                
                var select= document.forms["myForm"]["database"];
                select.selectedIndex=0;
                document.getElementById("keywordID").innerHTML = "Keyword*";
                document.forms["myForm"]["keyword"].value="";
//                document.forms["myForm"]["type"]["senate"].checked=true; 
//                document.forms["myForm"]["type"]["house"].checked=true; 
            }

        
            function validateForm() {
                var x = document.forms["myForm"]["database"].value;
                var y = document.forms["myForm"]["keyword"].value;
                
                var msg = "Please enter the following missing information:"
                var flag = false;
                
                var radios = document.forms["myForm"]["type"];
                var valid = false;
                
                if(x == "Select your option") {
                    //alert("You have to select a type in congress database");
                    flag = true;
                    msg += "Congress database ";
                    //return false;
                }
                
                if(y == "" || y == null) {
                    //alert("Keyword must be filled up");
                    flag = true;
                    msg += "Chamber type ";
                    //return false;
                }
                
                for(var i = 0; i < radios.length; i++){
				    if(radios[i].checked){
				        valid = true;
				        break;
				    }
                }
				if(!valid){ // neither of the temperature radio buttons was selected
				    //window.alert("Please choose a chamber type.");
                    flag = true;
                    msg += "Keyword ";
				    //return false;
				}
                
                if(flag) {
                    alert(msg);
                    return false;
                }
                else
                    return true;
            }
            
            function changeKeyword() {
                var x = document.forms["myForm"]["database"].value;
                if(x == "Select your option")
                    document.getElementById("keywordID").innerHTML = "Keyword*";
                if(x == "legislators")
                    document.getElementById("keywordID").innerHTML = "State/Representative*";
                if(x == "committees")
                    document.getElementById("keywordID").innerHTML = "Committee ID*";
                if(x == "bills")
                    document.getElementById("keywordID").innerHTML = "Bill ID*";
                if(x == "amendments")
                    document.getElementById("keywordID").innerHTML = "Amendment ID*";
            }
        </script>
        
    </head>
    
    <body>
        <center>
        <h1>Congress Infomation Search</h1>
            
        <form name="myForm" onsubmit="return validateForm()" method="POST" action="congress.php" style="border: 1px solid black; width: 22%">
            Congress Database <SELECT id="id1" name="database" onchange="changeKeyword()">
            <OPTION value = "Select your option"> Select your option </OPTION>
            <OPTION value = "legislators" <?php if((isset($_POST["database"]) && $_POST['database'] == "legislators")|| (isset($_GET["database"]) && $_GET['database'] == "legislators")) echo "selected";?>> Legislators</OPTION>
            <OPTION value = "committees" <?php if((isset($_POST["database"]) && $_POST['database'] == "committees")|| (isset($_GET["database"]) && $_GET['database'] == "committees")) echo "selected";?>> Committees </OPTION>
            <OPTION value = "bills" <?php if((isset($_POST["database"]) && $_POST['database'] == "bills")|| (isset($_GET["database"]) && $_GET['database'] == "bills")) echo "selected";?>> Bills </OPTION>
            <OPTION value = "amendments" <?php if((isset($_POST["database"]) && $_POST['database'] == "amendments")|| (isset($_GET["database"]) && $_GET['database'] == "amendments")) echo "selected";?>> Amendments </OPTION>
            </SELECT> 
                
                <br>
                Chamber
                <INPUT type=radio name="type" value="senate" <?php if((isset($_POST["type"]) && $_POST['type'] == "senate")|| (isset($_GET["type"]) && $_GET['type'] == "senate")) echo "checked";?> checked>Senate
                <INPUT type=radio name="type" value="house" <?php if((isset($_POST["type"]) && $_POST['type'] == "house")|| (isset($_GET["type"]) && $_GET['type'] == "house")) echo "checked";?>>House
                
                <br>
                
                <span id="keywordID">Keywords*</span> <INPUT id="id2" name="keyword" value="<?php if(isset($_POST["keyword"])) echo $_POST['keyword'];if(isset($_GET["keyword"])) echo $_GET['keyword'];?>"><BR>
                
                <script>changeKeyword();</script>
                    
                <INPUT type=submit name="submit" value="Search"> 
                <INPUT type=button value="Clear" onclick="clearForm()">
                <br>
                <a href="http://sunlightfoundation.com/"><u>Powered by Sunlight Foundation</u></a>
        </form>
        </center>
                
        <div id="output">            
                    
        <?php if(isset($_POST["submit"])): ?>
                    
        <?php 
            if($_POST['database'] == "legislators") {
                $api_url = "http://congress.api.sunlightfoundation.com/";
                $chamber = "chamber=";
                $state = "state=";
                $bioid = "bioguide_id=";
                $query = "query=";
                $apikey = "apikey=da7ece2a720a4ac6b432ee4cddeacc72";

                $parameter = "";
                
                switch (strtolower($_POST['keyword'])) {
                    case "alabama":
                        $parameter = "AL";
                        break;
                    case "alaska":
                        $parameter = "AK";
                        break;
                    case "arizona":
                        $parameter = "AZ";
                        break;
                    case "arkansas":
                        $parameter = "AR";
                        break;
                    case "california":
                        $parameter = "CA";
                        break;
                    case "colorado":
                        $parameter = "CO";
                        break;
                    case "connecticut":
                        $parameter = "CT";
                        break;
                    case "delaware":
                        $parameter = "DE";
                        break;
                    case "district of columbia":
                        $parameter = "DC";
                        break;
                    case "florida":
                        $parameter = "FL";
                        break;
                    case "georgia":
                        $parameter = "GA";
                        break;
                    case "hawaii":
                        $parameter = "HI";
                        break;
                    case "idaho":
                        $parameter = "ID";
                        break;
                    case "illinois":
                        $parameter = "IL";
                        break;
                    case "indiana":
                        $parameter = "IN";
                        break;
                    case "iowa":
                        $parameter = "IA";
                        break;
                    case "kansas":
                        $parameter = "KS";
                        break;
                    case "kentucky":
                        $parameter = "KY";
                        break;
                    case "louisana":
                        $parameter = "LA";
                        break;
                    case "maine":
                        $parameter = "ME";
                        break;
                    case "maryland":
                        $parameter = "MD";
                        break;
                    case "massachusetts":
                        $parameter = "MA";
                        break;
                    case "michigan":
                        $parameter = "MI";
                        break;
                    case "minnesota":
                        $parameter = "MN";
                        break;
                    case "mississippi":
                        $parameter = "MS";
                        break;
                    case "missouri":
                        $parameter = "MO";
                        break;
                    case "montana":
                        $parameter = "MT";
                        break;
                    case "nebraska":
                        $parameter = "NE";
                        break;
                    case "nevada":
                        $parameter = "NV";
                        break;
                    case "new hampshire":
                        $parameter = "NH";
                        break;
                    case "new jersey":
                        $parameter = "NJ";
                        break;
                    case "new mexico":
                        $parameter = "NM";
                        break;
                    case "new york":
                        $parameter = "NY";
                        break;
                    case "north carolina":
                        $parameter = "NC";
                        break;
                    case "north dakota":
                        $parameter = "ND";
                        break;
                    case "ohio":
                        $parameter = "OH";
                        break;
                    case "oklahoma":
                        $parameter = "OK";
                        break;
                    case "oregon":
                        $parameter = "OR";
                        break;
                    case "pennsylvania":
                        $parameter = "PA";
                        break;
                    case "rhode island":
                        $parameter = "RI";
                        break;
                    case "south carolina":
                        $parameter = "SC";
                        break;
                    case "south dakota":
                        $parameter = "SD";
                        break;
                    case "tennesse":
                        $parameter = "TN";
                        break;
                    case "texas":
                        $parameter = "TX";
                        break;
                    case "utah":
                        $parameter = "UT";
                        break;
                    case "vermont":
                        $parameter = "VT";
                        break;
                    case "virginia":
                        $parameter = "VA";
                        break;
                    case "washington":
                        $parameter = "WA";
                        break;
                    case "west virginia":
                        $parameter = "WV";
                        break;
                    case "wisconsin":
                        $parameter = "WI";
                        break;
                    case "wyoming":
                        $parameter = "WY";
                        break;
                }
                
                if($parameter != "")
                    $url = $api_url.$_POST['database']."?".$chamber.$_POST['type']."&".$state.$parameter."&".$apikey;
                else
                    $url = $api_url.$_POST['database']."?".$chamber.$_POST['type']."&".$query.$_POST['keyword']."&".$apikey;
                $json = file_get_contents($url);
                $obj = json_decode($json, true);
                
                if($obj['count'] < 1) {
                    echo "The API returned zero results for the request";
                }
                else {
                
                echo "<table align='center' id=\"phpTable\">";
            
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>State</th>";
                echo "<th>Chamber</th>";
                echo "<th>Details</th>";
                echo "</tr>";
                    
                $a = $obj["results"];
                $b = "congress.php?";    
                
                foreach($a as $x) {
                    echo "<tr>";
                    echo "<td>".$x["first_name"]." ".$x["last_name"]."</td>";
                    echo "<td>".$x["state_name"]."</td>";
                    echo "<td>".$x["chamber"]."</td>";
                    
                    $a1 = array(
                        'bioguide_id' =>  $x["bioguide_id"],
                        'title' => $x["title"],
                        'first_name' => $x["first_name"], 
                        'last_name' => $x["last_name"], 
                        'term_end' => $x["term_end"],
                        'website'=> $x["website"],
                        'office' => $x["office"],
                        'facebook_id' => $x["facebook_id"],
                        'twitter_id' => $x["twitter_id"],
                        'database' => $_POST['database'],
                        'type' => $_POST['type'],
                        'keyword' => $_POST['keyword']
                    );
                    
                    
//                    $url1="congress.php?view_details=legislators&bioguide_id=$x{'bioguide_id'}&title=$x->{'title'}&first_name=$x->{'first_name'}&last_name=$x->{'last_name'}&term_end=$x->{'term_end'}&website=$x->{'website'}&office=$x->{'office'}&facebook_id=$x->{'facebook_id'}&twitter_id=$x->{'twitter_id'}&database=$_POST['database']&type=$_POST['type']&keyword=$_POST['keyword']";
                   $paramStr = http_build_query($a1);
                    echo "<td><a href='congress.php?view_details=legislators&$paramStr'>View Details</a></td>";
                    
                    
//                    echo "<td><a href='"."congress.php?view_details=legislators&bioguide_id=".$x->{"bioguide_id"}."&title=".$x->{"title"}."&first_name=".$x->{"first_name"}."&last_name=".$x->{"last_name"}."&term_end=".$x->{"term_end"}."&website=".$x->{"website"}."&office=".$x->{"office"}."&facebook_id=".$x->{"facebook_id"}."&twitter_id=".$x->{"twitter_id"}."&database=".$_POST['database']."&type=".$_POST['type']."&keyword=".$_POST['keyword']."'>View Details</a></td>";
                    //echo "<td><a href='".congress.php?id=$x->{"last_name"}."'>View Details</a></td>";
                    //echo "<td><a href='".helper()."'>View Details</a></td>";
                    echo "</tr>";
                }
                    
                echo "</table>";
                }
            }
                    
            if($_POST['database'] == "committees") {
                $api_url = "http://congress.api.sunlightfoundation.com/";
                $committeeid = "committee_id=";
                $chamber = "chamber=";
                $apikey = "apikey=da7ece2a720a4ac6b432ee4cddeacc72";
                
                $url = $api_url.$_POST['database']."?".$committeeid.$_POST['keyword']."&".$chamber.$_POST['type']."&".$apikey;
                $json = file_get_contents($url);
                $obj = json_decode($json);
//                echo $url;
                
                if($obj->{"count"} < 1) {
                    echo "The API returned zero results for the request";
                }
                else {
                
                echo "<table align='center' id=\"phpTable\">";
            
                echo "<tr>";
                echo "<th>Committee ID</th>";
                echo "<th>Committee Name</th>";
                echo "<th>Chamber</th>";
                echo "</tr>";
                    
                $a = $obj->{"results"};
                    
                foreach($a as $x) {
                    echo "<tr>";
                    echo "<td>".$x->{"committee_id"}."</td>";
                    echo "<td>".$x->{"name"}."</td>";
                    echo "<td>".$x->{"chamber"}."</td>";
                    echo "</tr>";
                }
                    
                echo "</table>";
                
                }
            }
                    
            if($_POST['database'] == "bills") {
                $api_url = "http://congress.api.sunlightfoundation.com/";
                $billid = "bill_id=";
                $chamber = "chamber=";
                $apikey = "apikey=da7ece2a720a4ac6b432ee4cddeacc72";
                
                $url = $api_url.$_POST['database']."?".$billid.$_POST['keyword']."&".$chamber.$_POST['type']."&".$apikey;
                $json = file_get_contents($url);
                $obj = json_decode($json);
//                echo $url;
                
                if($obj->{"count"} < 1) {
                    echo "The API returned zero results for the request";
                }
                else {
                //echo $x->{"last_version"}->{"urls"}->{"pdf"} . "br/"
                echo "<table align='center' id=\"phpTable\">";
            
                echo "<tr>";
                echo "<th>Bill ID</th>";
                echo "<th>Short Title</th>";
                echo "<th>Chamber</th>";
                echo "<td>Details</td>";
                echo "</tr>";
                    
                $a = $obj->{"results"};
                    
                foreach($a as $x) {
                    echo "<tr>";
                    echo "<td>".$x->{"bill_id"}."</td>";
                    echo "<td>".$x->{"short_title"}."</td>";
                    echo "<td>".$x->{"chamber"}."</td>";
                    echo "<td><a href='"."congress.php?view_details=bills&bill_id=".$x->{"bill_id"}."&short_title=".$x->{"short_title"}."&introduced_on=".$x->{"introduced_on"}."&last_name=".$x->{"sponsor"}->{"last_name"}."&first_name=".$x->{"sponsor"}->{"first_name"}."&title=".$x->{"sponsor"}->{"title"}."&version_name=".$x->{"last_version"}->{"version_name"}."&last_action_at=".$x->{"last_action_at"}."&pdf=".$x->{"last_version"}->{"urls"}->{"pdf"}."&database=".$_POST['database']."&type=".$_POST['type']."&keyword=".$_POST['keyword']."'>View Details</a></td>";
                    echo "</tr>";
                }
                }
                echo "</table>";
            }
                    
            if($_POST['database'] == "amendments") {
                $api_url = "http://congress.api.sunlightfoundation.com/";
                $amendmentid = "amendment_id=";
                $chamber = "chamber=";
                $apikey = "apikey=da7ece2a720a4ac6b432ee4cddeacc72";
                
                $url = $api_url.$_POST['database']."?".$amendmentid.$_POST['keyword']."&".$chamber.$_POST['type']."&".$apikey;
//                echo $url;
                $json = file_get_contents($url);
                $obj = json_decode($json);
                
                if($obj->{"count"} < 1) {
                    echo "The API returned zero results for the request";
                }
                else {
                
                echo "<table align='center' id=\"phpTable\">";
            
                echo "<tr>";
                echo "<th>Amendment ID</th>";
                echo "<th>Amendment Type</th>";
                echo "<th>Chamber</th>";
                echo "<th>Introduced On</th>";
                echo "</tr>";
                    
                $a = $obj->{"results"};
                    
                foreach($a as $x) {
                    echo "<tr>";
                    echo "<td>".$x->{"amendment_id"}."</td>";
                    echo "<td>".$x->{"amendment_type"}."</td>";
                    echo "<td>".$x->{"chamber"}."</td>";
                    echo "<td>".$x->{"introduced_on"}."</td>";
                    echo "</tr>";
                }
                }
                echo "</table>";
            }
        ?>
                    
        <?php endif; ?>
                    
        <?php if(isset($_GET["view_details"])): ?>
                    
        <?php
            if($_GET["view_details"] == "legislators") {
                echo "<table align='center' id=\"phpTable\">";
            
                echo "<tr>";
                echo "<td colspan='2' style='text-aligh:center;'><img src=\"https://theunitedstates.io/images/congress/225x275/".$_GET["bioguide_id"].".jpg\"></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Full Name</td>";
                echo "<td>".$_GET["title"]." ".$_GET["first_name"]." ".$_GET["last_name"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Term ends on</td>";
                echo "<td>".$_GET["term_end"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Website</td>";
                echo "<td><a href=".$_GET["website"]." target='_blank'>".$_GET["website"]."</a></td>";
                echo "</tr>";
                    
                    
                echo "<tr>";
                echo "<td>Office</td>";
                echo "<td>".$_GET["office"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Facebook</td>";
                if($_GET["facebook_id"] == null)
                    echo "<td>N/A</td>";
                else
                    echo "<td><a href=https://www.facebook.com/".$_GET["facebook_id"]." target='_blank'>".$_GET["first_name"]." ".$_GET["last_name"]."</a></td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Twitter</td>";
                echo "<td><a href=https://twitter.com/".$_GET["twitter_id"]." target='_blank'>".$_GET["first_name"]." ".$_GET["last_name"]."</a></td>";
                echo "</tr>";
                    
                echo "</table>";
            
//            echo "<img src=\"https://theunitedstates.io/images/congress/225x275/".$_GET["bioguide_id"].".jpg\">";
            }
                    
            if($_GET["view_details"] == "bills") {
                echo "<table align='center' id=\"phpTable\">";
        
                echo "<tr>";
                echo "<td>Bill ID</td>";
                echo "<td>".$_GET["bill_id"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Bill Title</td>";
                echo "<td>".$_GET["short_title"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Sponsor</td>";
                echo "<td>".$_GET["title"]." ".$_GET["first_name"]." ".$_GET["last_name"]."</td>";
                echo "</tr>";
                    
                    
                echo "<tr>";
                echo "<td>Introduced On</td>";
                echo "<td>".$_GET["introduced_on"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Last action with date</td>";
                echo "<td>".$_GET["version_name"].", ".$_GET["last_action_at"]."</td>";
                echo "</tr>";
                    
                echo "<tr>";
                echo "<td>Bill URL</td>";
                echo "<td><a href=".$_GET["pdf"]." target='_blank'>".$_GET["short_title"]."</a></td>";
                echo "</tr>";
                    
                echo "</table>";
            
//            echo "<img src=\"https://theunitedstates.io/images/congress/225x275/".$_GET["bioguide_id"].".jpg\">";
            }
        ?>
                    
        <?php endif; ?>
                    
        </div>
    </body>
</html>
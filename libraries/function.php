<?php

require('libraries/connect.php');

/* Called function / function definition */
function GET_CHANGE_TO_UNICODES($str) {
    $strout     = '';
    $strchar    = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $strchar = substr($str, $i, 1);

        if     ($strchar == '1') { $strout .= '१'; }
        elseif ($strchar == '2') { $strout .= '२'; }
        elseif ($strchar == '3') { $strout .= '३'; }
        elseif ($strchar == '4') { $strout .= '४'; }
        elseif ($strchar == '5') { $strout .= '५'; }
        elseif ($strchar == '6') { $strout .= '६'; }
        elseif ($strchar == '7') { $strout .= '७'; }
        elseif ($strchar == '8') { $strout .= '८'; }
        elseif ($strchar == '9') { $strout .= '९'; }
        elseif ($strchar == '0') { $strout .= '०'; }
        else { $strout .= $strchar; }
    }
    return $strout;
}


function DAYNS($str) {    
    if     ($str == 'पञ्चमी') { $nextstr = 'षष्ठी'; }
    elseif ($str == 'षष्ठी') { $nextstr = 'सप्तमी'; }
    elseif ($str == 'सप्तमी') { $nextstr = 'अष्टमी'; }
    elseif ($str == 'अष्टमी') { $nextstr = 'नवमी'; }
    elseif ($str == 'नवमी') { $nextstr = 'दशमी'; }
    elseif ($str == 'दशमी') { $nextstr = 'एकादशी'; }
    elseif ($str == 'एकादशी') { $nextstr = 'द्वादशी'; }
    elseif ($str == 'द्वादशी') { $nextstr = 'त्रयोदशी'; }
    elseif ($str == 'त्रयोदशी') { $nextstr = 'चतुर्दशी'; }
    elseif ($str == 'चतुर्दशी') { $nextstr = 'औंसी'; }
    elseif ($str == 'औंसी') { $nextstr = 'प्रतिपदा'; }
    elseif ($str == 'प्रतिपदा') { $nextstr = 'द्वितीया'; }
    elseif ($str == 'द्वितीया') { $nextstr = 'तृतिया'; }
    elseif ($str == 'तृतिया') { $nextstr = 'चतुर्थी'; }
    elseif ($str == 'चतुर्थी') { $nextstr = 'पञ्चमी'; }
return $nextstr;
}


function LEDGER_ACCOUNT_COUNT($ac){
    $RET = 0;
    $qry = "SELECT COUNT(*) AS RET FROM ledger_accounts WHERE ac_code ='" . $ac . "'"; 

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}


function MERO_SERVICE_COUNT($no, $sid){
    $RET = 0;
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_service_log 
	    WHERE log_no='" . $no . "'
	    AND service_id ='" . $sid ."'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}

function MERO_TOTAL_COUNT($no){
    $RET = 0;
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_detail_log 
	    WHERE log_no='" . $no . "'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}

function MERO_BODY_LEAK($no){
    $RET = 0;
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_detail_log 
	    WHERE log_no='" . $no . "' AND body_leak_flag='Y'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}

function MERO_SERVICE_AMOUNT($no){
    $RET = 0;
    $qry = "SELECT SUM(service_amount) AS RET FROM item_complaint_service_log 
	    WHERE log_no='" . $no . "'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}



function MERO_SERVICE_ITEM_COUNT($no, $sid, $iid){
    $RET = 0;
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_added_log 
	    WHERE log_no='" . $no . "'
	    AND item_id ='" . $iid . "'	
	    AND service_id ='" . $sid ."'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}

function MERO_ITEM_AMOUNT($no){
    $RET = 0;
    $qry = "SELECT SUM(total_price) AS RET FROM item_complaint_added_log 
	    WHERE log_no='" . $no . "'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    return $RET;
}

function MERO_TAX_AMOUNT($no){
    $RET = 0;
    $RET1 = 0;
    $RET2 = 0;
	
    $qry = "SELECT SUM(tax_amount) AS RET FROM item_complaint_service_log 
	    WHERE log_no='" . $no . "'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET1 = $row['RET']; }

    $qry = "SELECT SUM(tax_amount) AS RET FROM item_complaint_added_log 
	    WHERE log_no='" . $no . "'";

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) { $RET2 = $row['RET']; }
    $RET = $RET1 + $RET2; 	

    return $RET;
}

   function jsonRemoveUnicodeSequences($response) {
      return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($response));
   } 


function NEW_CODE_ID($o){
    if($o == 'weather'){$qry = "SELECT MAX(log_no) + 1 AS RET FROM weather_data";}

    
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    if(strlen($RET) == 0) { $RET = "1001"; }
    return $RET;
}


function ROW_COUNT($o){
    if($o == 'vender'){$qry = "SELECT count(*) AS RET FROM vender_setup";}
    if($o == 'station'){$qry ="SELECT count(*) AS RET FROM  station_setup";}
    if($o == 'service') {$qry = "SELECT count(*) AS RET FROM service_setup";}
    if($o == 'role') {$qry = "SELECT count(*) AS RET FROM role_setup";}
    
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    if(strlen($RET) == 0) { $RET = 0; }
    return $RET;
}


function REF_ROWS($o, $id){
    if($o == 'vender'){$qry = "SELECT count(*) AS RET FROM item_complaint_log WHERE vender_id='" . $id . "'";}
    if($o == 'service') {$qry = "SELECT count(*) AS RET FROM item_complaint_service_log WHERE service_id='" . $id . "'";}
    if($o == 'station'){$qry ="SELECT count(*) AS RET FROM  service_setup WHERE station_id='" . $id . "'";}
    if($o == 'item'){$qry ="SELECT count(*) AS RET FROM  item_reference_detail WHERE item_id='" . $id . "'";}

    if($o == 'role') {$qry = "SELECT count(*) AS RET FROM user_setup WHERE role_id='" . $id . "'";}
    if($o == 'user') {$qry = "SELECT count(*) AS RET FROM user_setup WHERE login_id='" . $id . "'";}

    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    if(strlen($RET) == 0) { $RET = 0; }
    return $RET;
}


function NEW_TICKET_NO(){

    $qry = "SELECT lpad((max(substring(log_no,10,6))+1),6,'0') AS RET from item_complaint_log";
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) { $RET = $row['RET']; }
    if(strlen($RET) == 0) { $RET = "000001"; }
    $RET = date('Ymd') . "." . $RET; 	
    return $RET;

}

    function FETCH_FIELD($table, $description, $field, $value) {
        $RET = NULL;  
        $qry = "SELECT " . $description . " AS RET FROM " . $table . " WHERE " . $field . "='" . $value . "'"; 
        
        $stt = mysql_query($qry);

        while ($row = mysql_fetch_array($stt)) { 
            $RET = $row["RET"]; 
        } 
        if (strlen($RET)==0) { 
            $RET = Null; 
        } 
        return $RET;
    } 

function DESCRIPTION($o, $id){

    if($o == 'customer')  { $qry = "SELECT customer_edesc AS RET FROM customer_setup WHERE id=" . $id;}
    if($o == 'vender')  { $qry = "SELECT vender_edesc AS RET FROM vender_setup WHERE id=" . $id;}
    if($o == 'service') { $qry = "SELECT service_edesc AS RET FROM service_setup WHERE id=" . $id;}
    if($o == 'station') { $qry = "SELECT station_edesc AS RET FROM station_setup WHERE id=" . $id;}
    if($o == 'item') { $qry = "SELECT item_edesc AS RET FROM chart_of_items WHERE id=" . $id;}
    if($o == 'ignore') { $qry = "SELECT ignore_edesc AS RET FROM ignore_code WHERE id=" . $id;}
    if($o == 'role') { $qry = "SELECT role_edesc AS RET FROM role_setup WHERE id=" . $id;}
    if($o == 'user') { $qry = "SELECT user_ename AS RET FROM user_setup WHERE login_id='" . $id . "'";}

    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    if (strlen($RET) == 0) { $RET = null; }
    return $RET;
    
}


function PRE_DESCRIPTION($o, $pcode){

    $RET = 'ROOT LEVEL';

    if($o == 'item')  { $qry = "SELECT item_edesc AS RET FROM chart_of_items WHERE master_code='" . $pcode . "'";}
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    if (strlen($RET) == 0) { $RET = 'ROOT LEVEL'; }
    return $RET;
    
}


function PREV_PRE_CODE($o, $id){

    if($o == 'item')  { $qry = "SELECT pre_code AS RET FROM chart_of_items WHERE id ='" . $id . "'";}
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    if (strlen($RET) == 0) { $RET = ''; }
    return $RET;
    
}


function CHILD_COUNT($o, $mcode){
	
    if($o == 'item')  { $qry = "SELECT COUNT(*) AS RET FROM chart_of_items WHERE master_code LIKE '" . $mcode . ".%'";}
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    if (strlen($RET) == 0) { $RET = 0; }
    return $RET;
    
}

function INDIVIDUAL_CHILD_COUNT($o, $mcode){
	
    if($o == 'item')  { $qry = "SELECT COUNT(*) AS RET FROM chart_of_items WHERE master_code LIKE '" . $mcode . ".%' and group_flag='I'";}
    $rs = mysql_query($qry);
    
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    if (strlen($RET) == 0) { $RET = 0; }
    return $RET;
    
}


function NEW_MASTER_ID($o, $p) {

  $L = strlen($p) + 2;
  if ($o=='item') { 
     $qry = "SELECT LPAD((CONVERT(MAX(SUBSTR(MASTER_CODE, " . $L . ", 3)), signed) + 1),3,'0') AS RET FROM chart_of_items 
	     WHERE PRE_CODE ='" . $p . "'"; 
  } 

  $rs = mysql_query($qry);
  while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
  if (strlen($RET) == 0) { $RET = "001"; }
  $RET = $p . "." . $RET;	
  return $RET;

}       


function MY_TOTAL_JOB($LOG_NO){
    $RET = null;     
    $qry = "SELECT count(*) AS RET FROM item_complaint_service_log WHERE log_no='" . $LOG_NO . "'";
    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_COMPLETED_JOB($LOG_NO){
    $RET = null;     
    $qry = "SELECT count(*) AS RET FROM item_complaint_service_log WHERE log_no='" . $LOG_NO . "' AND progress=100";
    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function IS_SERVICE_CHECKED($LOG_NO, $SERIAL_NO, $SERVICE_ID){
    $RET = null;     
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_service_log 
	    WHERE log_no='" . $LOG_NO . "' 
	    AND serial_no = '" . $SERIAL_NO . "'	
	    AND service_id ='" . $SERVICE_ID . "'";

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function CHECKED_SERIAL_COUNT($LOG_NO){
    $RET = null;     
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_detail_log 
	    WHERE log_no='" . $LOG_NO . "'";

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function IS_SERVICE_ITEM_CHECKED($ID, $SERIAL_NO, $SERVICE_ID, $ITEM_ID) {
    $RET = null;     
    $qry = "SELECT COUNT(*) AS RET FROM item_complaint_added_log 
	    WHERE log_no='" . $ID . "' 
	    AND serial_no = '" . $SERIAL_NO . "'	
	    AND item_id ='" . $ITEM_ID . "'
	    AND service_id ='" . $SERVICE_ID . "'";
    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function SERVICE_ITEM_AMOUNT($ID, $SERIAL_NO, $SERVICE_ID, $ITEM_ID) {
    $RET = null;     
    $qry = "SELECT SUM(total_price) AS RET FROM item_complaint_added_log 
	    WHERE log_no='" . $ID . "' 
	    AND serial_no = '" . $SERIAL_NO . "'	
	    AND item_id ='" . $ITEM_ID . "'
	    AND service_id ='" . $SERVICE_ID . "'";
    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_SERVICE_AMOUNT($VENDER_ID, $SERVICE_ID, $FROM_DATE, $TO_DATE){
    $RET = 0;     
    $qry = "SELECT sum(b.service_amount) AS RET FROM item_complaint_log a, item_complaint_service_log b 
	    WHERE a.log_no = b.log_no 
	    AND a.vender_id ='" . $VENDER_ID . "' 
	    AND LEFT(a.log_date,10)>='" . $FROM_DATE . "'	
	    AND LEFT(a.log_date,10)<='" . $TO_DATE . "'
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_EXTRA_AMOUNT($VENDER_ID, $SERVICE_ID, $FROM_DATE, $TO_DATE){
    $RET = 0;     
    $qry = "SELECT sum(b.total_price) AS RET FROM item_complaint_log a, item_complaint_added_log b 
	    WHERE a.log_no = b.log_no 
	    AND a.vender_id ='" . $VENDER_ID . "' 
	    AND LEFT(a.log_date,10)>='" . $FROM_DATE . "'	
	    AND LEFT(a.log_date,10)<='" . $TO_DATE . "'
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_MONTHLY_SERVICE_AMOUNT($MONTH_ID, $SERVICE_ID){
    $RET = 0;     
    $qry = "SELECT sum(b.service_amount) AS RET FROM item_complaint_log a, item_complaint_service_log b 
	    WHERE a.log_no = b.log_no 
	    AND LEFT(a.log_date,7)='" . $MONTH_ID . "'
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_MONTHLY_EXTRA_AMOUNT($MONTH_ID, $SERVICE_ID){
    $RET = 0;     
    $qry = "SELECT sum(b.total_price) AS RET FROM item_complaint_log a, item_complaint_added_log b 
	    WHERE a.log_no = b.log_no 
	    AND LEFT(a.log_date,7)='" . $MONTH_ID . "'	
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_INDIVIDUAL_EXTRA_AMOUNT($LOG_NO, $SERVICE_ID, $SERIAL_NO){
    $RET = 0;     
    $qry = "SELECT sum(b.total_price) AS RET FROM item_complaint_log a, item_complaint_added_log b 
	    WHERE a.log_no = b.log_no 
	    AND a.log_no='" . $LOG_NO . "'	
	    AND b.serial_no = '" . $SERIAL_NO . "'	
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_INDIVIDUAL_TAX_AMOUNT($LOG_NO, $SERVICE_ID, $SERIAL_NO){
    $RET = 0;     
    $qry = "SELECT sum(b.tax_amount) AS RET FROM item_complaint_log a, item_complaint_added_log b 
	    WHERE a.log_no = b.log_no 
	    AND a.log_no='" . $LOG_NO . "'	
	    AND b.serial_no ='" . $SERIAL_NO . "'
	    AND b.service_id ='" . $SERVICE_ID . "'"; 

    $rs = mysql_query($qry);
   
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_VENDER_PAID($VENDER_ID) {
    $RET = 0;     
    $qry = "SELECT sum(received_amount) as RET from item_complaint_log WHERE vender_id='" . $VENDER_ID . "'"; 	
    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_VENDER_SERVICE_AMOUNT($VENDER_ID) {
    $RET = 0;     
    $qry = "SELECT sum(b.service_amount) as RET from item_complaint_log a, item_complaint_service_log b 
	    WHERE a.vender_id='" . $VENDER_ID . "'
	    AND a.log_no = b.log_no"; 	

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_VENDER_SERVICE_TAX($VENDER_ID) {
    $RET = 0;     
    $qry = "SELECT sum(b.tax_amount) as RET from item_complaint_log a, item_complaint_service_log b 
	    WHERE a.vender_id='" . $VENDER_ID . "'
	    AND a.log_no = b.log_no"; 	

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_SERVICE_COUNT($LOG_NO) {
    $RET = 0;     
    $qry = "SELECT count(distinct serial_no) as RET from item_complaint_service_log WHERE log_no='" . $LOG_NO . "'";
    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}

function MY_SERVICE_ITEM_COUNT($SERVICE_ID) {
    $RET = 0;     
    $qry = "SELECT count(*) as RET from service_item_setup WHERE service_id='" . $SERVICE_ID . "'";
    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_VENDER_ADDED_AMOUNT($VENDER_ID) {
    $RET = 0;     
    $qry = "SELECT sum(b.total_price) as RET from item_complaint_log a, item_complaint_added_log b 
	    WHERE a.vender_id='" . $VENDER_ID . "'
	    AND a.log_no = b.log_no"; 	

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


function MY_VENDER_ADDED_TAX($VENDER_ID) {
    $RET = 0;     
    $qry = "SELECT sum(b.tax_amount) as RET from item_complaint_log a, item_complaint_added_log b 
	    WHERE a.vender_id='" . $VENDER_ID . "'
	    AND a.log_no = b.log_no"; 	

    $rs = mysql_query($qry);
    while($row= mysql_fetch_array($rs)) {  $RET = $row['RET']; }
    return $RET;
}


    function to_words($number)
    {

    $decimalnumber = $number - floor($number);
    $number = floor($number);
    $length = strlen($number);

    if ($length==1) { $str_ten = convert_to_string($number); }
    if ($length==2) { $str_ten = convert_to_string($number); }

    if ($length==3) 
    { 
    $str_hundred = convert_to_string(substr($number,0,1));
    $str_ten = convert_to_string(substr($number,1,2));
    }

    if ($length==4) 
    { 
    $str_thousand = convert_to_string(substr($number,0,1));
    if (substr($number,1,1)!=='0') { $str_hundred = convert_to_string(substr($number,1,1)) . " hundred "; }
    $str_ten = convert_to_string(substr($number,2,2));
    }

    if ($length==5) 
    { 
    $str_thousand = convert_to_string(substr($number,0,2));
    if (substr($number,2,1)!=='0') { $str_hundred = convert_to_string(substr($number,2,1)) . " hundred "; }
    $str_ten = convert_to_string(substr($number,3,2));
    }

    if ($length==6) 
    { 
    $str_lakh= convert_to_string(substr($number,0,1));
    if (substr($number,1,2)!=='00') { $str_thousand = convert_to_string(substr($number,1,2)) . " thousand "; }
    if (substr($number,3,1)!=='0') { $str_hundred = convert_to_string(substr($number,3,1)) . " hundred "; }
    if (substr($number,4,2)!=='00') { $str_ten = convert_to_string(substr($number,4,2)); }
    }

    if ($length==7) 
    {
    $str_lakh= convert_to_string(substr($number,0,2));
    $str_thousand = convert_to_string(substr($number,2,2));
    $str_hundred = convert_to_string(substr($number,4,1));
    $str_ten = convert_to_string(substr($number,5,2));
    }

    if ($length==8) 
    {
    $str_crore= convert_to_string(substr($number,0,1));
    if (substr($number,1,2)!=='00') { $str_lakh= convert_to_string(substr($number,1,2)) . " lakh "; }
    if (substr($number,3,2)!=='00') { $str_thousand = convert_to_string(substr($number,3,2)) . " thousand "; }
    if (substr($number,5,1)!=='0') { $str_hundred = convert_to_string(substr($number,5,1)) . " hundred "; }
    $str_ten = convert_to_string(substr($number,6,2));
    }

    if ($length==9) 
    {
    $str_crore= convert_to_string(substr($number,0,2));
    if (substr($number,2,2)!=='00') { $str_lakh= convert_to_string(substr($number,2,2)) . " lakh "; } 
    if (substr($number,4,2)!=='00') { $str_thousand = convert_to_string(substr($number,4,2)) . " thousand "; }
    if (substr($number,6,1)!='0') { $str_hundred = convert_to_string(substr($number,6,1)) . " hundred "; }
    $str_ten = convert_to_string(substr($number,7,2));
    }

    if ($length==1) { $return = $str_ten; }
    if ($length==2) { $return = $str_ten; }
    if ($length==3) { $return = $str_hundred . " hundred " . $str_ten; }
    if ($length==4) { $return = $str_thousand . " thousand " . $str_hundred . $str_ten; }
    if ($length==5) { $return = $str_thousand . " thousand " . $str_hundred . $str_ten; }
    if ($length==6) { $return = $str_lakh . " lakh " . $str_thousand . $str_hundred . $str_ten; }
    if ($length==7) { $return = $str_lakh . " lakh " . $str_thousand . " thousand " . $str_hundred . " hundred " . $str_ten; }
    if ($length==8) { $return = $str_crore . " crore " . $str_lakh .  $str_thousand . $str_hundred  . $str_ten; }
    if ($length==9) { $return = $str_crore . " crore " . $str_lakh .  $str_thousand . $str_hundred  . $str_ten; }

    return "Rs. " . $return . " only";
    }


    function convert_to_string($number)
    {

    $str2 = NULL; 
    if ($number==1) { $str2 ="one"; }
    elseif ($number==2) { $str2 ="two"; }
    elseif ($number==3) { $str2 ="three"; }
    elseif ($number==4) { $str2 ="four"; }
    elseif ($number==5) { $str2 ="five"; }
    elseif ($number==6) { $str2 ="six"; }
    elseif ($number==7) { $str2 ="seven"; }
    elseif ($number==8) { $str2 ="eight"; }
    elseif ($number==9) { $str2 ="nine"; }
    elseif ($number==10) { $str2 ="ten"; }
    elseif ($number=="01") { $str2 ="one"; }
    elseif ($number=="02") { $str2 ="two"; }
    elseif ($number=="03") { $str2 ="three"; }
    elseif ($number=="04") { $str2 ="four"; }
    elseif ($number=="05") { $str2 ="five"; }
    elseif ($number=="06") { $str2 ="six"; }
    elseif ($number=="07") { $str2 ="seven"; }
    elseif ($number=="08") { $str2 ="eight"; }
    elseif ($number=="09") { $str2 ="nine"; }
    elseif ($number==11) { $str2 ="eleven"; }
    elseif ($number==12) { $str2 ="twelve"; }
    elseif ($number==13) { $str2 ="thirteen"; }
    elseif ($number==14) { $str2 ="fourteen"; }
    elseif ($number==15) { $str2 ="fifteen"; }
    elseif ($number==16) { $str2 ="sixteen"; }
    elseif ($number==17) { $str2 ="seventeen"; }
    elseif ($number==18) { $str2 ="eighteen"; }
    elseif ($number==19) { $str2 ="ninteen"; }

    elseif ($number==20) { $str2 ="twenty"; }
    elseif ($number==21) { $str2 ="twenty one"; }
    elseif ($number==22) { $str2 ="twenty two"; }
    elseif ($number==23) { $str2 ="twenty three"; }
    elseif ($number==24) { $str2 ="twenty four"; }
    elseif ($number==25) { $str2 ="twenty five"; }
    elseif ($number==26) { $str2 ="twenty six"; }
    elseif ($number==27) { $str2 ="twenty seven"; }
    elseif ($number==28) { $str2 ="twenty eight"; }
    elseif ($number==29) { $str2 ="twenty nine"; }

    elseif ($number==30) { $str2 ="thirty"; }
    elseif ($number==31) { $str2 ="thirty one"; }
    elseif ($number==32) { $str2 ="thirty two"; }
    elseif ($number==33) { $str2 ="thirty three"; }
    elseif ($number==34) { $str2 ="thirty four"; }
    elseif ($number==35) { $str2 ="thirty five"; }
    elseif ($number==36) { $str2 ="thirty six"; }
    elseif ($number==37) { $str2 ="thirty seven"; }
    elseif ($number==38) { $str2 ="thirty eight"; }
    elseif ($number==39) { $str2 ="thirty nine"; }

    elseif ($number==40) { $str2 ="forty"; }
    elseif ($number==41) { $str2 ="forty one"; }
    elseif ($number==42) { $str2 ="forty two"; }
    elseif ($number==43) { $str2 ="forty three"; }
    elseif ($number==44) { $str2 ="forty four"; }
    elseif ($number==45) { $str2 ="forty five"; }
    elseif ($number==46) { $str2 ="forty six"; }
    elseif ($number==47) { $str2 ="forty seven"; }
    elseif ($number==48) { $str2 ="forty eight"; }
    elseif ($number==49) { $str2 ="forty nine"; }

    elseif ($number==50) { $str2 ="fifty"; }
    elseif ($number==51) { $str2 ="fifty one"; }
    elseif ($number==52) { $str2 ="fifty two"; }
    elseif ($number==53) { $str2 ="fifty three"; }
    elseif ($number==54) { $str2 ="fifty four"; }
    elseif ($number==55) { $str2 ="fifty five"; }
    elseif ($number==56) { $str2 ="fifty six"; }
    elseif ($number==57) { $str2 ="fifty seven"; }
    elseif ($number==58) { $str2 ="fifty eight"; }    
    elseif ($number==59) { $str2 ="fifty nine"; }


    elseif ($number==60) { $str2 ="sixty"; }
    elseif ($number==61) { $str2 ="sixty one"; }
    elseif ($number==62) { $str2 ="sixty two"; }
    elseif ($number==63) { $str2 ="sixty three"; }
    elseif ($number==64) { $str2 ="sixty four"; }
    elseif ($number==65) { $str2 ="sixty five"; }
    elseif ($number==66) { $str2 ="sixty six"; }
    elseif ($number==67) { $str2 ="sixty seven"; }
    elseif ($number==68) { $str2 ="sixty eight"; }
    elseif ($number==69) { $str2 ="sixty nine"; }


    elseif ($number==70) { $str2 ="seventy"; }
    elseif ($number==71) { $str2 ="seventy one"; }
    elseif ($number==72) { $str2 ="seventy two"; }
    elseif ($number==73) { $str2 ="seventy three"; }
    elseif ($number==74) { $str2 ="seventy four"; }
    elseif ($number==75) { $str2 ="seventy five"; }
    elseif ($number==76) { $str2 ="seventy six"; }
    elseif ($number==77) { $str2 ="seventy seven"; }    
    elseif ($number==78) { $str2 ="seventy eight"; }
    elseif ($number==79) { $str2 ="seventy nine"; }


    elseif ($number==80) { $str2 ="eighty"; }
    elseif ($number==81) { $str2 ="eighty one"; }
    elseif ($number==82) { $str2 ="eighty two"; }
    elseif ($number==83) { $str2 ="eighty three"; }
    elseif ($number==84) { $str2 ="eighty four"; }
    elseif ($number==85) { $str2 ="eighty five"; }
    elseif ($number==86) { $str2 ="eighty six"; }
    elseif ($number==87) { $str2 ="eighty seven"; }
    elseif ($number==88) { $str2 ="eighty eight"; }
    elseif ($number==89) { $str2 ="eighty nine"; }

    elseif ($number==90) { $str2 ="ninety"; }
    elseif ($number==91) { $str2 ="ninety one"; }   
    elseif ($number==92) { $str2 ="ninety two"; }
    elseif ($number==93) { $str2 ="ninety three"; }
    elseif ($number==94) { $str2 ="ninety four"; }   
    elseif ($number==95) { $str2 ="ninety five"; }
    elseif ($number==96) { $str2 ="ninety six"; }
    elseif ($number==97) { $str2 ="ninety seven"; }   
    elseif ($number==98) { $str2 ="ninety eight"; }
    elseif ($number==99) { $str2 ="ninety nine"; }
    return $str2;	
    }


?>

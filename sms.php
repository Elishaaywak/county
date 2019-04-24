<?php
  require'db.inc.php';
  $sender = $_GET['sender'];
  $message = $_GET['msgdata'];
  echo $message;
 
    if ($sender!='') {
     
                    
                    //if the message is in the format *Report*Wardid*sectorid*name*message#  
                    //if ((strpos($message,'*')!== false)&& (strpos($message,'#')!== false))
                    if ((strpos($message,'*')!== false))
                    {
                       
                        $message = str_replace('#', '', $message) ;
                        //echo $message ;
                        $message2 = explode("*", $message);
                       // echo $message2[5]; // piece1


                        //the exploded message to variable
                        $name=$message2[3];
                        $telephone=$sender;
                        $wardid=$message2[1];
                        $report=$message2[4];
                        $nearest=$message2[5];
                        $status="Pending";
                        $serviceid=$message2[2];
                        $date= date('Y-m-d');
                        echo $nearest;
               //         echo $serviceid;
               //       //if the message is not null
                        if (($report != "") && ($wardid != "") && ($serviceid != ""))
                        {
                            //insert into the database
                        $insert="INSERT INTO reports(name,telephone,wardid,report,status,serviceid,reportdate,reporttime,nearest) VALUES ('$name','$telephone','$wardid','$report','$status','$serviceid','$date',NOW(),'$nearest')";
                        mysql_query($insert) or trigger_error($insert);
                        echo $insert;
                        //inform the user that the operation was successful
                         $responsetext = "Report Successful! You will receive feedback soon. Thank you for your message"; 
                        }
                        else
                        {
                            $responsetext="You have entered the incorrect format. Please check your format and try again.";
                        }
                       
                    }
                    //if the message is wards
                    else if ((strpos($message,'ward')!== false)|| (strpos($message,'WARD')!== false) || (strpos($message,'Ward')!== false))
                    {
                            $responsetext="Ward Codes: ";
                            //the link to get the wards in json form
                            $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getward.php?sms=true");
                            error_reporting(E_ERROR | E_PARSE);        
                            $data = json_decode($ward_link,true);
                             
                            foreach ($data as $wd) 
                                {
                                $wardname = $wd["name"];
                                $wardid = $wd["wardid"];
                                $responsetext="$responsetext $wardid-$wardname,";
                                }
                    }
                    //if the message is format
                    else if ((strpos($message,'format')!== false)|| (strpos($message,'FORMAT')!== false) || (strpos($message,'Format')!== false))
                    {
                            $responsetext="The format is *ward_id*sector_id*name*report*nearest location#";
                           
                                
                    }
                    else if ((strpos($message,'sector')!== false)|| (strpos($message,'SECTOR')!== false) || (strpos($message,'Sector')!== false))
                    {
                            $responsetext="Sector Codes: ";
                            //the link to get the wards in json form
                            $ward_link=file_get_contents("http://www.prisconet.com/apps/county/getsector.php?sms=true");
                            error_reporting(E_ERROR | E_PARSE);        
                            $data = json_decode($ward_link,true);
                             
                            foreach ($data as $wd) 
                                {
                                $sectorname = $wd["brief"];
                                $sectorid = $wd["serviceid"];
                                $responsetext="$responsetext $sectorid-$sectorname,";
                                }
                    }
                    else
                    {
                        $responsetext="The message you have entered is in incorrect format. Please send the word 'format' to get the correct way";
                    }

                     #
                     # Return a response SMS message
                     #

                     echo "{SMS:TEXT}{Safaricom}{+254703395018}{".$sender."}{".$responsetext."}";
  } 
  else 
  {
     echo "{SMS:TEXT}{}{}{".$sender."}{".$responsetext."}";
  }

?>
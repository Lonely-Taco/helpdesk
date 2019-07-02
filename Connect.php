<?php

$conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                
               if (!$conn){
                   die($conn);
               }
//
//
//$conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
//                
//               if (!$conn){
//                   die($conn);
//                   
//               }else{
//                   $select_query = "SELECT Customer_name FROM customer WHERE CustomerID = 1 ";
//                   $stmt = mysqli_prepare($conn, $select_query);
//                   if (!$stmt){
//                       DIE($conn);
//                       
//                   }else{
//                       $Qresult = mysqli_execute($stmt);
//                       if(!$Qresult){
//                           die($conn);
//                       }else{
//                           mysqli_stmt_bind_result($stmt, $client);
//                            while(mysqli_stmt_fetch($stmt)){
//                                echo $client;
//                                
//                            }
//                       }
//                   }
//               }
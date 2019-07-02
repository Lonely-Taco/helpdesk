<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'helpdesk');
                
               if (!$conn){
                   echo'UNABLE TO CONNECT'.mysqli_error($conn);
                 
               }

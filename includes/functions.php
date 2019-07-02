<?php

include 'includes/connect.php';

function setIncident($conn) {
    if (isset($_POST['submit_ticket'])) {
        $description = htmlentities($_POST['description']);
        $incidenttype = htmlentities($_POST['incident_id']);
        $id = $_GET['id'];
        $status = 'PENDING';

        if (empty($description) || empty($incidenttype)) {
            echo "Fill out Description and Choose an incident type";
        } else {
            $INSERT = "INSERT INTO ticket (ContactID, IncidentID, Description,Status) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $INSERT);
            mysqli_stmt_bind_param($stmt, 'isss', $id, $incidenttype, $description, $status);
            if (!$stmt) {
                echo'could not prepare' . mysqli_error($conn);
            } else {
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    echo 'could not execute' . mysqli_error($conn);
                } else {
                    echo "<p>YOURE INCIDENT HAS BEEN ADDED</p>"
                    . "<p>You can view your tickets on MyTickets once they are assigned.</P>";
                }
            }
        }
    }
}

function setIncidentemployee($conn) {
    if (isset($_POST['submit_ticket'])) {
        $description = htmlentities($_POST['description']);
        $incidenttype = htmlentities($_POST['incident_id']);
        $contactID = htmlentities($_POST['contact']);
        $employeeId = $_GET['id'];
        $status = 'PENDING';

        if (empty($description) || empty($incidenttype)) {
            echo "Fill out Description and Choose an incident type";
        } else {
            $INSERT = "INSERT INTO ticket (ContactID ,IncidentID, Description,Status) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $INSERT);
            mysqli_stmt_bind_param($stmt, 'isss', $contactID, $incidenttype, $description, $status);
            if (!$stmt) {
                echo'could not prepare' . mysqli_error($conn);
            } else {
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    echo 'could not execute' . mysqli_error($conn);
                } else {
                    echo "<p>YOURE INCIDENT HAS BEEN ADDED</p>";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
    mysqli_close($conn);
}

function getIncidents($conn) {
    $sql_select = "SELECT * FROM `ticket` WHERE EmployeeID=? ORDER BY `ticket`.`Date/Time` DESC ";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        echo 'Bad Query' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 's', $_GET['id']);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo 'Cannot execute' . mysqli_error_list($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $ticketid, $employeeid, $contactid, $incidentid, $startdate, $desc, $status, $closingdate, $solution);
            mysqli_stmt_store_result($stmt);
            $rows = mysqli_stmt_num_rows($stmt);
            if ($rows == 0) {
                echo "YOU HAVE NO ASSIGNED TICKETS";
            } else {
                echo 'ASSIGNED TICKETS';
                echo '<rpre>';
                echo "<table width='100%' border='1'>";
                echo "<tr><th>TicketID</th>"
                . "<th>EmployeeID</th>"
                . "<th>ContactID</th>"
                . "<th>IncidentID</th>"
                . "<th>Date</th>"
                . "<th>Description</th>"
                . "<th>status</th>"
                . "<th>Closing Date</th>"
                . "<th>Actions</th><tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $ticketid . "</td>";
                    echo "<td>" . $employeeid . "</td>"
                    . "<td>" . $contactid . "</td>"
                    . "<td>" . $incidentid . "</td>"
                    . "<td>" . $startdate . "</td>"
                    . "<td>" . $desc . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>" . $closingdate . "</td> "
                    . "<td><a href='solve_ticket.php?id=$ticketid'>Solve</a>/<a href='edit_ticket.php?id=$ticketid'>Edit</a></td>"
                            . "</tr><br>";
                }

                echo "</table>";
                echo'</pre>';
            }
        }
        mysqli_stmt_close($stmt);
    }
 //   mysqli_close($conn);
}

function getTicket($conn) {
    $sql_select = "SELECT * FROM `ticket` WHERE TicketID=?";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        echo 'Unable to Prepare' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo'Unable to execute' . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $ticketid, $employeeid, $contactid, $incidentid, $startdate, $desc, $status, $closingdate, $solution);
            echo '<rpre>';
            echo "<table width='100%' border='1' solid>";
            echo "<tr><th>TicketID</th>"
            . "<th>EmployeeID</th>"
            . "<th>ContactID</th>"
            . "<th>IncidentID</th>"
            . "<th>Date</th>"
            . "<th>Description</th>"
            . "<th>status</th>"
            . "<th>Closing Date</th>"
            . "<th>Actions</th><tr>";
            while (mysqli_stmt_fetch($stmt)) {
                echo "<tr><td>" . $ticketid . "</td>";
                echo "<td>" . $employeeid . "</td>"
                . "<td>" . $contactid . "</td>"
                . "<td>" . $incidentid . "</td>"
                . "<td>" . $startdate . "</td>"
                . "<td>" . $desc . "</td>"
                . "<td>" . $status . "</td>"
                . "<td>" . $closingdate . "</td> "
                . "<td><a href='edit_ticket.php?id=$ticketid'>Edit</a></td>"
                . "<br>";
            }
            echo "</table>";
            echo'</pre>';
            echo '<br>';
        }
        mysqli_stmt_close($stmt);
    }
  //  mysqli_close($conn);
}

function setSolution($conn) {
    if (isset($_POST['solve'])) {
        date_default_timezone_set(timezone_name_from_abbr("CEST"));
        $solution = $_POST['solution'];
        $status = 'CLOSED';
        $date = htmlentities($_POST['date']);
        if (empty($solution)) {
            echo "Please Enter a Solution or Press Back on your browser";
        } else {
            $sql_update = "UPDATE ticket SET Status='$status',Date_of_Closing='$date',Solution=? WHERE TicketID=?";
            $stmt = mysqli_prepare($conn, $sql_update);
            if (!$stmt) {
                echo 'Unable to Prepare ' . mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($stmt, 'si', $solution, $_GET['id']);
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    echo 'Unable to Execute ' . mysqli_error($conn);
                } else {
                    echo 'solution inputed';
                    
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
}

function getIncidents2($conn) {
    $sql_select = "SELECT * FROM `ticket` ORDER BY `ticket`.`Status` DESC ";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        echo 'Bad Query' . mysqli_error($conn);
    } else {
//        mysqli_stmt_bind_param($stmt, 's', $_GET['id']);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo 'Cannot execute' . mysqli_error_list($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $ticketid, $employeeid, $contactid, $incidentid, $startdate, $desc, $status, $closingdate, $solution);
            mysqli_stmt_store_result($stmt);
            $rows = mysqli_stmt_num_rows($stmt);
            if ($rows == 0) {
                echo "YOU HAVE NO TICKETS";
            } else {
                echo 'ASSIGN TICKETS';
                echo '<rpre>';
                echo "<table width='100%' border='1'>";
                echo "<tr><th>TicketID</th>"
                . "<th>EmployeeID</th>"
                . "<th>ContactID</th>"
                . "<th>IncidentID</th>"
                . "<th>Date</th>"
                . "<th>Description</th>"
                . "<th>status</th>"
                . "<th>Closing Date</th>"
                . "<th>Actions</th><tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $ticketid . "</td>";
                    echo "<td>" . $employeeid . "</td>"
                    . "<td>" . $contactid . "</td>"
                    . "<td>" . $incidentid . "</td>"
                    . "<td>" . $startdate . "</td>"
                    . "<td>" . $desc . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>" . $closingdate . "</td> "
                    . "<td><a href='edit_ticket.php?id=$ticketid'>Edit</a>/<a href='assign.php?id=$ticketid'>Assign</a></td>"
                    . "</tr><br>";
                }

                echo "</table>";
                echo'</pre>';
            }
        }
        mysqli_stmt_close($stmt);
    }
 //   mysqli_close($conn);
}
function getIncidents3($conn) {
    $sql_select = "SELECT `ticket`.`TicketID`, "
            . "`ticket`.`EmployeeID`, "
            . "`ticket`.`ContactID`, "
            . "`ticket`.`IncidentID`, "
            . "`ticket`.`Date/Time`,"
            . " `ticket`.`Description`,"
            . " `ticket`.`Status`,"
            . " `ticket`.`Date_of_Closing`,"
            . " `ticket`.`Solution`,"
            . "`employee`.`Employee_Photo` "
            . "FROM `ticket`,`employee` "
            . "WHERE ticket.ContactID=? AND ticket.EmployeeID = employee.EmployeeID "
            . "ORDER BY `ticket`.`Date/Time` DESC ";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        echo 'Bad Query' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo 'Cannot execute' . mysqli_error_list($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $ticketid, $employeeid, $contactid, $incidentid, $startdate, $desc, $status, $closingdate, $solution,$photo);
            mysqli_stmt_store_result($stmt);
            $rows = mysqli_stmt_num_rows($stmt);
            if ($rows == 0) {
                echo "YOU HAVE NO TICKETS";
            } else {
                echo 'ASSIGNED TICKETS';
                echo '<rpre>';
                echo "<table width='100%' border='1'>";
                echo "<tr><th>TicketID</th>"
                . "<th>Employee</th>"
                . "<th>ContactID</th>"
                . "<th>IncidentID</th>"
                . "<th>Date</th>"
                . "<th>Description</th>"
                . "<th>status</th>"
                . "<th>Closing Date</th>"
                . "<th>Solution</th>"
                . "<th>Actions</th></tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $ticketid . "</td>";
                    echo "<td><img src=".$photo."></td>"
                    . "<td>" . $contactid . "</td>"
                    . "<td>" . $incidentid . "</td>"
                    . "<td>" . $startdate . "</td>"
                    . "<td>" . $desc . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>" . $closingdate . "</td> "
                    . "<td>" . $solution . "</td>"
                    . "<td><a href='solve_ticket.php?id=$ticketid'>Solve</a> / <a href='edit_ticket.php?id=$ticketid'>Edit</a></td>"
                    . "</tr><br>";
                }

                echo "</table>";
                echo'</pre>';
            }
        }
        mysqli_stmt_close($stmt);
    }
 //   mysqli_close($conn);
}
function getIncidents4($conn) {
    $sql_select = "SELECT `ticket`.`TicketID`, "
            . "`ticket`.`EmployeeID`, "
            . "`ticket`.`ContactID`, "
            . "`ticket`.`IncidentID`, "
            . "`ticket`.`Date/Time`,"
            . " `ticket`.`Description`,"
            . " `ticket`.`Status`,"
            . " `ticket`.`Date_of_Closing`,"
            . " `ticket`.`Solution`,"
            . "`employee`.`Employee_Photo` "
            . "FROM `ticket`,`employee` "
            . "WHERE ticket.ContactID=? AND ticket.EmployeeID = employee.EmployeeID "
            . "ORDER BY `ticket`.`Date/Time` DESC ";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        echo 'Bad Query' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo 'Cannot execute' . mysqli_error_list($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $ticketid, $employeeid, $contactid, $incidentid, $startdate, $desc, $status, $closingdate, $solution,$photo);
            mysqli_stmt_store_result($stmt);
            $rows = mysqli_stmt_num_rows($stmt);
            if ($rows == 0) {
                echo "YOU HAVE NO TICKETS";
            } else {
                echo 'ASSIGNED TICKETS';
                echo '<rpre>';
                echo "<table width='100%' border='1'>";
                echo "<tr><th>TicketID</th>"
                . "<th>Employee</th>"
                . "<th>ContactID</th>"
                . "<th>IncidentID</th>"
                . "<th>Date</th>"
                . "<th>Description</th>"
                . "<th>status</th>"
                . "<th>Closing Date</th>"
                . "<th>Solution</th>"
                . "<th>Actions</th></tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr><td>" . $ticketid . "</td>";
                    echo "<td><img src=".$photo."></td>"
                    . "<td>" . $contactid . "</td>"
                    . "<td>" . $incidentid . "</td>"
                    . "<td>" . $startdate . "</td>"
                    . "<td>" . $desc . "</td>"
                    . "<td>" . $status . "</td>"
                    . "<td>" . $closingdate . "</td> "
                    . "<td>" . $solution . "</td>"
                    . "<td><a href='edit_ticket_customer.php?id=$ticketid'>Edit</a></td>"
                    . "</tr><br>";
                }

                echo "</table>";
                echo'</pre>';
            }
        }
        mysqli_stmt_close($stmt);
    }
 //   mysqli_close($conn);
}
?>


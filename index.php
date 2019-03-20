<html>
 <head>
 <Title>Registration Form</Title>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1 align="center">Daftarkan Dirimu!</h1>
 <p align="center">Silahkan data informasi kamu, kemudian klik <strong>Submit</strong> untuk mendaftar.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
 <table border="0" align="center">
 <tr>
 <td>Nama Lengkap</td>
 <td>:</td>
 <td><input type="text" name="fullname" id="fullname"/></td>
 </tr>
 <tr>
 <td>Usia</td>
 <td>:</td>
 <td><input type="text" name="age" id="age"/></td>
 </tr>
 <tr>
 <td>Kota</td>
 <td>:</td>
 <td><input type="text" name="city" id="city"/></td>
 </tr>
 <tr>
 <td></td>
 <td></td>
 <td><input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" /></td>
 </tr>       
	   </table>
 </form>
 <?php
    $host = "dtari18webapp.database.windows.net";
    $user = "dtari18";
    $pass = "Tari2233";
    $db = "dbwebapp";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    if (isset($_POST['submit'])) {
        try {
            $fullname = $_POST['fullname'];
            $age = $_POST['age'];
            $city = $_POST['city'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO member (fullname, age, city, tgl) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $fullname);
            $stmt->bindValue(2, $age);
            $stmt->bindValue(3, $city);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM member";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
				echo "<center>";
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Nama Lengkap</th>";
                echo "<th>Usia</th>";
                echo "<th>Kota</th>";
                echo "<th>Tanggal</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['fullname']."</td>";
                    echo "<td>".$registrant['age']."</td>";
                    echo "<td>".$registrant['city']."</td>";
                    echo "<td>".$registrant['tgl']."</td></tr>";
                }
                echo "</table>";
				echo "</center>";
            } else {
				echo "<center>";
                echo "<h3>No one is currently registered.</h3>";
				echo "</center>";
            }
			
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>

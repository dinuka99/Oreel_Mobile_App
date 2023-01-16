 <?php
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shopId = $_POST["shop_Id"];
    //$cusId = $_POST["cusId"];
    $comment = $_POST["comment"];
    $rating = $_POST["rating"];
    $CName =$_POST["CName"];
    $CCountry = $_POST["CCountry"];

    if (empty($shopId)  or empty($comment) or empty($CName) or empty($CCountry)) {
        echo $response = "invalid Data";
        echo $response;

    } else {
        
        try {
            
            $conn = new PDO("sqlsrv:server = tcp:oreelardb.database.windows.net,1433; Database = OreelAR_DB", "dinuka", "Ntbrpa2019RT");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($conn) {
                
               $sql = "INSERT INTO dbo.FeedbackTBL(feedback_Comment,shop_ID,feedback_Rating,feedbackcustomer_Name,feedbackcustomer_Country) VALUES ('$comment','$shopId','$rating','$CName','$CCountry')";
                // $sql = "INSERT INTO dbo.FeedbackTBL(F_Name, country,comment) VALUES ($shopId,$cusId,$comment)";
                if ($conn->exec($sql)) {
                    $response = "Data Inserted sucessfuly";
                    echo $response;
                } else {
                    $response = "Data was not Inserted sucessfuly";
                    echo $response;
                }
                //echo $response;

            } else {
                $response = "failed to connect DB";
                echo $response;
            }
        } catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
            $response = "failed to connect DB";
            echo $response;

        }
    }
} else {
   $response = "empty values";
    echo $response;
}

?>


<?php

 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: GET");
 //header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 if ($_SERVER["REQUEST_METHOD"] == "GET")
 {
    $shopId = $_GET["shop_Id"];

    if (empty($shopId)  {
        $response = "invalid Data";
    
    }
        else
    {   
            try {
                 $conn = new PDO("sqlsrv:server = tcp:oreelardb.database.windows.net,1433; Database = OreelAR_DB", "dinuka", "Ntbrpa2019RT");
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                }
             catch (PDOException $e) {
                print("Error connecting to SQL Server.");
                die(print_r($e));
                }
             if($conn)
             {
                 $sql = "SELECT shop_Name,shop_Details, shop_Mobile,shop_Email,shop_Location,shop_Rating,ImageURL from dbo.ShopTBL join dbo.ImageURLTBL on dbo.ShopTBL.shop_ID=dbo.ImageURLTBL.shop_ID where dbo.ShopTBL.shop_ID='$shopId'";
                 $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()){
                        $result = array("shop_Name"=>$row["shop_Name"], "shop_Details"=>$row["shop_Details"], "shop_Mobile"=>$row["shop_Mobile"],"shop_Email"=>$row["shop_Email"],"shop_Location"=>$row["shop_Location"],"shop_Rating"=>$row["shop_Rating"],"ImageURL"=>$row["ImageURL"]);
            
                    }
                    echo $result;
                }     
                else{
                        $response='error';
                    }

              }
                else
                {}
    }
    
}

?>
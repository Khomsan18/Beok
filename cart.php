<?php

    session_start();
    require_once('dbcontroller.php');
    $db_handle = new DBController();

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                    $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
                    
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k) {
                                        if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                                        }
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
                break;
                case "remove":
                    if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["code"] == $k)
                                unset($_SESSION["cart_item"][$k]);

                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                break;
                case "empty":
                    unset($_SESSION["cart_item"]);
                break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เว็บซื้อหนังสือ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt">
</head>

<body style="font-family: Prompt;" background="picture/background/BG2.jpg">
    <div class="topnav">
        <a href="index.php"><b>หน้าแรก</b></a>
        <a href="bestseller.html"><b>ขายดี</b></a>
        <a href="new.html"><b>มาใหม่</b></a>
        <a href="promotion.html"><b>โปรโมชั่น</b></a>
        <a href="recommend.html"><b>แนะนำ</b></a>
        <div class="dropdown">
            <button class="dropbtn"><b>หมวดหมู่ <i class="arrow"></i></b></button>
            <div class="dropdown-content">
                <a href="love.html">นิยายรัก</a>
                <a href="romand.html">นิยายโรมานซ์</a>
                <a href="china.html">นิยายรักจีนโบราณ</a>
                <a href="#">นิยายกำลังภายใน</a>
                <a href="#">นิยายแฟนตาซี</a>
                <a href="#">การ์ตูนทั่วไป</a>
                <a href="#">การ์ตูนผู้หญิง</a>
                <a href="#">พัฒนาตนเอง</a>
        </div>
        </div>

        <div class="topnav-right">
            <div class="dropdown">
                <button class="dropbtn"><b>ผู้ใช้งาน <i class="arrow"></i></b></button>
                <div class="dropdown-content">
                    <a href="profile.html">จัดการข้อมูล</a>
                    <a href="cart.php">ตะกร้าสินค้า</a>
                    <a href="home.html">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    
    <div id="shopping-cart">
        <div class="txt-heading">ตะกร้าสินค้า</div>
        <a href="cart.php?action=empty" id="btnEmpty">ล้างทั้งหมด</a>

        <?php
        
            if(isset($_SESSION["cart_item"])) {
                $total_quantity = 0;
                $total_price = 0;
            
        ?>
        <table class="t-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th>หนังสือ</th>
                    <th>Code</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อเล่ม</th>
                    <th>ราคา</th>
                    <th>ลบ</th>
                </tr>

                <?php
                
                    foreach($_SESSION["cart_item"] as $item) {
                        $item_price = $item["quantity"] * $item["price"];
                    
                ?>
                <tr>
                    <td style="text-align: center;"><img src="<?php echo $item["image"]; ?>" class="c-img" alt=""><br><?php echo $item["name"]; ?></td>
                    <td style="text-align: right;"><?php echo $item["code"]; ?></td>
                    <td style="text-align: right;"><?php echo $item["quantity"]; ?></td>
                    <td style="text-align: right;">฿<?php echo $item["price"]; ?></td>
                    <td style="text-align: right;">฿<?php echo number_format($item_price, 2); ?></td>
                    <td style="text-align: center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAct"><img src="picture/remove-icon.png" alt="Remove Book"></a></td>
                </tr>

                <?php
                    $total_quantity += $item["quantity"];
                    $total_price += ($item["price"] * $item["quantity"]);

                    }
                ?>
                    
                <tr>
                    <td colspan="2">รวม:</td>
                    <td style="text-align: right;"><?php echo $total_quantity; ?></td>
                    <td colspan="2" style="text-align: right;">฿<?php echo number_format($total_price, 2); ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php
            } else {
        ?>
        <div class="no-book">ไม่พบข้อมูลในตะกร้าสินค้า</div>
        <?php
            }
        ?>
    </div>

    


    <br><br><br><br>
    <br><div class="footer">
        <br><h3>ผู้จัดทำ</h3>
        <div style="opacity: 60%;">
            Narawit Khomsan<br>
            Pimnipa Srisamor<br>
            Areeya Loedarayakun<br>
            Nattharida Rasri<br>
            Trin Nanant
        </div><br>
</body>
</html>
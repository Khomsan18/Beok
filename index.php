<?php

    session_start();
    require_once('dbcontroller.php');
    $db_handle = new DBController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เว็บซื้อหนังสือ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="test.js">
</head>
<body  style="font-family: Prompt;" background = "picture/background/BG2.jpg">
        
        <div class="topnav">
            <a class="active" href="index.php"><b>หน้าแรก</b></a>
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
                        <a href="log_reg/login.php">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="centerSlide" style="max-width:500px" >
            <img class="mySlides" src="picture/index/hp1.gif" style="width:80%">
            <img class="mySlides" src="picture/index/hp2.gif" style="width:80%">
            <img class="mySlides" src="picture/index/hp3.gif" style="width:80%">
            <img class="mySlides" src="picture/index/hp5.gif" style="width:80%">
            <img class="mySlides" src="picture/index/hp6.gif" style="width:80%">
        </div>
        <script>
            var myIndex = 0;
            carousel();
            
            function carousel() {
              var i;
              var x = document.getElementsByClassName("mySlides");
              for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
              }
              myIndex++;
              if (myIndex > x.length) {myIndex = 1}    
              x[myIndex-1].style.display = "block";  
              setTimeout(carousel, 3000); 
            }
            </script>

        <h2><br>&nbsp;&nbsp;มาใหม่</h2>
        <hr>
        
        <div class="row">

            <?php

                $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");

                if(!empty($product_array)) {
                    foreach($product_array as $key => $value){
                        
                
            ?>

            <div class="column">
                <div class="card" >
                    <form action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" method="post">
                    <a href="books/b1.html" target="_blank" ><img src="<?php echo $product_array[$key]["image"]; ?>" alt="book"></a>
                    <div class="book-name"><?php echo $product_array[$key]["name"]; ?></div>
                    <p class="price">฿<?php echo $product_array[$key]["price"]; ?></p>
                    <input type="text" class="book-quantity" name="quantity" value=1 size="2">
                    <input type="submit" value="Add to Cart" class="btnAdd">
                    </form>
                </div>
            </div>

            

            <?php
                    }
                }
            ?>
        </div>

        <h2><br>&nbsp;&nbsp;มาใหม่ในหมวดหมู่ นิยายรัก</h2>
        <hr>
        <div class="row">
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp3.gif" alt="book" ></a>
                    <h2>ฉันไม่รู้จักคุณ</h2>
                    <p class="price">฿345</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp4.gif" alt="book" ></a>
                    <h2>ขอรักกลับคืนมา</h2>
                    <p class="price">฿316</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp6.gif" alt="book" ></a>
                    <h2>Just friend</h2>
                    <p class="price">฿229</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp7.gif" alt="book" ></a>
                    <h2>คำสาปแห่งนาคิน</h2>
                    <p class="price">฿345</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp8.gif" alt="book" ></a>
                    <h2>คุณพ่อตามหารัก</h2>
                    <p class="price">฿239</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
        </div>


        <h2><br>&nbsp;&nbsp;มาใหม่ในหมวดหมู่ นิยายโรมานซ์</h2>
        <hr>
        <div class="row">
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp1.gif" alt="book" ></a>
                    <h2>จะรักดีไหม?</h2>
                    <p class="price">฿369</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp5.gif" alt="book" ></a>
                    <h2>คุณหมอดุ</h2>
                    <p class="price">฿245</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp9.gif" alt="book" ></a>
                    <h2>รักแอบร้าย</h2>
                    <p class="price">฿175</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp10.gif" alt="book" ></a>
                    <h2>ดวงจันทร์ในดวงใจ</h2>
                    <p class="price">฿179</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp11.gif" alt="book" ></a>
                    <h2>ไฟสวาทซาตานเถื่อน</h2>
                    <p class="price">฿199</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
        </div>
        <h2><br>&nbsp;&nbsp;มาใหม่ในหมวดหมู่ นิยายรักจีนโบราณ</h2>
        <hr>
        <div class="row">
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp12.gif" alt="book" ></a>
                    <h2>พลิกชะตานักฆ่าไร้ใจ</h2>
                    <p class="price">฿219</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp13.gif" alt="book" ></a>
                    <h2>ชายากำมะลอ 2</h2>
                    <p class="price">฿55</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp14.gif" alt="book" ></a>
                    <h2>จอมโจรสายหื่น</h2>
                    <p class="price">฿179</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp15.gif" alt="book" ></a>
                    <h2>ปลดค่าผนึก</h2>
                    <p class="price">฿159</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <a href="#" target="_blank" ><img src ="picture/index/hp16.gif" alt="book" ></a>
                    <h2>ราชินีสมุนไพร</h2>
                    <p class="price">฿219</p>
                    <input type="submit" value="Add to Cart" class="btnAdd">
                </div>
            </div>
        </div>
        <br><div class="footer">
            <br><h3>ผู้จัดทำ</h3>
            <div style="opacity: 60%;">
                Narawit Khomsan<br>
                Pimnipa Srisamor<br>
                Areeya Loedarayakun<br>
                Nattharida Rasri<br>
                Trin Nanant
            </div><br>
        </div>
    </body>
</html>
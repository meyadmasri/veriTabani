<?php

    require_once("baglan.php");

    if(isset($_SESSION["kullanici"])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/Eleman_Ekle_style.css">
</head>
<body>
    <div class="sayfa">
       <a href="AnaSayfa.php"><img id="logo" src="resimler/logo.png"></a> 
        <a href="cikis.php"><button type="button" id="cikisButonu"> Çıkış</button></a>
       
        <aside id="aside1">         
            <ul>
                <li><a href="Kategori_Ekle.php"><button  class="yanliste">Kategori işlemleri</button></a></li>
                <li><a href="urun_Ekle.php"><button  class="yanliste">Ürün Ekle</button></a></li>
                <li><a href="Urunleri_Sil.php"><button  class="yanliste">Ürün Sil</button></a></li>
                <li><a href="urunleri_Duzelt.php"><button  class="yanliste">Ürün Düzelt</button></a></li>
                <li><a href="Sirketin_Bilgilerini_Duzelt.php"><button  class="yanliste">Şirketin Bilgilerini Düzelt</button></a></li>
                <li><a href="Eleman_Ekle.php"><button  class="yanliste">Eleman İşlemleri</button></a></li>
                <li><a href="siparisler.php"><button  class="yanliste">Siparişler</button></a></li>
                
            </ul>
      </aside>
      <article>
        <article>
            <h2>Eleman Ekle</h2>
            <table>
                <form method="post" action="">
                    <tr>
                        <td><input type="text" placeholder="AD" name="ad" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="SoyAd" name="soyad" required></td>
                    </tr>
                    <tr>
                        <td><input type="email" placeholder="Email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Ekle" name="gonder"></td>
                    </tr>
                </form>
            </table>
        </article>

        <?php
        
            if(isset($_POST["gonder"])){

                $ad =        Filtre($_POST["ad"]);
                $soyad =     Filtre($_POST["soyad"]);
                $email =     Filtre($_POST["email"]);
                $password =  Filtre($_POST["password"]);
                
                $res = mysqli_query($veritabaniBaglantisi , "SELECT * FROM eleman WHERE email= '$email'");
                $res1 = mysqli_num_rows($res);
                if($res1==1){
                    ?>
                    <script>                    
                        alert("Lütfen Başka Email giriniz.");
                    </script>
                    <?php
                }else{

                $Ekle = mysqli_query($veritabaniBaglantisi , "INSERT INTO eleman(ad,soyad,email,password) VALUES('$ad','$soyad','$email','$password')");

                if($Ekle){?>
                <script>
                alert("Ekleme İşlemi Başarılı")
                </script>
                <?php   
                }
            }
            }

        ?>
        <aside id="aside2">
            <h2>Eklenmiş Elemanlar</h2>
            <table align="center">
                <?php
            
                      $goster = mysqli_query($veritabaniBaglantisi , "SELECT * FROM eleman");
                     $kayitSayisi = mysqli_num_rows($goster);
                      while($kayitlar = mysqli_fetch_assoc($goster)){?>
                        <tr>   
                       <td><label for="<?php echo $kayitlar["ad"] . " " . $kayitlar["soyad"];?>"><?php echo $kayitlar["ad"] . " " . $kayitlar["soyad"];?></label></td>
                       <td><a href="sil.php?ad=<?php echo $kayitlar['ad'];?>&soyisim=<?php echo $kayitlar["soyad"];?>"><button type="button" class="sil" name="<?php echo $kayitlar["ad"] . " " . $kayitlar["soyad"];?>">Sil</button></a></td>
                       </tr>   
                       <?php
                     }
                ?>
               
             
            </table>
        </aside>
      </article>
    </div>
</body>
</html>
<?php
    }
    else{
        header("Location:GirisSayfasi.php");

    }

mysqli_close($veritabaniBaglantisi)
?>
<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<html>
    <head>
        <title> 식물 정보 </title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>

    <body>
    <table class="table" style="width: 80%; text-align: center;" align="center">
            <tr>
                <td colspan="6">
                <?
                $dir = "./dvaseFolder/learnSetImage/".$plant["eng_name"]."/";
                $url = "http://15.164.251.97/dvaseFolder/learnSetImage/".$plant["eng_name"]."/";

                if ( is_dir( $dir ) ) {
                    if ($dh = opendir($dir)) {
                        echo '<img src="'.$url.readdir( $dh ).'" class="img-fluid" alt="Responsive image">';
                        closedir($dh);
                    }
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>이름</th>
                <td colspan="5"> <?= $plant["name"] ?> </td>
            </tr>
            <tr>
                <td>영문이름</th>
                <td colspan="5"> <?= $plant["eng_name"] ?> </td>
            </tr>
            <tr>
                <td>꽃말</th>
                <td colspan="5"> <?= $plant["flower"] ?> </td>
            </tr>
            <tr>
                <td>관리 수준</th>
                <td colspan="5"> <?= $plant["care"] ?> </td>
            </tr>
            <tr>
                <td>물 주기</th>
                <td colspan="5"> <?= $plant["water"] ?> </td>
            </tr>
            <?
            $count = 1;
            echo "<script> console.log(".sizeof( $plant["features"] ).") </script>";
            for( $i = 0; $i < sizeof( $plant["features"] ); $i++ ){
                echo "<script> console.log(".$i.") </script>";
                echo '
                <tr>
                    <td> 특징 '.$count.' </td>
                    <td colspan="5"> '.$plant["features"][$i]["feature"].'</td>
                </tr>
                ';
                $i++;
            }

            ?>
        </table>
    </body>
</html>


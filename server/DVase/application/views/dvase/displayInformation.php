<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<html>
    <head>
        <title> 식물 정보 </title>

        <style>
            .head-title{
                font-weight: bold;
                font-size: 0.8em;
            }
            .table-context{
                font-size: 0.8em;
            }
        </style>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>

    <body>
    <table class="table" style="width: 80%; text-align: center;" align="center">
            <tr>
                <td colspan="3">
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
                <td class="head-title" >이름</th>
                <td class="table-context" colspan="2"> <?= $plant["name"] ?> </td>
            </tr>
            <tr>
                <td class="head-title">영문명</th>
                <td class="table-context" colspan="3"> <?= $plant["eng_name"] ?> </td>
            </tr>
            <tr>
                <td class="head-title">꽃말</th>
                <td class="table-context" colspan="3"> <?= $plant["flower"] ?> </td>
            </tr>
            <tr>
                <td class="head-title">관리</th>
                <td class="table-context" colspan="3">
                    <?
                        $level = $plant["care"];
                        if( $level == "easy" ){
                            echo "쉬운 편";
                        } else if( $level == "normal" ){
                            echo "보통";
                        } else{
                            echo "까다로움";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="head-title">물</th>
                <td class="table-context" colspan="4"> <?= $plant["water"] ?> </td>
            </tr>
            <?
            $count = 1;
            for( $i = 0; $i < sizeof( $plant["features"] ); $i++ ){
                echo '
                <tr>
                    <td class="head-title"> 특징 '.$count.' </td>
                    <td class="table-context" colspan="4"> '.$plant["features"][$i]["feature"].'</td>
                </tr>
                ';
                $count++;
            }

            ?>
        </table>
    </body>
</html>


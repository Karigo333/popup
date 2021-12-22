<?php
require_once "db/db_connect.php";




function load()
{
    $url = 'https://dailytargum.com/section/news';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $content = curl_exec(($ch));
    curl_close($ch);


//block News
    preg_match_all('#<div\s+[^>]*?class\s*=\s*(["\'])jsx-1859068249 col\1[^>]*?>(.*?)</div>#su', $content, $match);

    $data_for_js = [];

    foreach ($match[0] as $item) {
        //image
        preg_match_all('#<img.+?src\s*?=\s*?(["\'])(.*?)\1[^>]*?>#su', $item, $image);
        $image = implode($image[2]);
        $image = stristr($image, '?', true);
//        $image = str_replace( 'https://dailytargum.imgix.net/images/', '', $image);
//        var_dump($image);


        preg_match_all('#<a\s+class\s*=\s*"Card_stackedCardResponsive__pOvBg" role="article" href="(.*?)">#si', $item, $link);
        $link = $link[1];

//    $page = file_get_contents('https://dailytargum.com' . (implode($link)));
        $page = 'https://dailytargum.com' . (implode($link));

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $page);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
        $content2 = curl_exec(($ch2));
        curl_close($ch2);

        //title
        preg_match_all('#<h1[^>]+?>(.*?)</h1>#su', $content2, $heading);
        $heading = $heading[1][0];

        //date
        preg_match_all('#<time[^>]+?>(.*?)</time>#su', $content2, $data);
        $data = $data[1][0];

        //full_text
        preg_match_all('#p\s+[^>]*?class\s*=\s*(["\'])jsx-4083616078\1[^>]*?>(.*?)</p>#su', $content2, $description);
        $description = $description[2][1];

        if (!check($heading)) {
            $param = [
                'heading' => $heading,
                'description' => $description,
                'image' => $image,
                'data' => $data
            ];


            $sql = "INSERT INTO test_task.news (heading, image, description, data) VALUES (:heading, :image, :description, :data)";
            $query = DB::query()->prepare($sql);
            $query->execute($param);


            if (count($data_for_js) < 6) {
                $data_for_js[] = [
                    'id' => $id ?? null,
                    'heading' => $heading ?? null,
                    'description' => $description ?? null,
                    'image' => $image ?? null,
                    'data' => $data ?? null
                ];
            }


//        if($image){
//            define('DIRECTORY', '../images/');
//            $name_img = str_replace( 'https://dailytargum.imgix.net/images/', '', $image);
//            $ch5 = curl_init($image);
//            $fp = fopen("./images/$name_img", 'wb');
//            curl_setopt($ch5, CURLOPT_FILE, $fp);
//            curl_setopt($ch5, CURLOPT_HEADER, 0);
//            curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch5, CURLOPT_SSL_VERIFYHOST, false);
//            curl_exec($ch5);
//            curl_close($ch5);
//            fclose($fp);
//        }

//        header('Location: adminPanel.php');

        }
    }

    die(json_encode(['status' => 200, 'data' => $data_for_js]));
}

load();

function check($head)
{
    $f = DB::query()->prepare('select heading from test_task.news where heading like :heading');
    $f->bindValue(':heading', $head);
    $f->execute();
    return $f->fetch();
}


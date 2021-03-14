<?php

include "connection.php";
session_start();




if(isset($_POST['del_remote']) && isset($_POST['news_id']) && isset($_POST['wp_id']))
{
    if(!empty($_POST['del_remote']) && !empty($_POST['news_id']) && !empty($_POST['wp_id']))
    {
        $news_id = $_POST['news_id'];
        $news_id = mysqli_real_escape_string($connection, $news_id);

        $wp_id = $_POST['wp_id'];


        $sql_content = "select * from web where newsid = '$news_id' ";
        $run_sql_content= mysqli_query($connection, $sql_content);
        $num_rows_content = mysqli_num_rows($run_sql_content);

        if($num_rows_content == 1)
        {

            $row_content = mysqli_fetch_assoc($run_sql_content);
            $videolong_full = $row_content['videolong'];
            $preview_full = $row_content['previewgif'];
            $thumbnail_full = $row_content['thumbnail'];
            $videolazy_full = $row_content['videolazy'];                            
            $newsbody_full = $row_content['newsbody'];

            $photos = $row_content['photos'];
            $photos_array = explode(',' , $photos);

            $audio = $row_content['audio'];
            $videoextra = $row_content['videoextra'];

            // $wp_id = $row_content['wp_post_id'];

            $data = array();
            $data = json_encode($data);
//".$wp_id
            $url = "http://nepalnewsclient.sanjeebkc.com.np/wp-json/wp/v2/haru_video/$wp_id" ;
            $curl = curl_init();
            curl_setopt_array($curl, array(                    
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => $data ,
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json",
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9uZXBhbG5ld3NjbGllbnQuc2FuamVlYmtjLmNvbS5ucCIsImlhdCI6MTYxNTIxOTU3NiwibmJmIjoxNjE1MjE5NTc2LCJleHAiOjE2MTU4MjQzNzYsImRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.GDpI7VZvC7aSRpSI62lDWX4qIX0AZXpwxK5_n3Zkx1U' 
                ),
            ));

            $response = curl_exec($curl);           
            $respCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $err = curl_error($curl);                    
            curl_close($curl);

            // $url = 'http://nepalnewsclient.sanjeebkc.com.np/wp-json/wp/v2/haru_video/'.$wp_id;
            //             $ch = curl_init();
            //             curl_setopt( $ch, CURLOPT_URL, $url );
            //             curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );                       
            //             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                        
            //             curl_setopt( $ch, CURLOPT_HTTPHEADER, [
            //                 'Content-Disposition: form-data; filename="sanjeeb1.png"',
            //                 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9uZXBhbG5ld3NjbGllbnQuc2FuamVlYmtjLmNvbS5ucCIsImlhdCI6MTYxNTIxOTU3NiwibmJmIjoxNjE1MjE5NTc2LCJleHAiOjE2MTU4MjQzNzYsImRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.GDpI7VZvC7aSRpSI62lDWX4qIX0AZXpwxK5_n3Zkx1U' 
            //                 ] );
                        
            //             $result = curl_exec( $ch );
            //             $respCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                          
            //             curl_close( $ch );




            // echo "Response code: ".$url;
            echo "Response code: ".$respCode;
            // echo "<br> Responce:  $response";

            if($respCode == 200 || $respCode == 202  || $respCode == 204 )
            {
                

                $sql_del_web = "update web set wp_post_id = null where newsid = '$news_id' ";
                $run_sql_del_web= mysqli_query($connection, $sql_del_web);

                if($run_sql_del_web)
                {
                    $_SESSION['notice_remote'] = "success_remote_delete";
                }

            }
            else
            {
                $_SESSION['notice_remote'] = "Error_remote_delete";
            }






        }


        
    }
}

header("Location: ". $_SERVER['HTTP_REFERER']);
exit();
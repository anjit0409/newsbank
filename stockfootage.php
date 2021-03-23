<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<style>
h4 {
    color: aliceblue;
    margin-bottom: 0;
    font-size: 1.2rem;
}
</style>

<body>
    <!-- Image and text -->
    <nav class="navbar shadow-lg navbar-dark bg-primary mb-3">
        <a class="navbar-brand" href="#">
            NEPAL NEWS BANK DASHBOARD
        </a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg  mb-5 bg-white rounded">
                    <div class="card-header bg-info ">
                        <h4>STOCK FOOTAGE</h4>
                    </div>
                    <div class="card-body">
                        <?php


                    if(isset($_SESSION['notice']) )
                    {
                        if($_SESSION['notice'] == 'Error_check_file')
                        {
                            $notice  = 'Error publishing. Please try again';
                            $bg_color = 'red';
                            $color = '#000';
                            $color_down = '#000';
                            

                        }

                        if($_SESSION['notice'] == 'success')
                        {
                            $notice  = 'Succesfully published!';
                            $bg_color = 'rgb(102, 255, 51,0.5)';
                            $color = '#009933';
                            $color_down = '#4BB543';
                            

                        }


                    ?>
                        <div class="alert m-3 alert-success fade show" role="alert"
                            style="background-color: <?php echo $bg_color ; ?>; color:<?php echo $color ; ?>">
                            <strong style="color:<?php echo $color_down ; ?>">Notice : </strong>
                            <?php echo $notice; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>



                        <?php
                            unset($_SESSION['notice']);
                    }
                    ?>

                        <form method="POST" action="accesories/stock_submit.php" enctype="multipart/form-data">

                        <input type="date" class="form-control" name="date" placeholder="Title">

                            <div class="form-group">
                                <label class=" p-0 col-lg-12">1.Stock Footage Title *
                                    <svg data-toggle="popover" title="News Title"
                                        data-content="Some content inside the popover"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-info-circle float-right help_icon" data-toggle="tooltip"
                                        data-placement="left" title="Tooltip on left" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>

                                </label>
                                <input class="form-control" name="title" placeholder="Title">

                            </div>
                            <!-- stock video  card -->
                            <div class="row">
                                <div class="col-sm-4 ">
                                    <div class="card ">
                                        <img src="./assets/images/placeholder.jpg" class="card-img-top "
                                            id="videolongplaceholder" alt="...">
                                        <div id="videolongID"></div>
                                        <div class="card-body">
                                            <span>2. Stock Video*</span>
                                            <div>
                                                <svg data-toggle="popover" title="News Title"
                                                    data-content="Some content inside the popover"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-info-circle float-right help_icon"
                                                    data-toggle="tooltip" data-placement="left" title="Tooltip on left"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg>
                                            </div>

                                            <input type="file" id="videolong" name="video"
                                                onchange="return videolongValidation()" required>
                                            <small id="emailHelp" class="form-text text-muted">5min to 7min
                                                video</small>

                                        </div>
                                    </div>
                                </div>
                                <!-- Select one image for news thumbnail-->
                                <div class="form-group col-sm-8">
                                    <label class=" p-0 col-lg-12">3.Stock Footage Thumbnail JPG *
                                        <svg data-toggle="popover" title="News Title"
                                            data-content="Some content inside the popover"
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-info-circle float-right help_icon"
                                            data-toggle="tooltip" data-placement="left" title="Tooltip on left"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>

                                    </label> <br>
                                    <input type="file" id="thumbnailimg" onchange="return thumbnailValidation()"
                                        name="thumb" accept="image/*" required>
                                    <!-- Image preview -->
                                    <div id="thumbnailID"></div>
                                    <br>
                                    <label class=" p-0 col-lg-12">4. Submit Stock Footage in website
                                        <div>
                                            <input value="Post Stock Footage" id="submitbtn" type="submit" name="submit" class="btn btn-primary mt-2"
                                               >
                                        </div>
                                        <div>
                                            <!-- <button id="loaderbtn" class="btn btn-warning mt-2" type="button"
                                                style="display: none;" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                                Posting Stock Footage ...
                                            </button> -->
                                        </div>


                        </form>


                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>

    <script>
    function submitloader() {
        document.getElementById("submitbtn").style.display = "none";
        document.getElementById("loaderbtn").style.display = "block";

    }
    </script>

    <script>
    // -------------thumbnail IMAGE VALIDATION------------------------ 
    function thumbnailValidation() {
        var fileInput =
            document.getElementById('thumbnailimg');

        var filePath = fileInput.value;
        console.log(filePath)
        // Allowing file type 
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif|\.JPG)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid Video thumbnail file extension.');
            fileInput.value = '';
            document.getElementById(
                    'thumbnailID').innerHTML =
                '<img style="display:none" class="shadow" src="'
            '"/>';
            return false;
        } else {

            // Image preview 
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                            'thumbnailID').innerHTML =
                        '<img style="display:block;height:150px;width:auto;padding-top:15px;" class="shadow" src="' +
                        e.target.result +
                        '"/>';
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
    </script>

    <script>
    // -------------Video long VALIDATION------------------------ 
    function videolongValidation() {
        var fileInput =
            document.getElementById('videolong');

        var filePath = fileInput.value;
        console.log(filePath)
        // Allowing file type 
        var allowedExtensions =
            /(\.mp4|\.jpeg)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid Video thumbnail file extension.');
            fileInput.value = '';
            document.getElementById(
                    'videolongID').innerHTML =
                '<video width="320" height="240" controls style="display:none"><source src="" type="video/mp4"></video>';
            return false;
        } else {

            // video long preview 
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                            'videolongID').innerHTML =
                        '<video width="100%" height="160px" controls style="display:block"><source src="' + e
                        .target.result + '" type="video/mp4"> </video> ';
                    document.getElementById('videolongplaceholder').style.display = "none"
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
    </script>



</body>

</html>
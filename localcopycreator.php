<?php
  session_start();
?>
<?php

  
date_default_timezone_set("Asia/Kathmandu");
$selected_date = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Local copy creator</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <!---- filter multi-select-- -->
    <link rel="stylesheet" href="assets/css/filter-multi-select.css" />
    <script src="assets/js/filter-multi-select-bundle.min.js"></script>
    <script src="assets/js/multi-select-tags.js"></script>

</head>
<style>
h4 {
    color: aliceblue;
    margin-bottom: 0;
    font-size: 1.2rem;
}

b {
    color: #000
}

.help_icon:hover {
    color: #007bff;
    cursor: pointer
}

.imageSelected {
    height: 150px;
    width: 150px;
}

@font-face {
    font-family: preeti;
    src: url(preeti.TTF);
}

.form-nepali {
    font-family: preeti;
}

.preview-images-zone {
    width: 100%;
    border: 1px solid #ddd;
    min-height: 180px;
    /* display: flex; */
    padding: 5px 5px 0px 5px;
    position: relative;
    overflow: auto;
}

.preview-images-zone>.preview-image:first-child {
    height: 185px;
    width: 185px;
    position: relative;
    margin-right: 5px;
}

.preview-images-zone>.preview-image {
    height: 90px;
    width: 90px;
    position: relative;
    margin-right: 5px;
    float: left;
    margin-bottom: 5px;
}

.preview-images-zone>.preview-image>.image-zone {
    width: 100%;
    height: 100%;
}

.preview-images-zone>.preview-image>.image-zone>img {
    width: 100%;
    height: 100%;
}

.preview-images-zone>.preview-image>.tools-edit-image {
    position: absolute;
    z-index: 100;
    color: #fff;
    bottom: 0;
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    display: none;
}

.preview-images-zone>.preview-image>.image-cancel {
    font-size: 18px;
    position: absolute;
    top: 0;
    right: 0;
    font-weight: bold;
    margin-right: 10px;
    cursor: pointer;
    display: none;
    z-index: 100;
}

.preview-image:hover>.image-zone {
    cursor: move;
    opacity: .5;
}

.preview-image:hover>.tools-edit-image,
.preview-image:hover>.image-cancel {
    display: block;
}

.ui-sortable-helper {
    width: 90px !important;
    height: 90px !important;
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
                        <h4>LOCAL COPY CREATOR</h4>
                    </div>
                    <div class="card-body">

                        <?php

                          if(isset($_SESSION['notice']) )
                          {
                            if($_SESSION['notice'] == 'Error')
                            {
                                $notice  = 'Error while creating local copy!';
                                $bg_color = 'red';
                                $color = '#000';
                                $color_down = '#000';
                                

                            }

                            if($_SESSION['notice'] == 'Success')
                            {
                                $notice  = 'Local copy creation successfull.';
                                $bg_color = 'rgb(102, 255, 51,0.5)';
                                $color = '#009933';
                                $color_down = '#4BB543';
                                $notice2 = "Database logging successfull.";
                                $sta = "succ";
                               

                            }


                          ?>

                        <div class="alert  alert-success fade show" role="alert"
                            style="background-color: <?php echo $bg_color ; ?>; color:<?php echo $color ; ?>">
                            <strong style="color:<?php echo $color_down ; ?>">Notice : </strong> <?php echo $notice; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php 
                            if(isset($sta))
                            {
                        ?>
                        <div class="alert  alert-success fade show" role="alert"
                            style="background-color: <?php echo $bg_color ; ?>; color:<?php echo $color ; ?>">
                            <strong style="color:<?php echo $color_down ; ?>">Notice : </strong> <?php echo $notice2; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                            }
                      



                                unset($_SESSION['notice']);
                              
                          }

                      ?>


                        <form method="POST" enctype="multipart/form-data" action="accesories/local_submit.php">
                            <!-- <form method="POST" enctype="multipart/form-data" action="accesories/test.php"> -->
                            <!-- The headline for news. -->

                            <STRONG>NEWS </strong>
                            <HR style="    border-top: 1px solid rgba(0,0,0)">

                            <div class="form-group">
                                <label class="col-lg-12 p-0">1. News Date*
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
                                <input type="date" class="form-control" name="newsdate"
                                    value="<?php echo $selected_date ; ?>" required>
                                <!-- make date today's date -->


                            </div>
                            <div class="form-group">
                                <label class=" p-0 col-lg-12">2.News Title*
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
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control col-lg-10" placeholder="Enter news byline" name="byLine" id="input_box" required  onkeydown="limit(this);" onkeyup="limit(this);charcountupdate(this.value)"> -->
                                    <div id="formByline" class="col-lg-10 pl-0">
                                    </div>
                                    <select class="custom-select my-1 col-lg-2" name='lang_selec'
                                        onchange="changeOrg()">
                                        <option value="nepali">Nepali Language</option>
                                        <option value="english">English Language</option>
                                        <option value="nepali_uni">Nepali Unicode Language</option>
                                    </select>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">
                                    <span id=charcount></span>

                                </small>



                            </div>






                            <!-- The body of news. Should extract text from file like txt and docs and pass to sql -->
                            <div class="form-group">
                                <label class="col-lg-12 p-0">2. News Body File*
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
                                <input type="file" id="myfile" name="descFile" required>
                                <small id="emailHelp" class="form-text text-muted">accepted formats : docx, txt.</small>
                            </div>



                            <STRONG>VIDEOS </strong>
                            <HR style="    border-top: 1px solid rgba(0,0,0)">
                            <div class="row">
                                <!--Select video and pass to sql-->





                                <!-- video long card -->
                                <div class="col-sm-4">
                                    <div class="card ">
                                        <img src="./assets/images/placeholder.jpg" class="card-img-top "
                                            id="videolongplaceholder" alt="...">
                                        <div id="videolongID"></div>
                                        <div class="card-body">
                                            <span>4. Video long*</span>
                                            <div class="float-right">
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

                                            <input type="file" id="videolong" name="videoLongFile"
                                                onchange="return videolongValidation()" required>
                                            <small id="emailHelp" class="form-text text-muted">5min to 7min
                                                video</small>

                                        </div>
                                    </div>
                                </div>
                                <!-- --------------- -->
                                <!-- video lazy card -->
                                <div class="col-sm-4">
                                    <div class="card ">
                                        <img src="./assets/images/placeholder.jpg" class="card-img-top "
                                            id="videolazyplaceholder" alt="...">
                                        <div id="videolazyID"></div>
                                        <div class="card-body">
                                            <span>5. Video lazy*</span>
                                            <div class="float-right">
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
                                            <input type="file" id="videolazy" name="videoLazy"
                                                onchange="return videolazyValidation()" required>
                                            <small id="emailHelp" class="form-text text-muted">Video should be less than
                                                3 minutes</small>

                                        </div>
                                    </div>
                                </div>
                                <!-- --------------- -->
                                <!-- video extra card -->
                                <div class="col-sm-4">
                                    <div class="card ">
                                        <img src="./assets/images/placeholder.jpg" class="card-img-top "
                                            id="videoextraplaceholder" alt="...">
                                        <div id="videoextraID"></div>
                                        <div class="card-body">
                                            <span>6. Video extra</span>
                                            <div class="float-right">
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
                                            <input type="file" id="videoextra" name="videoExtra"
                                                onchange="return videoextraValidation()">
                                            <small id="emailHelp" class="form-text text-muted">Video should be less than
                                                3 minutes</small>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- --------------- -->

                            <!-- The tags for news. example: sports,football,messi,goal. Should be in CSV(comma separated format) -->
                            <div class="form-group">
                                <label class="col-lg-12 p-0">6. News Tags*</label>
                                <!-- <input type="text" class="form-control" placeholder="Enter news byline" name="newsTag" required> -->
                                <select multiple name="newsTag[]" id="animals">
                                    <option value="Politics">Politics</option>
                                    <option value="Sports">Sports</option>
                                    <option value="International">International</option>
                                    <option value="Glamour">Glamour</option>
                                    <option value="frog">Frog</option>
                                    <option value="shark">Shark</option>
                                </select>
                            </div>
                            <!-- Select one audio file -->
                            <STRONG>AUDIO </strong>
                            <HR style="    border-top: 1px solid rgba(0,0,0)">

                            <div class="form-group ">
                                <label class="col-lg-12 p-0">7. Audio
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

                                </label><br>
                                <input type="file" id="img" name="audio">
                            </div>

                            <STRONG>IMAGES </strong>
                            <HR style="    border-top: 1px solid rgba(0,0,0)">
                            <!-- Select one image for news preview image-->
                            <div class="form-group">
                                <label class="col-lg-12 p-0">8. Video Preview GIF*
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

                                </label><br>
                                <input type="file" id="previewimg" onchange="return previewValidation()"
                                    name="previewImg" accept="image/*" required>
                                <!-- Image preview -->
                                <div id="previewID"></div>
                            </div>





                            <!-- Select one image for news thumbnail-->
                            <div class="form-group">
                                <label class="col-lg-12 p-0">9. Video Thumbnail JPG*
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

                                </label><br>
                                <input type="file" id="thumbnailimg" onchange="return thumbnailValidation()"
                                    name="thumbImg" accept="image/*" required>
                                <!-- Image preview -->
                                <div id="thumbnailID"></div>
                            </div>


                            <!-- Select multiple image for news body images-->
                            <!-- <div class="form-group">
                                <label class="col-lg-12 p-0">10. Gallery Images*
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

                                </label><br>
                                <input type="file" id="galleryimg" name="galleryImage[]" accept="image/*" multiple
                                    required>
                            </div> -->

                            <div class="form-group">
                                <a>10. Gallery Image</a>
                                <input type="file" id="pro-image" name="galleryImage[]" class="form-control"
                                    accept="image/*" multiple>
                                <!-- onclick="$('#pro-image').click()" -->
                                <div class="preview-images-zone" style="display:none">
                                </div>
                            </div>

                            <STRONG>OTHERS </strong>
                            <HR style="    border-top: 1px solid rgba(0,0,0)">

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">11. Is Exclusive?*
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

                                        </label>

                                        <!-- <select class="form-control" name="news_type" required>
                                            <option value='yes' selected>YES</option>
                                            <option value="no">NO</option>
                                        </select> -->

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input " id="customSwitch1" value="1" >
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">12. Created By*
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

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="uploaded_by"
                                            required>
                                            <option value="hari bahadur">Hari Bahadur</option>
                                            <option value="madan bahadur">Madan Bahadur</option>
                                            <option value="ribik khoteja">Ribik Khoteja</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">13. Reporter*
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


                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="reporter"
                                            required>
                                            <option value="rabi lamicchane">Rabi Lamicchane</option>
                                            <option value="prem baniya">Prem Baniya</option>
                                            <option value="yuvraj kandel">Yuvraj Kandel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">14. Camera Man*
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

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="camera_man"
                                            required>
                                            <option value="shiva pangeni">Shiva Pangeni</option>
                                            <option value="sanjeeb kC">Sanjeeb KC</option>
                                            <option value="anish luitel">Anish Luitel</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">15. District*
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

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="district"
                                            required>
                                            <option value="kathmandu">Kathmandu</option>
                                            <option value="bhaktapur">Bhaktapur</option>
                                            <option value="lalitpur">Lalitpur</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-12 p-0">16. Available for*
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

                                        </label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="subs_type"
                                            required>
                                            <option value="basic">Basic</option>
                                            <option value="premium">Premium</option>
                                            <option value="platinum">Platinum</option>
                                        </select>                                       
                                    </div>
                                </div>
                            </div>











                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- FORM DOM FOR LANGUAGE SELECTION IN NEWS TITLE--- -->

        <script>
        // $('#newsTag[]--1-chbx').hide();

        var s = document.getElementsByName('lang_selec')[0];

        function changeOrg() {
            var value = s.options[s.selectedIndex].value;
            // console.log(value);
            if (value == 'nepali') {
                document.getElementById('formByline').innerHTML =
                    `<input type="text" style="width:100%;" class="form-control form-nepali" placeholder=";dfrf/sf] lzif{s " name="byLine" id="input_box" required  onkeydown="limit(this);" onkeyup="limit(this);charcountupdate(this.value)">`
            }
            if (value == 'english') {
                document.getElementById('formByline').innerHTML =
                    `<input type="text" style="width:100%;" class="form-control" placeholder="Enter news byline english" name="byLine" id="input_box" required  onkeydown="limit(this);" onkeyup="limit(this);charcountupdate(this.value)">`
            }
            if (value == 'nepali_uni') {
                document.getElementById('formByline').innerHTML =
                    `<input type="text" style="width:100%;" class="form-control" placeholder="Enter news byline in nepali unicode" name="byLine" id="input_box" required  onkeydown="limit(this);" onkeyup="limit(this);charcountupdate(this.value)">`
            }
        }
        //on page load
        changeOrg();
        </script>

        <!-- ---NEWS BODY FILE VALIDATION -->


        <script>
        // -------------preview IMAGE VALIDATION------------------------ 
        function previewValidation() {
            var fileInput =
                document.getElementById('previewimg');

            var filePath = fileInput.value;
            console.log(filePath)
            // Allowing file type 
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif|\.JPG)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid Video preview file extension.');
                fileInput.value = '';
                document.getElementById(
                        'previewID').innerHTML =
                    '<img style="display:none" class="shadow" src="'
                '"/>';
                return false;
            } else {

                // Image preview 
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                                'previewID').innerHTML =
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

        <script>
        // -------------Video lazy VALIDATION------------------------ 
        function videolazyValidation() {
            var fileInput =
                document.getElementById('videolazy');

            var filePath = fileInput.value;
            console.log(filePath)
            // Allowing file type 
            var allowedExtensions =
                /(\.mp4|\.jpeg)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid Video lazy file extension.');
                fileInput.value = '';
                document.getElementById(
                        'videolazyID').innerHTML =
                    '<video width="320" height="240" controls style="display:none"><source src="" type="video/mp4"></video>';
                return false;
            } else {

                // video long preview 
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                                'videolazyID').innerHTML =
                            '<video width="100%" height="160px" controls style="display:block"><source src="' + e
                            .target.result + '" type="video/mp4"> </video> ';
                        document.getElementById('videolazyplaceholder').style.display = "none"
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
        </script>
        <script>
        // -------------Video extra VALIDATION------------------------ 
        function videoextraValidation() {
            var fileInput =
                document.getElementById('videoextra');

            var filePath = fileInput.value;
            console.log(filePath)
            // Allowing file type 
            var allowedExtensions =
                /(\.mp4|\.jpeg)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid Video lazy file extension.');
                fileInput.value = '';
                document.getElementById(
                        'videoextraID').innerHTML =
                    '<video width="320" height="240" controls style="display:none"><source src="" type="video/mp4"></video>';

                return false;
            } else {

                // video extra preview 
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                                'videoextraID').innerHTML =
                            '<video width="100%" height="160px" controls style="display:block"><source src="' + e
                            .target.result + '" type="video/mp4"> </video> ';
                        document.getElementById('videoextraplaceholder').style.display = "none"
                    };



                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
        </script>
        <!-- -------------TOOLTIP ------------------------ -->
        <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
        </script>
        <script>
        // Use the plugin once the DOM has been loaded.
        $(function() {
            // Apply the plugin 
            var animals = $('#animals').filterMultiSelect();

            $('#jsonbtn1').click((e) => {
                var b = true;
                var result = {
                    ...JSON.parse(animals.getSelectedOptionsAsJson(b)),

                }
                $('#jsonresult1').text(JSON.stringify(result, null, "  "));
            });
            $('#jsonbtn2').click((e) => {
                var b = false;
                var result = {
                    ...JSON.parse(animals.getSelectedOptionsAsJson(b)),

                }
                $('#jsonresult2').text(JSON.stringify(result, null, "  "));
            });
            $('#form').on('keypress keyup', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
        </script>        

        <!-- count character in news title -->
        <script>
        function charcountupdate(str) {
            var lng = str.length;
            document.getElementById("charcount").innerHTML = lng + ' out of 300 characters';
            if (lng == 300) {
                console.log('exceedde')
                document.getElementById("charcount").style.color = "red"
            } else {
                document.getElementById("charcount").style.color = "#6c757d"
            }
        }
        </script>

        <!-- restrict number of words in news title -->
        <script>
        function limit(element) {
            var max_chars = 300;

            if (element.value.length > max_chars) {
                element.value = element.value.substr(0, max_chars);
            }
        }
        </script>

        <script>
        $(document).ready(function() {
            document.getElementById('pro-image').addEventListener('change', readImage, false);
            // $( ".preview-images-zone" ).sortable();
            $(document).on('click', '.image-cancel', function() {
                let no = $(this).data('no');
                $(".preview-image.preview-show-" + no).remove();
            });

            $("#pro-image").click(function() {
                // $(".preview-images-zone").empty();
            });

        });
        var num = 0;

        function readImage() {
            if (window.File && window.FileList && window.FileReader) {
                var files = event.target.files; //FileList object
                $(".preview-images-zone").css("display", "block");
                var output = $(".preview-images-zone");
                for (let i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (!file.type.match('image')) continue;
                    var picReader = new FileReader();
                    picReader.addEventListener('load', function(event) {
                        var picFile = event.target;
                        var html = '<div class="preview-image  preview-show-' + num + '">' +
                            '<a  class="image-cancel" data-no="' + num + '">x</a>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                            '"></div>' +
                            '</div>';
                        output.append(html);
                        num = num + 1;
                    });
                    picReader.readAsDataURL(file);
                }
                // $("#pro-image").val('');
            } else {
                console.log('Browser not support');
            }
        }



        $(document).on('click', '.exclusive', function() {

        var condition = $(this).prop("checked");
        
        if(condition == 1)
        {
            var value = 1 ;
        }
        else
        {
            var value = 0 ;
        }

        $(".exclusive").val(value);
      
        });



       
        </script>


</body>

</html>
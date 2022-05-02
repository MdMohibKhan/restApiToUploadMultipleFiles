<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Upload Video File </title>

        <style type="text/css">
            /* ------------- */

        </style>

    </head>
    <body>
        <br>
        <center>
            <div style="background-color:#CBCE91FF; width:400px; padding:20px;">
                <h1> Upload Video File </h1>
                <br>
                <form method="post" action="<?php echo base_url(); ?>uploadVideos" enctype="multipart/form-data">

                    <input type="hidden" name="requestFrom" value="web">

                    <label for="fileToUpload">Select files:</label>
                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple><br><br>
                    <div id="progressgif" style="display:none;"> <img src="<?php echo base_url();?>img/progress.gif" style="width:15%;height:15%;"> </div>
                
                    <br><br>
                    
                    <input type="submit" id="submitBtn">
                </form>
            </div>
        </center>
        <br>

        <script>

            var btn=document.getElementById("submitBtn");
            var img=document.getElementById("progressgif");
            btn.onclick=function(){
                img.style.display="block";
            }

            </script>

    </body>

</html>
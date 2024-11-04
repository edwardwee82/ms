<?php
    function callHeader()
    {
        $x='
        <!--<script src="https://cdn.tiny.cloud/1/tjwm8rfvtvnbrk7m1slkwdirjauctg8cffuleg4oqw3y4324/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>-->
        <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
            <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        ';
        return $x;
    }


    function jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col, $height)
    {

            $x="
            <script type=\"text/javascript\">
            tinymce.init({
                selector: 'textarea#$ttype$tbid',
                plugins: 'save anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code',
                menubar: false, 
                toolbar: 'save undo redo blocks bold italic underline strikethrough | link image media table | numlist bullist code',
                license_key: 'gpl',
                height: $height, 
                statusbar: false,
                save_onsavecallback: function () {
                   var content = tinymce.get('$ttype$tbid').getContent(); 
                   //alert(\"Content saved: \" + content); // For demo purposes, use this or send it to your server 
                   submitcd$tbid('$ttype$tbid');
                   
                  }
            });

            
            function submitcd$tbid(tbid) {
                
                var content = tinymce.get(tbid).getContent();
                
                $.ajax({
                  url: './api/upd_tb.php',
                  type: 'POST',
                  data: { content: content, id: $id, idcol:'$idcol', type: '$ttype', tbl:'$tbl', col:'$col'},
                    success: function(response) {
                    alert('Content saved successfully!');
                  },
                  error: function() {
                    alert('An error occurred.');
                  }
                });
              }
            
            </script>";
            $x.="<form id='frm$ttype$tbid'>            
                    <textarea id='$ttype$tbid'>$content</textarea>
                </form>        ";
            return $x;
    }
    function jsChkboxbool($tbid, $idcol,$id, $tbl, $val, $col)
    {
//cant use
            $x="
            <script type=\"text/javascript\">
            $(document).ready(function() {
              $(\"#$tbid\").change(function() {
                var val=$(\"tbid\").val()
                  alert(val);
                });
            });

           
            </script>";
            $x.="<select name=\"$tbid\" id=\"$tbid\" onchange=\"submitcb$tbid('$tbid')\">
                <option value=\"Yes\">Yes</option>
                <option value=\"No\" SELECTED>No</option>
            </select>";
            return $x;
    }
    
?>
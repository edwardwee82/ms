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


    function jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col)
    {

            $x="
            <script type=\"text/javascript\">
            tinymce.init({
                selector: 'textarea#$ttype$tbid',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
            
            function submitcd(tbid) {
                
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
                    <button type='button' onclick='submitcd(\"$ttype$tbid\")'>Submit</button>
                </form>
        ";
            return $x;
    }
    
?>
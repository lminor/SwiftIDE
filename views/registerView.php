<?php
    /* TODO: COMPRESS VIEWS INTO SINGLE VIEW. */
    class registerView {
        public function show($template, $data = array(), $title = ''){
            $templatePath = "views/${template}.inc";

            if ( file_exists($templatePath) ){
                include($templatePath);
            }
        }
    }
?>
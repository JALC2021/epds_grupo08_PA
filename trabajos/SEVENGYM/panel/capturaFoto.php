<?php
session_start();
class WebCamUpload {
   var $input          = null;
   var $serverRequest  = null;
   function __construct($serv,$in){
       $this->input = $in;
       $this->serverRequest = $serv;
   }
   function saveImage($dir='') {
       $filename = md5(date('YmdHisu')) . '.jpg';
       $_SESSION['userfoto'] = $filename;
       $result = file_put_contents($dir.$filename, $this->input );
       if (!$result) {
           throw new Exception("No se pudo guardar la imagen, revisa permisos");
           exit();
       }
       return 'http://' . $this->serverRequest['HTTP_HOST'] . dirname($this->serverRequest['REQUEST_URI']) . '/' .$dir. $filename;
   }
}

try {
   $cam = new WebCamUpload($_SERVER,file_get_contents('php://input'));
   echo $cam->saveImage('fotos/');
}catch(Exception $e) {
   echo $e->getMessage();
}

?>
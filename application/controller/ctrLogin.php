<?php 

class CtrLogin extends Controller
{
	private $mdlModel = null;

	function __construct()
	{
	  $this->mdlModel = $this->loadModel("mdlLogin");
	}

    public function login(){
        include APP. 'view/login/login.php';
        if(isset($_POST['btnLogin'])){

            $usuario = $this->mdlModel->consultarUsuarioLogin($_POST["txtUsuario"]);

            if ($usuario && $usuario['Clave'] == sha1($_POST["txtClave"])) {
                $this->mdlModel->__SET("id_rol", $usuario['Tbl_Roles_Id_Rol']);
                $permisos = $this->mdlModel->obtenerPermisos();

                $_SESSION['permisos'] = $permisos;
                $_SESSION['user'] = $usuario;

                header("location: ". URL . "home/index");

                if ($usuario['Estado'] == 0) {
                    $_SESSION["mensaje"] = "Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Este usuario se encuentra deshabilitado'});";
                    header("location: ". URL . "ctrLogin/login");
                }

            }else{
                $_SESSION["mensaje"] = "Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Usuario o clave incorrecta'});";
                header("location: ". URL . "ctrLogin/login");
            }
        }
    }


    public function cerrarSesion(){
        session_unset();
        session_destroy();
        header("location: ". URL . "ctrLogin/login");
    }


    public function recuperarPass(){
        include APP. 'view/login/recuperar.php'; 

        if (isset($_POST['btnRecuperar'])) {

            $file = "";
            $fp = fopen(APP."config/remitente_correo.txt", "r");
            for ($i=0; $i <= 2; $i++) { 
                $file[$i] = fgets($fp);
            }
            fclose($fp);

            $sw = 0;
            $emails = $this->mdlModel->traerEmails();

            foreach ($emails as $value) {
                if ($value["Email"] == $_POST["txtEmail"]) {


                    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890-/*.";
                    $cad = "";
                    for($i=0; $i<12; $i++) {
                        $cad .= substr($str,rand(0,62),1);
                    }

                    $this->mdlModel->__SET("codigo", $value["Id_Usuario"]);
                    $this->mdlModel->__SET("clave", sha1($cad));
                    $this->mdlModel->cambiarClave();

                    require APP.'libs/PHPMailer/PHPMailerAutoload.php';
 
                    $correo = new PHPMailer();
                    $correo->IsSMTP();
                    $correo->SMTPAuth = true;
                    $correo->SMTPSecure = 'tls';
                    $correo->Host = $file[2];
                    $correo->Port = 587;
                    $correo->Username   = $file[0];
                    $correo->Password   = $file[1];
                    $correo->setFrom($file[0], $file[0]);
                    $correo->AddAddress($value["Email"], "");
                    $correo->Subject = "Recuperación de contraseña ModArtex";
                    $correo->MsgHTML("Su nueva contraseña es: <strong>".$cad."</strong>");
                    $correo->CharSet = 'UTF-8';
                     
                    // $correo->AddAttachment("images/phpmailer.gif");
                     
                    if(!$correo->Send()) {
                      $_SESSION["mensaje"] = "Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Hubo un error al enviar el correo'});";
                    } else {
                      $_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La nueva clave fue enviada a su correo'});";
                      header("location:".URL."ctrLogin/login");
                    }
                    $sw = 1;
                }
            }
            if($sw == 0) {
                 $_SESSION["mensaje"] = "Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Correo no encontrado'});";
                 header("location:".URL."ctrLogin/recuperarPass");
            }  
        }
    }
}




 
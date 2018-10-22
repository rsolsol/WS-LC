<?php
require_once './clases/conexion.php';

class consulta_Licencia {
    private $tipoDoc; // 1 = DNI y 2 = RUC
    private $numDoc;
    const TABLA = 'lic_solicitud';

    public function setTipoDoc($tipoDoc) {return $this->tipoDoc;}
    public function setNunDoc($numDoc) {return $this->numDoc;}

    public function __construct ($tipoDoc = null, $numDoc= null){
        $this->tipoDoc = $tipoDoc;
        $this->numDOc = $numDoc;
    }

    public function listar($tipoDoc=null,$numDoc=null){
        $conexionLicenia = new Conexion();
        if ($tipoDoc==1) {
           // $consulta = $conexionLicenia->prepare('SELECT * FROM '. self::TABLA . ' WHERE lic_solicitud.vDNI_SOL = :numDoc');
            $consulta = $conexionLicenia->prepare("SELECT "."sisdeci.razon_social_desaeco Raz_Social, sisdeci.direccion_desaeco direc, sisdeci.res_deseco numReso, sisdeci.lic_desa_eco numLic, lic_giro.vDESC_GIRO giroGeneral FROM ". self::TABLA ." INNER JOIN bd_sisdeci.lic_desa_econo as sisdeci ON lic_solicitud.ID_SOLICITUD_SOL = sisdeci.id_solicitud_sol INNER JOIN lic_clasifica_giro as giro ON lic_solicitud.ID_SOLICITUD_SOL = giro.ID_SOLICITUD_SOL INNER JOIN lic_giro ON giro.id_giro = lic_giro.ID_GIRO where lic_solicitud.vDNI_SOL = :numDoc");
        }elseif ($tipoDoc==2) {
            $consulta = $conexionLicenia->prepare("SELECT "."sisdeci.razon_social_desaeco Raz_Social, sisdeci.direccion_desaeco direc, sisdeci.res_deseco numReso, sisdeci.lic_desa_eco numLic, lic_giro.vDESC_GIRO giroGeneral FROM ". self::TABLA ." INNER JOIN bd_sisdeci.lic_desa_econo as sisdeci ON lic_solicitud.ID_SOLICITUD_SOL = sisdeci.id_solicitud_sol INNER JOIN lic_clasifica_giro as giro ON lic_solicitud.ID_SOLICITUD_SOL = giro.ID_SOLICITUD_SOL INNER JOIN lic_giro ON giro.id_giro = lic_giro.ID_GIRO where lic_solicitud.vRUC_SOL = :numDoc");
        }else {
            exit();
        }
        //$consulta->bindParam(':tipoDoc',$this->tipoDoc);
        $consulta->bindParam(':numDoc',$numDoc);
        $consulta->execute();
        $registro=$consulta->fetchAll(PDO::FETCH_ASSOC);
        if ($registro) {
            //return $registro[0]['vNOM_RAZON_SOL'];
            return json_encode($registro);
        }else {
            return false;
        }
    }                
}

/*

if (!mysqli_set_charset($con, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($con));
    exit();
} else {
    printf("", mysqli_character_set_name($con));
}
    $peti = "";

    switch ($valor) {
        case 'nu_expe_todo':{
            $peti = "SELECT 
                        lic_solicitud.nNUMERO_EXP_SOL,
                        lic_solicitud.dFECHA_INGRESO,
                        lic_solicitud.vNOM_RAZON_SOL,
                        concat_ws('', lic_solicitud.vAVDA_SOL, lic_solicitud.nNUMCASA_SOL, lic_solicitud.nINT_SOL, lic_solicitud.vMZ_SOL, lic_solicitud.nLOTE_SOL) as direccion 
                FROM
                        lic_solicitud 
                WHERE
                        lic_solicitud.nNUMERO_EXP_SOL = '{$numero}'";
        }
            break;
        case 'nu_docu':{
            $peti = "SELECT 
                        lic_solicitud.nNUMERO_EXP_SOL,
                        lic_solicitud.dFECHA_INGRESO,
                        lic_solicitud.vNOM_RAZON_SOL,
                        concat_ws('', lic_solicitud.vAVDA_SOL, lic_solicitud.nNUMCASA_SOL, lic_solicitud.nINT_SOL, lic_solicitud.vMZ_SOL, lic_solicitud.nLOTE_SOL) as direccion 
                FROM
                        lic_solicitud 
                WHERE
                        lic_solicitud.vDNI_SOL = '{$numero}'";
        }
            break;    
        case 'nu_ruc':{
            $peti = "SELECT 
                        lic_solicitud.nNUMERO_EXP_SOL,
                        lic_solicitud.dFECHA_INGRESO,
                        lic_solicitud.vNOM_RAZON_SOL,
                        concat_ws('', lic_solicitud.vAVDA_SOL, lic_solicitud.nNUMCASA_SOL, lic_solicitud.nINT_SOL, lic_solicitud.vMZ_SOL, lic_solicitud.nLOTE_SOL) as direccion 
                FROM
                        lic_solicitud 
                WHERE
                        lic_solicitud.vRUC_SOL = '{$numero}'";
        }
            break;
        default:
                //
            break;
    }



    }*/
?>
<?php

require '../../database/DataBaseConexion.php';

class EmpresaADO
{

    function construct()
    {
    }

    public static function ObtenerEmpresa()
    {
        try {
            $comando = Database::getInstance()->getDb()->prepare("SELECT TOP 1 * FROM EmpresaTB");
            $comando->execute();
            $row = $comando->fetch();
            $object  = (object)array(
                "IdEmpresa" => $row['IdEmpresa'],
                "GiroComercial" => $row['GiroComercial'],
                "Nombre" => $row['Nombre'],
                "Telefono" => $row['Telefono'],
                "Celular" => $row['Celular'],
                "PaginaWeb" => $row['PaginaWeb'],
                "Email" => $row['Email'],
                "Domicilio" => $row['Domicilio'],
                "TipoDocumento" => $row['TipoDocumento'],
                "NumeroDocumento" => $row['NumeroDocumento'],
                "RazonSocial" => $row['RazonSocial'],
                "NombreComercial" => $row['NombreComercial'],
                "Image" => $row['Image'] == null ? "" : base64_encode($row['Image']),
                "UsuarioSol" => $row['UsuarioSol'],
                "ClaveSol" => $row['ClaveSol'],
                "CertificadoRuta" => $row['CertificadoRuta'],
                "CertificadoClave" => $row['CertificadoClave']
            );

            return $object;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CrudEmpresa($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $path = "";
            if ($body["certificadoType"] == 1) {
                $ext = pathinfo($body['certificadoName'], PATHINFO_EXTENSION);
                $file_path = $body['txtNumDocumento'] . "." . $ext;
                $path = "../../resources/" . $file_path;
                $move = move_uploaded_file($body['certificadoNameTmp'], $path);
                if (!$move) {
                    throw new Exception('Problemas al subir el certificado.');
                }

                $pkcs12 = file_get_contents($path);
                $certificados = array();
                $respuesta = openssl_pkcs12_read($pkcs12, $certificados, $body['txtClaveCertificado']);

                if ($respuesta) {
                    $publicKeyPem  = $certificados['cert']; //Archivo público
                    $privateKeyPem = $certificados['pkey']; //Archivo privado
                    file_put_contents('../../resources/cert.pem', $privateKeyPem.''. $publicKeyPem );
                    chmod("../../resources/cert.pem", 0777);
                   // file_put_contents('../../resources/private_key.pem', $privateKeyPem);
                  //  file_put_contents('../../resources/public_key.pem', $publicKeyPem);
                   // chmod("../../resources/private_key.pem", 0777);
                 //   chmod("../../resources/public_key.pem", 0777);
                } else {
                    throw new Exception('Error en crear las llaves del certificado.');
                }
            } else {
                $path = $body["certificadoUrl"];
            }

            if ($body["imageType"] == 1) {
                $comando = Database::getInstance()->getDb()->prepare("UPDATE EmpresaTB SET 
                NumeroDocumento = ?,
                RazonSocial=?,
                NombreComercial=?,
                Domicilio=?,
                Telefono = ?,
                Celular=?,
                PaginaWeb=?,
                Email=?,
                Image=?,
                UsuarioSol=?,
                ClaveSol=?,
                CertificadoRuta=?,
                CertificadoClave=?
                WHERE IdEmpresa = ?");
                $comando->bindParam(1, $body['txtNumDocumento'], PDO::PARAM_STR);
                $comando->bindParam(2, $body['txtRazonSocial'], PDO::PARAM_STR);
                $comando->bindParam(3, $body['txtNomComercial'], PDO::PARAM_STR);
                $comando->bindParam(4, $body['txtDireccion'], PDO::PARAM_STR);
                $comando->bindParam(5, $body['txtTelefono'], PDO::PARAM_STR);
                $comando->bindParam(6, $body['txtCelular'], PDO::PARAM_STR);
                $comando->bindParam(7, $body['txtPaginWeb'], PDO::PARAM_STR);
                $comando->bindParam(8, $body['txtEmail'], PDO::PARAM_STR);
                $comando->bindParam(9, $body['image'],  PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
                $comando->bindParam(10, $body['txtUsuarioSol'], PDO::PARAM_STR);
                $comando->bindParam(11, $body['txtClaveSol'], PDO::PARAM_STR);
                $comando->bindParam(12, $path, PDO::PARAM_STR);
                $comando->bindParam(13, $body['txtClaveCertificado'], PDO::PARAM_STR);
                $comando->bindParam(14, $body['idEmpresa'], PDO::PARAM_INT);
                $comando->execute();
            } else {
                $comando = Database::getInstance()->getDb()->prepare("UPDATE EmpresaTB SET 
                NumeroDocumento = ?,
                RazonSocial=?,
                NombreComercial=?,
                Domicilio=?,
                Telefono = ?,
                Celular=?,
                PaginaWeb=?,
                Email=?,
                UsuarioSol=?,
                ClaveSol=?,
                CertificadoRuta=?,
                CertificadoClave=?
                WHERE IdEmpresa = ?");
                $comando->bindParam(1, $body['txtNumDocumento'], PDO::PARAM_STR);
                $comando->bindParam(2, $body['txtRazonSocial'], PDO::PARAM_STR);
                $comando->bindParam(3, $body['txtNomComercial'], PDO::PARAM_STR);
                $comando->bindParam(4, $body['txtDireccion'], PDO::PARAM_STR);
                $comando->bindParam(5, $body['txtTelefono'], PDO::PARAM_STR);
                $comando->bindParam(6, $body['txtCelular'], PDO::PARAM_STR);
                $comando->bindParam(7, $body['txtPaginWeb'], PDO::PARAM_STR);
                $comando->bindParam(8, $body['txtEmail'], PDO::PARAM_STR);
                $comando->bindParam(9, $body['txtUsuarioSol'], PDO::PARAM_STR);
                $comando->bindParam(10, $body['txtClaveSol'], PDO::PARAM_STR);
                $comando->bindParam(11, $path, PDO::PARAM_STR);
                $comando->bindParam(12, $body['txtClaveCertificado'], PDO::PARAM_STR);
                $comando->bindParam(13, $body['idEmpresa'], PDO::PARAM_INT);
                $comando->execute();
            }

            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            unlink('../../resources/' . $file_path);
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }
}

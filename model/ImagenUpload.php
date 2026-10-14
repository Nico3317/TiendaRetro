<?php

class ImagenUpload {
    const MAX_BYTES = 5242880;     
    const MAX_LADO = 900;          
    const MAX_PIXELES = 25000000;   
    const TIPOS = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];


    public static function guardar($archivo, &$error) {
        $error = '';
        if (!$archivo || $archivo['error'] === UPLOAD_ERR_NO_FILE) return null;
        if ($archivo['error'] === UPLOAD_ERR_INI_SIZE || $archivo['error'] === UPLOAD_ERR_FORM_SIZE) {
            $error = 'La imagen es demasiado pesada.';
            return null;
        }
        if ($archivo['error'] !== UPLOAD_ERR_OK) { $error = 'No se pudo subir la imagen.'; return null; }
        if ($archivo['size'] > self::MAX_BYTES) { $error = 'La imagen supera los 5 MB.'; return null; }

        $info = @getimagesize($archivo['tmp_name']);
        if (!$info || !isset(self::TIPOS[$info['mime']])) {
            $error = 'Formato no válido (solo JPG, PNG o WEBP).';
            return null;
        }
        if ($info[0] * $info[1] > self::MAX_PIXELES) {
            $error = 'Las dimensiones de la imagen son demasiado grandes.';
            return null;
        }

        $ext = self::TIPOS[$info['mime']];
        $nombre = bin2hex(random_bytes(8)) . '.' . $ext;  
        $destino = __DIR__ . '/../img/juegos/' . $nombre;

        if (self::procesar($archivo['tmp_name'], $info, $destino)) return $nombre;

        $error = 'No se pudo guardar la imagen.';
        return null;
    }

    private static function procesar($origen, $info, $destino) {
        if (!function_exists('imagecreatefromstring')) {
            return is_uploaded_file($origen) && move_uploaded_file($origen, $destino);
        }

        $img = @imagecreatefromstring(file_get_contents($origen));
        if (!$img) return false;

        $ancho = imagesx($img);
        $alto = imagesy($img);
        $lado = max($ancho, $alto);
        if ($lado > self::MAX_LADO) {
            $k = self::MAX_LADO / $lado;
            $nuevo = imagescale($img, max(1, (int)round($ancho * $k)), max(1, (int)round($alto * $k)));
            if ($nuevo) $img = $nuevo;
        }

        if ($info['mime'] === 'image/png') {
            imagealphablending($img, false);
            imagesavealpha($img, true);
            return imagepng($img, $destino, 8);
        }
        if ($info['mime'] === 'image/webp') return imagewebp($img, $destino, 82);
        return imagejpeg($img, $destino, 82);
    }

    public static function borrar($nombre) {
        if ($nombre && preg_match('/^[a-f0-9]{16}\.(jpg|png|webp)$/', $nombre)) {
            @unlink(__DIR__ . '/../img/juegos/' . $nombre);
        }
    }
}

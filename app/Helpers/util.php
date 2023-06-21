<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function SaveLogError($NombreEvento, $excepcion, $ParametrosEnviados)
{
    $archivo = date("Y-m-d") . ".txt";
    Storage::disk("Logs")->append($archivo, "----------------------------------[ " . date("Y-m-d H:i:s") . " ]----------------------------------");
    $texto = "[METODO/FUNCION]: " . $NombreEvento;
    Storage::disk("Logs")->append($archivo, $texto);
    if ($excepcion) {
        $texto = "[MENSAJE]: " . $excepcion->getMessage();
        Storage::disk("Logs")->append($archivo, $texto);
        $texto = "[LINEA]: " . $excepcion->getLine();
        Storage::disk("Logs")->append($archivo, $texto);
        $texto = "[ARCHIVO]: " . $excepcion->getFile();
        Storage::disk("Logs")->append($archivo, $texto);
    }
    $texto = "[PARAMETROS]: " . json_encode($ParametrosEnviados);
    Storage::disk("Logs")->append($archivo, $texto);
    Storage::disk("Logs")->append($archivo, "");
}

function subir_imagen_desde_file($imagen, $discoVirtual, $prefijo)
{
    try {
        $imagenAlmacenada = array(
            'nombre' => 'sin_foto.jpg',
            'ancho' => '512',
            'alto' => '512',
            'extension' => 'jpg',
        );
        if ($imagen) {
            $file = $imagen->getClientOriginalName();
            $data_file = explode('.', $file);
            $extension = end($data_file);
            $imageName = $prefijo . uniqid() . "." . $extension;
            Storage::disk($discoVirtual)->put($imageName, File::get($imagen));
            $path = config('filesystems.disks.' . $discoVirtual . '.root') . '/' . $imageName;
            $imagenAlmacenadasize = getimagesize($path);

            $imagenAlmacenada['nombre'] = $imageName;
            $imagenAlmacenada['ancho'] = $imagenAlmacenadasize[0];
            $imagenAlmacenada['alto'] = $imagenAlmacenadasize[1];
            $imagenAlmacenada['extension'] = $extension;

            SaveLogError("imagenAlmacenada", null, $imagenAlmacenada);
        }
        return $imagenAlmacenada;
    } catch (\Exception $e) {
        SaveLogError("subir_imagen_desde_file", $e, ' discoVirtual>' . $discoVirtual);
        return null;
    }
}

function MakeSlugName(string $text)
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '_', $text);
    $text = strtolower($text);
    return $text;
}

function CleanFilename(string $text)
{
    return preg_replace('/[^a-zA-Z0-9()\-\._]/', '', $text);
}

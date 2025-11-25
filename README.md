# Control de Asistencia - PHP

Este proyecto es una aplicación web para generar reportes de asistencia en formato PDF.

## Requisitos

- Servidor Web (Laragon, XAMPP, etc.)
- PHP 7.4 o superior
- Composer

## Instalación

1.  Copie los archivos del proyecto a su carpeta `www` (por ejemplo: `C:\laragon\www\control-asistencia`).
2.  Si la carpeta `vendor` no existe, debe instalar las dependencias:
    -   Abra la terminal (en Laragon: Click derecho -> Terminal).
    -   Navegue a la carpeta del proyecto.
    -   Ejecute el comando:
        ```bash
        composer install
        ```

## Uso

1.  Abra su navegador y vaya a la dirección local del proyecto (ej. `http://control-asistencia.test` o `http://localhost/control-asistencia`).
2.  Seleccione el formato deseado.
3.  Complete los datos y haga clic en "Generar PDF".

## Solución de Problemas

Si ve un error como "Failed opening required 'vendor/autoload.php'", significa que no se han instalado las librerías necesarias. Siga los pasos de **Instalación** arriba para ejecutar `composer install`.

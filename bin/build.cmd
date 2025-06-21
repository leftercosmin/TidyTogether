@echo off

set "partition=C:"
if not "%~1"=="" (
    set "partition=%~1"
)

set "name=TidyTogether"
set "source=..\%name%"
set "destination=%partition%\xampp\htdocs\%name%"

if exist "%destination%" (
    rmdir /s /q "%destination%"
)

mkdir "%destination%"
xcopy /E /I /Y "%source%\*" "%destination%"

echo ^<?php> p.php
echo if (!empty($_SERVER['HTTPS']) ^&^& ('on' == $_SERVER['HTTPS'])) {>> p.php
echo     $uri = 'https://';>> p.php
echo } else {>> p.php
echo     $uri = 'http://';>> p.php
echo }>> p.php
echo $uri .= $_SERVER['HTTP_HOST'];>> p.php
echo header('Location: ' . $uri . '/%name%');>> p.php
echo exit;>> p.php

del "%partition%\xampp\htdocs\index.php"
move p.php "%partition%\xampp\htdocs\index.php"

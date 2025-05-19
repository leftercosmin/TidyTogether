@echo off

:: should be called only once

F:\xampp\xampp_start.exe

set "MYSQL=F:\xampp\mysql\bin\mysql"
set "HOST=localhost"
set "USER=root"
set "FILE=.\bin\schema.sql"

type %FILE% | %MYSQL% -h %HOST% -u %USER% -p
./bin/build.cmd

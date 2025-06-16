@echo off
setlocal enabledelayedexpansion

set "MYSQL=F:\xampp\mysql\bin\mysql"
set "FILE=.\bin\schema.sql"
set "ENV=.\.env"

if not exist %ENV% (
    echo .env file not found.
    exit /b 1
)

for /f "usebackq tokens=1,* delims==" %%A in ("%ENV%") do (
    set "key=%%A"
    set "raw=%%B"

    rem Skip comment lines
    echo !key! | findstr /b "#" >nul
    if errorlevel 1 (
        set "value=!raw!"
        if "!value:~0,1!"=="\"" set "value=!value:~1!"
        if "!value:~-1!"=="\"" set "value=!value:~0,-1!"
        set "!key!=!value!"
    )
)

set "HOST=!DB_HOST!"
set "USER=!DB_USERNAME!"
set "PASS=!DB_PASSWORD!"
set "NAME=!DB_NAME!"
set "PORT=!DB_PORT!"

type %FILE% | %MYSQL% -h %HOST% -P %PORT% -u %USER% --password=%PASS% -D %NAME%

endlocal

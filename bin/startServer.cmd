@echo off

F:\xampp\xampp_start.exe
.\bin\build.cmd

if "%~1"=="reset" (
  .\bin\resetSchema.cmd
)

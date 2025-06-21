@echo off

if exist "C:\xampp\" (
  C:\xampp\xampp_start.exe
  .\bin\build.cmd C:
)

if exist "F:\xampp\" (
  F:\xampp\xampp_start.exe
  .\bin\build.cmd F:
)

if "%~1"=="reset" (
  .\bin\resetSchema.cmd
)

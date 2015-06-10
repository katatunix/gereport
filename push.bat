git add -A
set MSG=%1
if "%MSG%"=="" set MSG=Update
git commit -m "%MSG%"
git push origin HEAD

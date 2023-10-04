@echo off
git remote set-url origin https://github.com/PrinceGiovanniVillanos/CIT17-3G.github.io.git
git pull
pause
git add .
git commit -m "Auto upload"
git push
pause
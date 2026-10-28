@echo off
start "Membership 8000" cmd /k "cd membership-service && php artisan serve --port=8000"
start "Training 8001"   cmd /k "cd training-service && php artisan serve --port=8001"
start "Attendance 8002" cmd /k "cd attendance-service && php artisan serve --port=8002"
start "Payments 8003"   cmd /k "cd payments-service && php artisan serve --port=8003"

@echo off
for %%s in (membership-service training-service attendance-service payments-service) do (
    echo ===== %%s =====
    pushd %%s
    call composer install
    if not exist .env copy .env.example .env
    php artisan key:generate
    if not exist database\database.sqlite type nul > database\database.sqlite
    php artisan migrate:fresh --seed --force
    popd
)
pause

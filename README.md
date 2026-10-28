# Gym Membership System - Week 11 (Roles)

CS383 project. 4 Laravel microservices, each one has its own database.

| Student | Service | Port | Tables |
|---|---|---|---|
| 1 | membership-service (main app: login + roles) | 8000 | users, memberships |
| 2 | training-service | 8001 | workout_plans |
| 3 | attendance-service | 8002 | attendance_records |
| 4 | payments-service | 8003 | payments |

## Run

First time:

```
setup.bat
```

Every time:

```
start.bat
```

Then open http://127.0.0.1:8000

## Test accounts (password: password)

| Role | Email |
|---|---|
| admin | admin@gym.com |
| trainer | trainer@gym.com |
| member | member@gym.com |

`SERVICE_KEY` must be the same in the 4 `.env` files.

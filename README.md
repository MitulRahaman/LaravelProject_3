<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# StackOverflow Project

## Project Summary:

- User can ask a solution for a new problem.
- User can give title and description for the problem.
- User can upload pdf or image.
- Admin can comments on that problem.
- Admin can reject or resolve that problem.
- When admin give an update, user will get notification via email.

## Table Information

1. Problems: 
    - title (string) {required}
    - description (text) {required}
    - status (open {default}, resolved, rejected)
    - attachment (string) {nullable}
    - user_id {required}
    - status_changed_by_id {nullable}

2. Comments: 
    - body (text) {required}
    - user_id {required}
    - problem_id {required}

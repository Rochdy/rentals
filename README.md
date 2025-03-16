# Rental Listing



## Stack
- Laravel (version 12 with livewire starter kit)
- Tailwind, Alpine & some flux components

## Description

A simple rentals listing app, that allowed:
- The guest: to check rentals & see each rental details
- The user: to book a rental
- The admin: to create/update rentals & to list all bookings


## Tech details
- I'm using livewire, so all the componenets/controllers are under ```app/Livewire```
- I added one more middleware ```app/Http/Middleware/AdminMiddleware.php```, to control the routes of the admins (creating/editing rentals & showing all bookings)
- I used alpine with livewire to add some interactivity whle booking
# Sound Stage - E-Commerce Platform (Darren Vo's COMP-3340 Project)

Sound Stage is a dynamic, database-driven e-commerce platform designed for audiophiles to browse and purchase high-fidelity physical media (Vinyl records and CDs).

## Live Demo
**Check out the live website here:** https://vongoct.myweb.cs.uwindsor.ca/comp3340_project/

## Features

* **Dynamic Catalogue:** Products and prices are rendered dynamically from a MySQL database.
* **Shopping Cart & Checkout:** Users can add items to a session-based cart and proceed through a simulated checkout process.
* **User Authentication:** Secure registration and login system with password hashing and role-based access control (Admin vs. Standard User).
* **Administrator Dashboard:** Admins can easily update product pricing, monitor server status, and disable user accounts.
* **Custom Quote Calculator:** A dynamic form that lets independent artists calculate the cost of a custom vinyl pressing.
* **Interactive Map:** Integrated Leaflet.js to provide an interactive map to help them navigate to the physical storefront.
* **Multi-Theme UI:** Users can toggle between three distinct CSS themes (Cyberpunk, Comic Book, and Moody Blue) which are saved locally.
* **Fully Responsive:** Includes a mobile-friendly layout with a JavaScript-powered hamburger navigation menu.

## Tech Stack

* **Frontend:** HTML5, CSS3, Vanilla JavaScript
* **Backend:** PHP
* **Database:** MySQL (via PDO)
* **Libraries:** Leaflet.js (Interactive Maps)

## Installation Guide

To deploy this application on a new server (e.g., a university local host or cPanel environment):

1. **Clone the repository** to your local machine or server (https://github.com/darrenxvo/comp-3340-project.git).
2. **Upload all files** to your public web directory (e.g., `public_html`).
3. **Set up the Database:**
   * Create a new MySQL database on your host.
   * Import the provided SQL schema to generate the `products` and `users` tables.
4. **Configure the Connection:**
   * Open `includes/db.php`.
   * Update the connection string with your specific database host, name, username, and password.
5. **Launch the site** by navigating to `index.php` in your web browser.
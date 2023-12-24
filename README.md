# Requirements

* PHP > 8.
* Node v16.13.0.

# Notes

* To run the project:

1. Configure the database variables in the .env file.
2. Run the following commands

<pre>
composer install
npm install
npm run build
php artisan migrate --seed
php artisan serve
</pre>

3. The migration command with seed option will create two users

<pre>
admin1@resmen.com
admin1@resmen.com
</pre>
and the **password** for both users is: **123456**

4. I have used a package created by me to implement filters, sorting,
  pagination, search, and loading relations. The link to this package:
  [EasyApi](https://github.com/Modar-Nahhas/easy-api).</br>

5. I have used vue components I created in previous projects for speed
in implementing the test. These components still uses the option API.
6. There are many steps to improve the user experience and code that can be implemented, such as:
  - Add front-end validation rules.
  - Abstract the API handlers functionalities.
  - Disable submit button in case of edit and no changes has been made.
  - Better error handling and responses handling.
<br/>
<br/>
Due to lack of time we didn't tackle these issues.

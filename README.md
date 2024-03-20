# 2024-01-29
- Changed update uri query to &updateLatLong=1 instead of &test=1 (/wp-admin/edit.php?post_type=find-us&updateLatLong=1)
- Steps to update
    1. Delete server .json then reupload
    2. Reimport
    3. Make the following changes:
        Houston: check that there are 2 different posts, 1 should be 2101 Crawford Street
- Find Us - Check items:
    Beckley – phone number format does not match the rest of the list
      client provided phone number format is wrong
    Cleveland – We want to call this one Parma Heights
    Connellsville – no zip code listed
    Houston – 2101 Crawford Street is missing
    Huntsville – no zip code listed
    Manhattan – 42 Broadway is missing
    Morgantown – no state or zip code listed
    North Lima – no state or zip code listed
    Plattsburgh – listed twice
    Poughkeepsie – listed twice
    Not all clinical research sites are listed

# 2023-12-13 Changes for /about/locations page
- added sf-helpers to remove bugherd when working on local
- moved window.consoleStyling to helper-console.js, added extra settings to prevent printing messages when enable is set to false
- moved explore-our-sites admin-ajax from helper-functions.php to helper-explore-our-sites.php
- included new helper-explore-our-sites.php in functions.php
- js for where-to-find-us section to imagroup-ajax-where-to-find-us.js
- included new imagroup-ajax-where-to-find-us.js in style-script-font.php

## 2023-12-13 Changes specific to Explore Our Sites
- refactored marker and Info Window creation to make code more readable and modular
- enabled scrollwheel for mapzoom
- added new maps namespace to allow for paging
- added page to js and php (admin-ajax)
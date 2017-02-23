# _Fearless Dining_

#### _This web page allows a user to input a restaurant, views restaurants, input a cuisine to search, and update or delete a restaurant, 22 February 2017_

#### By _**Erica Wright & Michaela Davis**_

## Description

_This web page (created using MySQL, Silex, Twig, and BDD/TDD) allows a user to input a restaurant, views restaurants, input a cuisine to search, and update or delete a restaurant._

## Setup/Installation Requirements

* Ensure [composer](https://getcomposer.org/) is installed on your computer.

* In terminal run the following commands:

1. _Fork and clone this repository from_ [gitHub](https://github.com/ericaw21/fearless-dining.git).
2. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
3. To run tests enter `composer test` in terminal.
4. Create a local server in the /web directory within the project folder using the command: php -S localhost:8000 (assuming you are using a mac), or php -S localhost:8888 (if using windows).
5. Open the directory http://localhost:8000/ (if on a mac) or http://localhost:8888/ (if on windows pc) in any standard web browser.

## Specifications

|    *Behavior*   |    *Input 1*    |     *Output*    |
|-----------------|-----------------|-----------------|
| A user clicks on a cuisine type. | click on "Mexican" | Mexican cuisine page appears with a list of Mexican restaurants |
| A user clicks on a restaurant | click on "Matador" | Matador restaurant page appears with its details |
| A user enters a new cuisine type | type in "Thai" | Cuisine page reloads with "Thai" listed as a cuisine type |
| A user enters a new restaurant | type in "Sivalai Thai, 4806 SE Stark St, Portland, OR, 503-230-2875, Cheap, Yummy, Friendly" | Restaurant page reloads with "Sivalai Thai" listed as a restaurant |
| A user clicks "delete" button on an existing restaurant page | click "delete" on Sivalai Thai page | Page reloads with specific cuisine page |
| A user clicks "edit" button on an existing restaurant page | enters "Sa Wa Dee" | Restaurant page reloads with "Sa Wa Dee" listed as a restaurant instead of "Sivalai Thai"|




## Known Bugs

_None so far._

## Support and contact details

_Please contact michaela.delight@gmail.com or ericaw21@gmail.com with concerns or comments._

## Technologies Used

* _Composer_
* _CSS_
* _HTML_
* _MySQL_
* _PHP_
* _PHPUnit_
* _Silex_
* _Twig_

### License

*MIT license*

Copyright (c) 2017 **_Michaela Davis & Erica Wright_**

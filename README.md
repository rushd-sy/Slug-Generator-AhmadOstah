Task 1 - Slug Generator

 Goal:
The goal of this task is to implement a custom, SEO-friendly slug generator in Laravel without using built-in string helpers. The implementation follows professional Laravel conventions by using Macros, Service Providers, and Custom Artisan Commands.

Implementation Steps:

1. Extending the Framework (The Macro)
Instead of a loose function, I extended Laravel's tr class. This allows the slugging logic to be encapsulated and reusable across the entire application.
I registered a slugify macro in app/Providers/AppServiceProvider.php:
Logic: Uses Regular Expressions (preg_replace) to:
Convert strings to lowercase.
Keep only alphanumeric characters.
Replace spaces and multiple dashes with a single hyphen.
Trim leading/trailing hyphens.

2. The User Interface (Artisan Command)
To allow terminal-based interaction, I created a custom Artisan command:
php artisan make:slug
Location: app/Console/Commands/GenerateSlug.php
Functionality:
1. Prompts the user for a title using $this->ask().
2. Processes the input using the custom Str::slugify() macro.
3. Outputs the result as a string with green color

Cases Tested:
Standard title conversion (e.g., "Hello World").
Removal of special characters (e.g., @, !, ?).
Handling multiple spaces and consecutive hyphens.
Trimming start/end hyphens.
Validation for empty inputs.


How to Run:
php artisan make:slug
Run Tests:
php artisan test --filter SlugGeneratorTest
## Enuygun Project

This project is based on Laravel 6.12 for Enuygun Case Study. 

## Installation

1. Clone repository
2. Run `composer install`
3. Make new database with this name: `enuygun`
4. Copy `.env` file that is provided in email attachment.
5. Run `php artisan migrate --seed`

## Usage

### CLI:
Run `php artisan update:currency-records [ProviderName]`

Note: ProviderName refers to the adapter class name.

Available adapters: `Provider1`, `Provider2`

Also you can leave that option empty.

### Web:
First, run `php artisan serve`

Use refresh button in the page to fetch last records.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Also this project.

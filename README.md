# Laravel examples #
### One of the problems of a programmer is that you can't show your most advanced and complex code because it's commercial. This repository will show you what I can do with Laravel and how I use some patterns and principles when writing code. ###

## Examples of using different programming approaches ##

### Resources ###  
One of the use cases for resources is the pre-known and controlled output of information. The model may change during development. As a result, confidential information may be compromised. To avoid this, you can use Resources.  
The resource can be used for a single object or for a collection of objects.

*Examples:*  
Without rosource: app/Http/Controllers/QuoteRequestController.php - list method  
Single object: app/Http/Controllers/QuoteRequestController.php - show method  
Collection of objects: app/Http/Controllers/QuoteSourceController.php - list and show methods


### Interfaces ###  
Interfaces in laravel are called - Contracts. The framework's standard contracrs can be found at vendor/laravel/framework/src/Illuminate/Contracts  
I am creating a Quote Source contract and it must be implemented on every quote source.  
*Examples:*  
Contract (Interface): app/Contracts/QuoteSourceServiceContract.php  
Classes: app/Services/QuoteSources

### Factory (Factory Method) ###
Since we have several quote sources and they all implement the same interface, we can create a Factory. The factory will return a specific object based on the input. Now we can add more sources with different logic, but we will still use the same Factory to use them.  
*Examples:*  
Factory: app/Factories/QuoteSourceFactory.php - factory returns the object based on the source id from the database.  
Usage: app/Http/Controllers/QuoteRequestController.php - update method

### Other interesting parts ###
- Changing the response code on failed validation: app/Http/Requests/StoreQuoteRequestRequest.php  
- Using Laravel Query Builder instead of Eloquent ORM: app/Services/QuoteRequestService.php - getFiltered method  
- Using data from related tables in Resource: app/Http/Resources/ListQuoteRequestResource.php  


## Branches ##
This project follows the gitflow branching model.

**LE-1** - Initializing an empty Laravel project to start from the beginning. And creating first branch by the gitflow model.

**LE-2** - Adding and configuring Fortify with Sanctum. Create a user seeder and resource. Return authorized user through a resource.

**LE-3** - Adding a QuoteRequest as a client request entity for a new quote. Store this query in the database and redirect the user to the main page. Creation of an administrative part (api) to get a list of client requests and a list of available statuses.

**LE-4** - Adding interface (Contract) for Quote source. Creation of 3 sources of quotes as an example. Each source uses its own implementation of the contract. Creating a 'factory method' to get the QuoteSource object and developing client and administrative parts of the project.

**LE-5** - Adding fake quote requests to the database. Creating filtering and pagination logic in the quoterequest/list route. Creating a QuoteRequestService to move the filtering logic from the controller to a separate service.

# Laravel examples #
### One of the problems of a programmer is that you can't show your most advanced and complex code because it's commercial. This repository will show you what I can do with Laravel and how I use some patterns and principles when writing code. ###

## Examples of using different programming approaches ##

### Resources ###  
One of the use cases for resources is the pre-known and controlled output of information. The model may change during development. As a result, confidential information may be compromised. To avoid this, you can use Resources.  
The resource can be used for a single object or for a collection of objects.  
*Examples:*  
Without rosource: [list method](app/Http/Controllers/QuoteRequestController.php)  
Single object: [show method](app/Http/Controllers/QuoteRequestController.php)  
Collection of objects: [list and show methods](app/Http/Controllers/QuoteSourceController.php)  


### Interfaces ###  
Interfaces in laravel are called - Contracts. The framework's standard contracrs can be found at vendor/laravel/framework/src/Illuminate/Contracts  
I am creating a Quote Source contract and it must be implemented on every quote source.  
*Examples:*  
[Contract (Interface)](app/Contracts/QuoteSourceServiceContract.php)  
[Classes](app/Services/QuoteSources)

### Factory (Factory Method) ###
Since we have several quote sources and they all implement the same interface, we can create a Factory. The factory will return a specific object based on the input. Now we can add more sources with different logic, but we will still use the same Factory to use them.  
*Examples:*  
[Factory](app/Factories/QuoteSourceFactory.php) - returns the object based on the source id from the database.  
Usage: [update method](app/Http/Controllers/QuoteRequestController.php)  

### Sessions and unique tokens ###
How to determinate user while showing request information?  
One way is to use Laravel sessions. You can put some information into the session and validate it when the user makes a request.  
How to hide request id to prevent information disclosure?  
You can generate a unique random token when starting a conversation and store it in the session. Reflash this session while the conversation is in progress, and reset when the final answer is given.  
*Examples:*  
My interpretation contains [Signature service](app/Services/Signature.php) with unique token, hash and validation methods. I use the [ValidateInternalSignature](app/Http/Middleware/ValidateInternalSignature.php) middleware to validate requests.  
Middleware is used by the "back" group in [web routes](routes/web.php).  

### Other interesting parts ###
- Changing the response code on failed validation: [failedValidation method](app/Http/Requests/StoreQuoteRequestRequest.php)  
- Using Laravel Query Builder instead of Eloquent ORM: [getFiltered method](app/Services/QuoteRequestService.php)  
- Using data from related tables in [Resource](app/Http/Resources/ListQuoteRequestResource.php)  


### The logic of working (on the example of Postman) ###
1. Import Postman [environment and collection](documentation/postman)
2. Set Development environment.
3. Administrative part starts with Auth:
    - csrf
    - login
    - any other requests
4. Customer side:
    - POST request to /quoterequest - send an external id and get a redirect link to the front page. This link contain **token** after #. For example: http://localhost/#psfmYhZ1Uu
    - GET request to /back/quoterequest/{token} - should contain **token** from the redirect link. This request will return information about qurrent request.
    - GET request to /back/quotesources/{token} - should also contain **token** from the redirect link. Returns quote sources available for this request.
    - PUT request to /back/quoterequest - should contain the id of the quote source. Returns a quote!


## Branches ##
This project follows the gitflow branching model. And [Trello](https://trello.com/b/59M7MZHU/laravel-examples) is used for task tracking

**MAIN** - Stores the official release history. Current version is 1.0

release/**1.0** - v1.0

**Develop** - Integration branch for features. All magic happens here! 🪄

feature/**LE-6** - Adding a Signature service to create unique tokens, signatures and verify them. Add token to hide internal number of request. Change the working logic from using an id to a token. Adding the Postman collection to the project.

feature/**LE-5** - Adding fake quote requests to the database. Creating filtering and pagination logic in the quoterequest/list route. Creating a QuoteRequestService to move the filtering logic from the controller to a separate service.

feature/**LE-4** - Adding interface (Contract) for Quote source. Creation of 3 sources of quotes as an example. Each source uses its own implementation of the contract. Creating a 'factory method' to get the QuoteSource object and developing client and administrative parts of the project.

feature/**LE-3** - Adding a QuoteRequest as a client request entity for a new quote. Store this query in the database and redirect the user to the main page. Creation of an administrative part (api) to get a list of client requests and a list of available statuses.

feature/**LE-2** - Adding and configuring Fortify with Sanctum. Create a user seeder and resource. Return authorized user through a resource.

feature/**LE-1** - Initializing an empty Laravel project to start from the beginning. And creating first branch by the gitflow model.

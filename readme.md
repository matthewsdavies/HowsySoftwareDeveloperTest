# Howsy Software Developer Test

### Getting Started

- Run migration - ```php artisan migrate``` 
- Seed the DB with faker - ```php artisan db:seed```
- Add an Google Geocode API Key to the .env file - ```GOOGLE_MAPS_API_KEY```

### API

- To list all properties - ```GET api/properties/list```
- To fetch a single property - ```GET api/properties/property/{id}```
- To create a new property - ```POST api/properties/property/create```

POST Headers

- address_line_1
- address_line_2 (optional)
- city
- postcode

## Amends

"All property objects returned by the API should include the property’s address, as well as its latitude and longitude, which you should supplement using the Google Maps API."

With the brief asking to supplement the Google API with all requests, I thought it best to add the geocodes at the time of creating a property to save on number API requests.
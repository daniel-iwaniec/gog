> In the first age, in the first battle, when the shadows first lengthened...

# Catalog API

## Product list

* Method: **GET**
* Endpoint: **/products**
* Parameters:
  * **page** (integer)
* Example
```
curl \
  --request GET \
  --url /products?page=2
```

## Add product

* Method: **POST**
* Endpoint: **/products**
* Parameters:
  * **name** (string)
  * **price** (integer)
* Example
```
curl \
  --request POST \
  --url /products \
  --header 'content-type: application/json' \
  --data '{
    "name": "DOOM (2016)",
    "price": 5999
  }'
```

## Remove product

* Method: **DELETE**
* Endpoint: **/products/{id}**
* Parameters:
  * **id** (integer)
* Example
```
curl \
  --request DELETE \
  --url /products/1
```

## Update product

* Method: **PATCH**
* Endpoint: **/products/{id}**
* Parameters:
  * **id** (integer)
  * **name** (string) and/or **price** (integer)
* Example
```
curl \
  --request PATCH \
  --url /products/1
  --header 'content-type: application/json' \
  --data '{
    "name": "Gothic"
  }'
```

# Notable omissions

* Form validation
  * There should also be form validation in actions with better error handling, before reaching exceptions in inner layers.
* Event sourced cart
  * There should also be cart API, which is good fit for an event sourcing approach.
* Tests
  * There should be some unit and acceptance/functional tests.
* Other minor ones:
  * PHPStan strict exception checking.
  * Better HTTP response codes for better RESTful experience.
  * More generic products' collection implementation.
  * Unique domain name checking should be hihglighted in the domain.

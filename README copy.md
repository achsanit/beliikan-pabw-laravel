# beliikan
Tugas Mata Kuliah Pengembangan Aplikasi Berbasis Web

# Module
- Login
- Register
- Product
- Category
- History
- Shipping
- Transaction
- Detail transaction
- Payments

# Product
## Create Product
Request :
  - Method : POST
  - Endpoint : `/api/products`
  - Header : 
      - Content-Type: application/json
      - Accept: application/json

  - Body :

```json 
{
    "name" : "string",
    "price" : "long",
    "description" : "text"
    "stock" : "integer"
    "img_url" : "string"
}
```

Response :

```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
         "id" : "integer",
         "name" : "string",
         "price" : "long",
         "description" : "text"
         "stock" : "integer"
         "img_url" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     }
}
```

## Get Product
Request :
  - Method : GET
  - Endpoint : `/api/products/{id}`
  - Header : 
      - Accept: application/json

Response :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
         "id" : "integer",
         "name" : "string",
         "price" : "long",
         "description" : "text"
         "stock" : "integer"
         "img_url" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     }
}
```

## Update Product
Request :
  - Method : PUT
  - Endpoint : `/api/products/{id}`
  - Header : 
      - Content-Type: application/json
      - Accept: application/json

  - Body :

```json 
{
    "name" : "string",
    "price" : "long",
    "description" : "text"
    "stock" : "integer"
    "img_url" : "string"
}
```


Response :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
         "id" : "integer",
         "name" : "string",
         "price" : "long",
         "description" : "text"
         "stock" : "integer"
         "img_url" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     }
}
```


## list Product
Request :
  - Method : GET
  - Endpoint : `/api/products`
  - Header : 
      - Accept: application/json

Response :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : [
        {
            "id" : "integer",
            "name" : "string",
            "price" : "long",
            "description" : "text"
            "stock" : "integer"
            "img_url" : "string",
            "createdAt" : "date",
            "updatedAt" : "date"
        },
        {
            "id" : "integer",
            "name" : "string",
            "price" : "long",
            "description" : "text"
            "stock" : "integer"
            "img_url" : "string",
            "createdAt" : "date",
            "updatedAt" : "date"
        }
    ]
}
```


## Delete Product

Request :
- Method : DELETE
- Endpoint : `/api/products/{id}`
- Header :
    - Accept: application/json

Response :

```json 
{
    "code" : "number",
    "status" : "string"
}
```

# Category
## List Category

Request :
  - Method : GET
  - Endpoint : `/api/categories`
  - Header :
      - Accept: application/json

Response :

```json 
{
    "code" : "number",
    "status" : "string"
    "data" : [
         {
            "id" : "integer",
            "name" : "string",
            "createdAt" : "date",
            "updatedAt" : "date"
        },
        {
            "id" : "integer",
            "name" : "string",
            "createdAt" : "date",
            "updatedAt" : "date"
        }
     ]
}
```

## Get Category

Request :
  - Method : GET
  - Endpoint : `/api/categories/{id}`
  - Header :
      - Accept: application/json

Response :

```json 
{
    "code" : "number",
    "status" : "string"
    "data" : {
         "id" : "integer",
         "name" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     }
}
```

## Create Category
Request :
  - Method : POST
  - Endpoint : `/api/categories`
  - Header :
    - Content-Type: application/json
    - Accept: application/json

  - Body :

```json 
{
    "name" : "string",
}
```

Response :

```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
         "id" : "integer",
         "name" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     }
}
```

## Delete Category

Request :
- Method : DELETE
- Endpoint : `/api/categories/{id}`
- Header :
    - Accept: application/json

Response :

```json 
{
    "code" : "number",
    "status" : "string"
}
```

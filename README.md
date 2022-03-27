# beliikan
Tugas Mata Kuliah Pengembangan Aplikasi Berbasis Web

# Module
1. Login / Register
2. Product
3. Category
4. Detail_category
5. History
6. Shipping
7. Transaction
8. Payments

# Create Product
Request :
  - Method : POST
  - Endpoint : /api/product
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
Respons :

```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
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
# Get Product
Request :
  - Method : GET
  - Endpoint : /api/product/{id}
  - Header : 
      - Content-Type: application/json
      - Accept: application/json
      
  - Body :
  
Respons :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
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
# Update Product
Request :
  - Method : PUT
  - Endpoint : /api/product/{id}
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

Respons :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : {
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

#list Product
Request :
  - Method : GET
  - Endpoint : /api/products
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

Respons :
```json 
{
    "code" : "number",
    "status" : "string",
    "data" : [
      {
         "name" : "string",
         "price" : "long",
         "description" : "text"
         "stock" : "integer"
         "img_url" : "string",
         "createdAt" : "date",
         "updatedAt" : "date"
     },
     {
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

# Prueba Técnica - Backend

Este repositorio contiene una implementación de una prueba técnica en la que se valida un token utilizando un caso de uso (`ValidateTokenUseCase`) en Laravel, junto con un middleware que verifica si el token cumple con ciertas reglas de validación. Además, se implementa un **`ShortUrlUseCase`** que utiliza un cliente **`TinyurlClient`** para acortar URLs.

## Descripción

La tarea principal de esta prueba técnica es crear una solución en la que se validen los tokens en una API RESTful usando Laravel. Los tokens deben seguir las siguientes reglas:
- Solo pueden contener los caracteres `()`, `{}`, y `[]`.
- El contenido del token debe estar **balanceado** (cada apertura debe tener su cierre correspondiente en el orden correcto).

El sistema está diseñado para garantizar que las solicitudes a la API solo se realicen con tokens válidos, de lo contrario, se devolverá un error adecuado. Además, la aplicación incluye la funcionalidad para acortar URLs utilizando el servicio TinyURL.

### Funcionalidades Implementadas

1. **Validación del Token**:
    - El token debe contener únicamente los caracteres `()`, `{}`, y `[]`.
    - Si el token contiene otros caracteres, se lanza una excepción.

2. **Balanceo del Token**:
    - El token se valida para asegurarse de que está balanceado, es decir, que cada apertura tiene su cierre correspondiente (por ejemplo, `()` o `{[()]} `).

3. **Middleware de Validación**:
    - Se ha creado un middleware `ValidateTokenMiddleware` que utiliza el caso de uso `ValidateTokenUseCase` para validar el token en la cabecera de las solicitudes entrantes.
    - El middleware rechaza las solicitudes con tokens inválidos o desbalanceados, respondiendo con un código de error adecuado (`401`).

4. **Caso de Uso para Acortar URLs**:
    - El **`ShortUrlUseCase`** es responsable de recibir una URL larga y devolver su versión acortada utilizando el servicio de TinyURL.
    - Este caso de uso utiliza el **`TinyurlClient`**, un cliente que hace una solicitud HTTP a la API de TinyURL para generar el enlace corto.

5. **Pruebas Unitarias y de Integración**:
    - Se han implementado pruebas utilizando PHPUnit para asegurar que el middleware, los casos de uso y el cliente funcionen correctamente con tokens válidos e inválidos, así como con la funcionalidad de acortamiento de URLs.
    - Las pruebas cubren la validación de caracteres permitidos, el balanceo de los caracteres, la operación del middleware y el funcionamiento de **`ShortUrlUseCase`** y **`TinyurlClient`**.

## Estructura del Proyecto

```
src/  
├── Application/  
│   ├── Responses/  
│   │   └── ShortUrlResponse.php           # Respuesta con la URL acortada  
│   ├── ShortUrlUseCase.php                # Caso de uso para acortar URLs  
│   └── ValidateTokenUseCase.php           # Caso de uso para validar tokens  
├── Domain/  
│   ├── Clients/  
│   │   └── ShortUrlClient.php             # Interfaz para cliente de acortamiento de URLs  
│   ├── Entities/  
│   │   └── Vo/  
│   │       ├── ShortUrlVo.php             # Valor objeto para representar una URL acortada  
│   │       ├── TokenVo.php                # Valor objeto para representar un token  
│   │       └── UrlVo.php                  # Valor objeto para representar una URL  
│   └── Services/  
│       └── TokenValidator.php             # Servicio para validar los tokens  
├── Infrastructure/  
│   ├── Controllers/  
│   │   └── ShortUrlController.php         # Controlador que maneja las solicitudes de acortamiento de URLs  
│   ├── ExternalClients/  
│   │   └── ShortUrlClient/  
│   │       └── TinyurlClient.php          # Cliente de TinyURL para generar URLs cortas  
│   └── Middleware/  
│       └── ValidateTokenMiddleware.php    # Middleware para validar el token  
```

## Requisitos

Para ejecutar este proyecto, necesitas tener lo siguiente instalado:

- **Git**.
- **Docker**

## Instalación

1. Clona el repositorio:

   ```bash
   git clone git@github.com:palatinum/backend-technical-challenge.git
   cd backend-technical-challenge

2. Crear el .env:

   ```bash
   cp .env.example .env

3. Ejecutar docker:
   ```bash
   docker compose up -d

4. Ejecutar la instalacion de dependencias:
   ```bash
   docker exec -it technical-challenge-app composer install

## Ejecución de los Tests

1. Ejecuta los tests con el siguiente comando:
   ```bash
   docker exec -it technical-challenge-app ./vendor/bin/phpunit

## Endpoints

### **POST http://localhost:8088/api/v1/short-urls**

Este endpoint recibe un `Authorization` header con el token que debe ser validado.

Colección de Postman [backend-technical-challenge.postman_collection.json](./docs/backend-technical-challenge.postman_collection.json "backend-technical-challenge").


#### **Requiere un Token Válido**

- **Token válido**: `{}[]()` (balanceado, solo con los caracteres permitidos).
- **Token inválido**:
    - Contiene caracteres no permitidos: `invalid@token123`.
    - Desbalanceado: `{[)]}`.

#### **Respuesta Exitosa (200)**

Si el token es válido, se procesará la solicitud:

```json
{
    "url": "https://tinyurl.com/xxxxxx"
}
````

#### **Respuesta de Error (401))**

Si el token es inválido:

```json
{
    "error": "Invalid token"
}
````

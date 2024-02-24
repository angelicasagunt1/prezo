# Prezo

## Descripción

Este es el repositorio para el proyecto Prezo. Prezo es una plataforma diseñada para gestionar recetas y sus ingredientes.

## Instrucciones de Instalación

1. **Clonar el Proyecto**: Clona este repositorio en tu máquina local utilizando el siguiente comando:
    ```
    git clone https://github.com/angelicasagunt1/prezo
    ```

2. **Ejecutar Docker Compose**: Abre una terminal y navega hasta el directorio raíz del proyecto clonado. Luego, ejecuta el siguiente comando para levantar los contenedores Docker:
    ```
    docker-compose up -d --build
    ```

3. **Migraciones y Seeders**: Una vez que los contenedores estén en funcionamiento, ejecuta las migraciones y seeders desde la terminal:
    - Establece los permisos adecuados para la carpeta de almacenamiento:
        ```
        docker-compose exec app chown -R www-data:www-data storage
        ```
    - Ejecuta las migraciones:
        ```
        php artisan migrate
        ```
    - Ejecuta los seeders para poblar la base de datos con datos de prueba:
        ```
        php artisan db:seed --class=UserSeeder && php artisan db:seed --class=UnitSeeder && php artisan db:seed --class=ProductSeeder && php artisan db:seed --class=RecipeSeeder
        ```

## Información Importante

### Usuario de Prueba

Utiliza las siguientes credenciales para acceder como usuario de prueba:

- **Correo Electrónico:** admin@prezo.com
- **Contraseña:** 1234

### Listado de Productos

Aquí se muestra un listado de productos disponibles en la plataforma:

| ID  | Productos   |
|-----|-------------|
| 1   | Ron Havanna |
| 2   | Coca-Cola   |
| 3   | Hielo       |
| 4   | Ron         |
| 5   | Menta       |
| 6   | Limon       | 

### Identificación de Unidades

Es importante entender las unidades de medida utilizadas en la base de datos al agregar ingredientes o productos a una receta. Aquí se detallan las unidades disponibles:

| ID  | Descripción |
|-----|-------------|
| 1   | Mililitros  |
| 2   | Unidades    |
| 3   | Litros      |

Por favor, asegúrate de utilizar las unidades correspondientes al agregar ingredientes a una receta.

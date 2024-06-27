# Desarrollo de un proyecto inicial de un ecommerce con Laravel

#### Stack utilizado:
   - Composer 2.6.3
   - PHP 8.3.8
   - Laravel 11.9
   - Livewire 3.5
   - Tailwind 3.4.4
   - Pest 2.34
   - NPM 9.8.1

#### Instrucciones:

1. **Clona este Repositorio**

2. **Verifiar que exista el archivo de BD:**
   - Revisar que exista en `./database/database.sqlite` en caso de no existir se debera crear.

3. **Verifiar que exista el archivo de BD:**
   - Revisar que exista en `./database/database.sqlite` en caso de no existir se debera crear.

4. **Levantar proyecto:**
   - Copia el contenido del archivo `.env.example` y con su contenido crear el archivo `.env` en el directorio raiz.
   - Ejecutar el comando `composer install` para instalar las dependenias de Php necesarias.
   - Ejecutar el comando `npm install` para instalar las dependenias de Javascript necesarias.
   - Ejecutar el comando `php artisan key:generate` para generar un nuevo APP_KEY del proyecto.
   - Ejecutar el comando `php artisan migrate --seed` para crear tablas e insertar registros de prueba.

5. **Ejecutar proyecto:**
   - Ejecutar el comando `npm run dev` para ejecutar los estilos y scripts necesarios para el proyecto.
   - Ejecutar el comando `php artisan serve` para ejecutar el servicio de backen de la aplicacion. 

6. **Ejecutar test:**
   - Ejecutar el comando `php artisan test` para ejecutar los test escritos en Pest para verificar la integridad de los flujos.

7. **Ingresar al proyecto:**
   - En tu navegador ingresa a `http://localhost:8000/` para visualizar el ejercicio
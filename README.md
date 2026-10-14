# Retro Games · Catálogo de juegos retro

Trabajo Práctico Final – Programación II (PHP + MySQL + JavaScript + HTML/CSS), arquitectura MVC.

## Instalación (XAMPP)

1. Copiar la carpeta `TpFinal-Piazzetti` dentro de `C:\xampp\htdocs\`.
2. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
3. En phpMyAdmin, pestaña **Importar**, subir `database/retro_games.sql`
   (crea la base `retro_games` con datos de ejemplo). Si se importa el backup propio
   en lugar de este archivo, no hace falta nada más.
4. Revisar `config/config.php`: usuario y contraseña de MySQL (en XAMPP por defecto: `root` y contraseña vacía).
5. Abrir en el navegador `http://localhost/TpFinal-Piazzetti/` (o con el puerto que use Apache, p. ej. `:8080`).
6. Crear el administrador entrando una vez a `http://localhost/TpFinal-Piazzetti/crear_admin.php`
   y **borrar ese archivo** después.

Si la base ya existía de una versión anterior, ejecutar `database/migracion.sql` en lugar de importar el otro archivo.

## Páginas

| Página | Dirección |
|---|---|
| Inicio (bienvenida) | `index.php` |
| Consolas | `index.php?c=consola&a=index` |
| Catálogo de una consola (con buscador y filtro) | `index.php?c=consola&a=ver&id=N` |
| Consultar precio de un juego (formulario) | `index.php?c=consulta&a=formulario&id=N` |
| Consulta enviada | `index.php?c=consulta&a=gracias` |
| Cómo comprar / preguntas frecuentes | `index.php?c=pagina&a=nosotros` |
| Contacto (formulario con varios controles) | `index.php?c=contacto&a=formulario` |
| Mensaje enviado | `index.php?c=contacto&a=gracias` |
| Acceso administrador | `index.php?c=auth&a=login` |
| Panel: consultas, mensajes, ABM de juegos y de consolas | `index.php?c=admin` |

## Estructura

```
index.php        enrutador (front controller)
controller/      controladores
model/           clases de dominio, DAO (acceso a datos), sesión, subida de imágenes
view/            vistas (layout/ y partials/ son partes comunes)
css/  js-scripts/  img/    recursos
config/          datos de conexión
database/        scripts SQL
```

## Seguridad

- Consultas preparadas (PDO) en todo acceso a la base: sin inyección SQL.
- `htmlspecialchars` al mostrar datos: sin XSS.
- Contraseñas con `password_hash` / `password_verify`; sesión regenerada al ingresar; bloqueo temporal tras 5 intentos fallidos.
- Token CSRF y método POST en todas las acciones que modifican datos.
- Validación en JavaScript (comodidad) y **otra vez en PHP** (la que protege de verdad).
- Subida de imágenes: se valida el contenido real, se renombra el archivo y se reduce a 900 px de lado mayor.

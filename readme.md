# Guía de Inicio Rápido: Servidor PHP y Composer

Este documento detalla cómo configurar y ejecutar un servidor PHP local y utilizar **Composer** para gestionar dependencias en tus proyectos PHP.

---

## 1. Requisitos previos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- **PHP** (versión 8.0 o superior)  
  Verifica la instalación con:  
  ```
  php -v
  ```

- **Composer** (gestor de dependencias de PHP)  
  Verifica la instalación con:  
  ```
  composer --version
  ```

Si no tienes Composer instalado, sigue estas instrucciones:

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
```

---

## 2. Estructura del proyecto

Tu proyecto debe tener la siguiente estructura básica:

```
CursoPHP/
│
├── examen/            # Carpeta con tu subproyecto
│   └── login.php      # Archivo PHP
│
├── composer.json      # Archivo de configuración de Composer
└── test.php           # Archivo básico de prueba
```

---

## 3. Iniciar el servidor PHP

### Ubicación correcta para iniciar el servidor
Debes estar en la carpeta raíz del proyecto (por ejemplo, `CursoPHP`).

1. Navega a la carpeta raíz:
   ```
   cd ~/Documentos/CursoPHP
   ```

2. Inicia el servidor PHP local:
   ```
   php -S localhost:8000
   ```

3. Accede al servidor en tu navegador:
   - URL raíz: `http://localhost:8000`
   - Archivo de prueba: `http://localhost:8000/test.php`
   - Subcarpeta: `http://localhost:8000/examen/login.php`

---

## 4. Uso de Composer

### Iniciar un nuevo proyecto con Composer
Si deseas crear un archivo `composer.json` en la carpeta raíz del proyecto, usa:
```
composer init
```

Sigue las instrucciones del asistente interactivo.

### Instalar dependencias
Para instalar dependencias, por ejemplo **Monolog** (un gestor de logs), ejecuta:
```
composer require monolog/monolog
```

Esto creará la carpeta **vendor/** con las dependencias instaladas.

---

## 5. Detener el servidor

Para detener el servidor PHP, presiona `CTRL + C` en la terminal donde se está ejecutando.

---

## 6. Comandos útiles

- Verificar PHP:
  ```
  php -v
  ```

- Verificar Composer:
  ```
  composer --version
  ```

- Iniciar el servidor local (desde la carpeta raíz):
  ```
  php -S localhost:8000
  ```

- Instalar dependencias con Composer:
  ```
  composer install
  ```

- Actualizar dependencias:
  ```
  composer update
  ```

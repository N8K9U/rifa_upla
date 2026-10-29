# Evaluación 1: Sistema Web y API REST - Rifa UPLA

**Asignatura:** Desarrollo Web / Servicios Web
**Institución:** Universidad de Playa Ancha (UPLA)
**Integrantes:** Matias Vallejos
**Enlace del Video de Demostración:** https://drive.google.com/file/d/1Pmakd1UcE706CWQBkUY64_5YES86xQiN/view?usp=drive_link

---

## 🛠️ Descripción del Proyecto
Este proyecto consta de dos partes principales:
1. **API REST en PHP:** Gestión de participantes y premios respaldada por archivos JSON (`participantes.json` y `premios.json`) con control de sesiones y códigos de estado HTTP.
2. **Sistema Web PHP:** Interfaz de usuario con autenticación, validación de CAPTCHA dinámico, reserva de rifa con persistencia (F5), módulo de búsqueda GET, carga de comprobantes (`/comprobantes/`) y destrucción de sesiones.

---

## 🔑 Credenciales para Pruebas

### API REST (Postman)
* **Base URL:** `http://localhost/rifa_upla/api/`
* **Usuario:** `admin`
* **Contraseña:** `1234`

### Sistema Web (Navegador)
* **Base URL:** `http://localhost/rifa_upla/index.php`
* **Usuario:** `userupla`
* **Contraseña:** `upla123`
* **CAPTCHA:** Suma matemática dinámica.

---

## 📁 Estructura del Repositorio
* `/api/`: Contiene los scripts PHP de la API y los archivos JSON de datos.
* `/comprobantes/`: Carpeta para el almacenamiento físico de archivos subidos.
* Archivos `.php` raíz: Interfaz del sistema web.
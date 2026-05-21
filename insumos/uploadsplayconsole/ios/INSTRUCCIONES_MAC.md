# Publicar en TestFlight — Instrucciones para Mac

## Archivos listos en esta carpeta
- `icon_1024x1024.png` — ícono para App Store Connect
- `screenshots/iphone_69/` — capturas iPhone 16 Pro Max (1320×2868)
- `screenshots/iphone_67/` — capturas iPhone 14/15 Plus (1284×2778)
- `screenshots/ipad_13/` — capturas iPad Pro 13" (2048×2732)

---

## PASO 1 — Requisitos en la Mac (hacer una sola vez)

### 1.1 Instalar Xcode
Descarga **Xcode** desde la App Store (es gratis, ~15 GB).
Ábrelo al menos una vez para aceptar la licencia.

### 1.2 Instalar Homebrew + PHP + Composer
Abre Terminal y ejecuta:
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
brew install php@8.3
brew link php@8.3 --force
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 1.3 Instalar Node.js
```bash
brew install node
```

---

## PASO 2 — Copiar el proyecto a la Mac

Copia toda la carpeta `C:\Users\angel.rodriguez\Documents\fuentes\gsmovil` a la Mac
(via USB, AirDrop, o comprime en ZIP y transfiérela).

Colócala en: `~/Documents/gsmovil`

Luego en Terminal:
```bash
cd ~/Documents/gsmovil
composer install --no-dev
npm install
```

---

## PASO 3 — Credenciales de Apple (hacer una sola vez)

### 3.1 Obtener tu Team ID
- Ve a: https://developer.apple.com → Account → Membership Details
- Copia el **Team ID** (10 caracteres, ej: `AB12CD34EF`)

### 3.2 Registrar el App ID
- Ve a: https://developer.apple.com → Certificates, IDs & Profiles → Identifiers
- Clic en **+** → App IDs → App
- Bundle ID: `com.gsmovil.app`
- Capabilities: mínimo "Push Notifications" si las usas
- Guardar

### 3.3 Crear la app en App Store Connect
- Ve a: https://appstoreconnect.apple.com → Mis apps → **+**
- Plataforma: iOS
- Nombre: `General de Seguros`
- Bundle ID: `com.gsmovil.app`
- SKU: `gsmovil` (cualquier identificador único)
- Idioma principal: Español

### 3.4 Crear API Key para subida automática
- Ve a: https://appstoreconnect.apple.com → Usuarios → Integración → App Store Connect API
- Clic en **+**, nombre: `GSMovil Build`, acceso: **Desarrollador**
- Descarga el archivo `.p8` — solo se descarga UNA vez, guárdalo
- Anota el **Key ID** y el **Issuer ID** que aparecen en esa pantalla

---

## PASO 4 — Configurar el .env en la Mac

Edita el archivo `.env` en `~/Documents/gsmovil/` y completa:

```env
NATIVEPHP_DEVELOPMENT_TEAM=TU_TEAM_ID_AQUI

APP_STORE_API_KEY=/ruta/completa/al/AuthKey_KEYID.p8
APP_STORE_API_KEY_ID=TU_KEY_ID_AQUI
APP_STORE_API_ISSUER_ID=TU_ISSUER_ID_AQUI
APP_STORE_APP_NAME="General de Seguros"
```

---

## PASO 5 — Build y subida a TestFlight

En Terminal, desde `~/Documents/gsmovil/`:

```bash
php artisan native:build --target=ios --release --upload-to-app-store
```

Este comando:
1. Genera el proyecto Xcode
2. Compila y firma el IPA
3. Lo sube automáticamente a App Store Connect

Si prefieres hacerlo manual (sin API key), corre solo:
```bash
php artisan native:build --target=ios --release
```
Luego abre el `.xcworkspace` generado en Xcode → **Product → Archive → Distribute App → App Store Connect**.

---

## PASO 6 — Configurar TestFlight en App Store Connect

1. Ve a https://appstoreconnect.apple.com → tu app → **TestFlight**
2. Espera que el build aparezca (puede tardar 5–30 min en procesarse)
3. Completa el cuestionario de cumplimiento de exportación (elige **No** en todas)
4. Ve a **Probadores internos** o **Grupos externos**
5. Agrega los emails de los testers
6. Los testers recibirán un email con link para instalar **TestFlight** y luego la app

---

## PASO 7 — Assets a subir en App Store Connect

En App Store Connect → tu app → **App Store → Información de la versión de iOS**:

| Asset | Archivo | Dónde subir |
|---|---|---|
| Ícono | `icon_1024x1024.png` | App Information |
| Capturas iPhone 6.9" | `screenshots/iphone_69/*.jpg` | iPhone 6.9" Display |
| Capturas iPhone 6.7" | `screenshots/iphone_67/*.jpg` | iPhone 6.7" Display |
| Capturas iPad 13" | `screenshots/ipad_13/*.jpg` | iPad Pro 13" (opcional) |

---

## Resumen de datos del app

| Campo | Valor |
|---|---|
| Bundle ID | `com.gsmovil.app` |
| Nombre | General de Seguros |
| Versión | 1.0.1 |
| URL que carga | https://qa.gsweb.com.do/login |
| Categoría sugerida | Finanzas |

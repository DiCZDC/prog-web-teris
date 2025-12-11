# 📘 Guía Completa: Cómo Enviar un Proyecto

## ✅ Verificación de Implementación

Todos los archivos necesarios están implementados y funcionando:

- ✅ **Vista de formulario**: `resources/views/projects/create.blade.php`
- ✅ **Controlador**: `app/Http/Controllers/ProjectController.php`
- ✅ **Rutas**: Registradas en `routes/web.php` (línea 144)
- ✅ **Middleware**: Protegido con autenticación (línea 119)
- ✅ **Botón en vista de equipo**: `resources/views/teams/show.blade.php` (líneas 595-600)

## 🎯 Paso a Paso: Dónde Subir Tu Proyecto

### Paso 1: Navega a "Mis Equipos"

**URL**: `http://tu-dominio.com/my-teams`

**Desde el menú**:
```
Navbar → "Mis Equipos" (clic aquí)
```

### Paso 2: Selecciona tu Equipo

En la lista de equipos, haz clic en **"Ver Detalles"** de tu equipo (del cual eres líder).

**URL resultante**: `http://tu-dominio.com/teams/{id}`
- Ejemplo: `http://tu-dominio.com/teams/5`

### Paso 3: Verifica que tu Equipo esté Inscrito en un Evento

⚠️ **IMPORTANTE**: Solo puedes enviar proyectos si tu equipo está inscrito en un evento.

**Si tu equipo NO está en un evento**, primero inscríbete:
1. Ve a "Eventos" en el navbar
2. Selecciona un evento
3. Haz clic en "Unirse al Evento" y selecciona tu equipo

### Paso 4: Busca el Botón "📤 Enviar Proyecto"

En la página de detalles de tu equipo (`/teams/{id}`), desplázate hacia abajo hasta la sección:

```
┌─────────────────────────────────────────────┐
│  📦 Proyecto del Equipo:                    │
│                                             │
│  ⚠️  Este equipo aún no ha enviado su      │
│      proyecto                               │
│                                             │
│  El líder del equipo debe enviar el        │
│  proyecto para que los jueces puedan       │
│  evaluarlo                                  │
└─────────────────────────────────────────────┘

Botones (al final de la página):
┌───────────────────┐  ┌──────────────────┐
│ 📤 Enviar Proyecto│  │ ✏️ Editar Equipo │  ...
└───────────────────┘  └──────────────────┘
     ↑
     HAZ CLIC AQUÍ
```

**Ubicación exacta**:
- Archivo: `resources/views/teams/show.blade.php`
- Línea: 599
- Código: `<a href="{{ route('projects.create', ['team_id' => $team->id]) }}" class="btn btn-primary">📤 Enviar Proyecto</a>`

### Paso 5: Llena el Formulario de Proyecto

**URL**: `http://tu-dominio.com/projects/create?team_id={id}`

**Campos del formulario**:

1. **Nombre del Proyecto** ⭐ *OBLIGATORIO*
   - Ejemplo: "Sistema de Gestión Académica"
   - Máximo 255 caracteres

2. **Descripción del Proyecto** ⭐ *OBLIGATORIO*
   - Explica qué hace tu proyecto, cómo funciona, tecnologías usadas
   - Sin límite de caracteres (texto largo)

3. **URL del Repositorio (GitHub)** ⭐ *OBLIGATORIO*
   - Ejemplo: `https://github.com/usuario/mi-proyecto`
   - Debe ser una URL válida (empieza con http:// o https://)
   - Máximo 500 caracteres

4. **URL de Demo** ⚪ *OPCIONAL*
   - Si tienes una demo en línea (Netlify, Vercel, etc.)
   - Ejemplo: `https://mi-proyecto.netlify.app`
   - Debe ser una URL válida
   - Máximo 500 caracteres

5. **URL de Documentación** ⚪ *OPCIONAL*
   - Si tienes documentación adicional (Wiki, README extendido, etc.)
   - Ejemplo: `https://github.com/usuario/proyecto/wiki`
   - Debe ser una URL válida
   - Máximo 500 caracteres

### Paso 6: Envía el Proyecto

Haz clic en el botón grande al final del formulario:

```
┌─────────────────────────────┐
│  ✅ Enviar Proyecto         │
└─────────────────────────────┘
```

**Acción del sistema**:
- Valida todos los campos
- Guarda el proyecto en la base de datos
- Asocia el proyecto con tu equipo
- Registra quién lo creó (tu usuario)
- Redirige a la página del equipo con mensaje de éxito

### Paso 7: Verifica que se Guardó Correctamente

Después de enviar, regresarás a `/teams/{id}` y verás:

```
┌─────────────────────────────────────────────────┐
│  📦 Proyecto del Equipo:                        │
├─────────────────────────────────────────────────┤
│  ✅  Nombre de tu Proyecto                      │
│                                                  │
│      Descripción de tu proyecto aquí...         │
│                                                  │
│      [GitHub] [Demo] [Docs]                     │
│      ↑ Links clicables                          │
│                                                  │
│      Enviado el 10/12/2025 15:30                │
└─────────────────────────────────────────────────┘

Botones:
┌───────────────────┐  ┌──────────────────┐
│ 📝 Editar Proyecto│  │ ✏️ Editar Equipo │  ...
└───────────────────┘  └──────────────────┘
     ↑
     Para modificar el proyecto después
```

## 🎓 Cómo lo Ve el Juez

El juez accede a: `/judge/eventos/{evento_id}/equipos`

Y ve una tabla con todos los equipos:

```
╔══════════════════════════════════════════════════════════╗
║  Equipos del Evento: Hackathon 2025                      ║
╠═══════════╦══════════╦═══════════════════╦═════════════╗
║ Equipo    ║ Líder    ║ Proyecto          ║ Acciones    ║
╠═══════════╬══════════╬═══════════════════╬═════════════╣
║ Tu Equipo ║ Tu       ║ Nombre Proyecto   ║ [Ver]       ║
║           ║ Nombre   ║ 🔗 Ver repositorio║ [⭐ Calificar]║
║           ║          ║                   ║             ║
╚═══════════╩══════════╩═══════════════════╩═════════════╝
                            ↑
                El juez puede hacer clic aquí
                para abrir tu GitHub
```

## 🔐 Restricciones de Seguridad

✅ Solo usuarios **autenticados** pueden acceder
✅ Solo el **líder del equipo** puede crear/editar proyectos
✅ El equipo **debe estar inscrito en un evento**
✅ Un equipo solo puede tener **UN proyecto** (si intentas crear otro, te redirige a editar)
✅ Solo el líder o un **admin** pueden eliminar proyectos

## ❌ Errores Comunes y Soluciones

### Error: "No veo el botón 📤 Enviar Proyecto"

**Causas posibles**:
1. ❌ No eres el líder del equipo → Solo el líder ve el botón
2. ❌ El equipo no está inscrito en un evento → Inscríbete primero en un evento
3. ❌ Ya tienes un proyecto → El botón cambia a "📝 Editar Proyecto"

### Error: "Debes especificar un equipo"

**Causa**: Accediste a `/projects/create` sin el parámetro `team_id`

**Solución**: Usa el botón desde la vista del equipo, no accedas directamente a la URL

### Error: "Solo el líder del equipo puede enviar el proyecto"

**Causa**: No eres el líder del equipo

**Solución**: Pídele al líder que envíe el proyecto

### Error: "Este equipo ya tiene un proyecto"

**Causa**: El equipo ya tiene un proyecto registrado

**Solución**: Usa el botón "📝 Editar Proyecto" en lugar de crear uno nuevo

### Error: "La URL del repositorio debe ser una URL válida"

**Causa**: El formato del link no es correcto

**Solución**: Asegúrate de incluir `https://` al inicio
- ✅ Correcto: `https://github.com/usuario/proyecto`
- ❌ Incorrecto: `github.com/usuario/proyecto`

## 🗂️ Archivos de la Implementación

Para referencia técnica:

```
Archivos Modificados/Creados:
├── app/
│   └── Http/
│       └── Controllers/
│           ├── ProjectController.php      (Lógica de envío)
│           └── TeamController.php         (Agregado: load('proyecto'))
├── resources/
│   └── views/
│       ├── projects/
│       │   └── create.blade.php          (Formulario de envío)
│       ├── teams/
│       │   └── show.blade.php            (Agregado: sección proyecto + botón)
│       └── judge/
│           └── eventos/
│               └── equipos.blade.php     (Corregido: nombre y URL)
├── database/
│   └── migrations/
│       └── 2025_12_10_000001_update_projects_table_add_missing_fields.php
└── routes/
    └── web.php                           (Ya configurado en línea 144)
```

## 📊 Flujo de Datos

```
Usuario (Líder)
    ↓
Hace clic "📤 Enviar Proyecto"
    ↓
ProjectController@create (verifica permisos)
    ↓
Muestra formulario (projects/create.blade.php)
    ↓
Usuario llena formulario
    ↓
Submit → ProjectController@store
    ↓
Validaciones (URL, campos requeridos, permisos)
    ↓
Guarda en BD (tabla projects)
    ↓
Redirect a teams/show con mensaje de éxito
    ↓
Juez puede ver el proyecto en su panel
```

---

## 🚀 ¡Todo Está Listo!

La funcionalidad está **100% implementada y funcional**. Solo necesitas:

1. ✅ Ejecutar las migraciones (si aún no lo has hecho)
2. ✅ Asegurarte de ser líder de un equipo
3. ✅ Inscribir tu equipo en un evento
4. ✅ Hacer clic en "📤 Enviar Proyecto"

**¿Necesitas ayuda?** Revisa esta guía o contacta al administrador del sistema.
